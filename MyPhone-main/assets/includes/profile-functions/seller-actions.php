<?php
    session_start();
    require_once '../config.php';
    require_once '../functions.php';

    error_reporting(-1);
//
//    if (empty($_SESSION['user']['role_id']) || $_SESSION['user']['role_id'] != '3') {
//        header('Location: /assets/pages/profile.php');
//        debug($_SESSION['user']['role_id']);
//    }

    if (isset($_POST['seller_action'])) {
        switch ($_POST['seller_action']) {
            case 'delete':
                $query = "DELETE FROM `products` WHERE `id` =" . $_POST['id'];

                if ($result = !mysqli_query($connection, $query)) {
                    echo json_encode(['code' => 'error', 'answer' => $result]);

                } else {
                    echo json_encode(['code' => 'ok']);
                }
                break;

            case 'add':

                if (!empty($_FILES['image'])) {
                    $file_name = time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], '../../media/' . $file_name);
                } else {
                    $file_name = 'no_image.jpg';
                }
                $title = $_POST['title'];
                $price = $_POST['price'];

                $query = "INSERT INTO `products` (`name`, `image`, `price`) VALUES ('$title', '$file_name', '$price')";

                $is_exist = get_objects_query("SELECT COUNT('id') AS `total_count` FROM `products` WHERE (`name` = '$title')");

                if ($is_exist[0]['total_count'] != 0) {
                    echo json_encode(['code' => 'error', 'message' => 'Такой товар уже существует!']);
                } else if ($result = !mysqli_query($connection, $query)) {
                    echo json_encode(['code' => 'error', 'message' => 'Ошибка во время добавления товара!']);

                } else {
                    $query = "SELECT * FROM `products` WHERE `name` = '$title'";
                    $result = get_objects_query($query);
                    foreach ($_POST['categories'] as $category) {
                        mysqli_query($connection, "INSERT INTO `product_category` (`product_id`, `category_id`) VALUES ('".$result['0']['id']."', '$category')");
                    }
                    echo json_encode(['code' => 'ok', 'message' => 'Товар успешно добавлен!']);
                }
                break;

            case 'update':
                if (!empty($_FILES['upd-image'])) {
                    $file_name = time() . $_FILES['upd-image']['name'];
                    move_uploaded_file($_FILES['upd-image']['tmp_name'], '../../media/' . $file_name);
                } elseif (isset($_POST['image'])) {
                    $file_name = $_POST['image'];
                } else {
                    $file_name = 'no_image.jpg';
                }

                $title = $_POST['title'];
                $price = $_POST['price'];
                $id = $_POST['id'];

                $query = "UPDATE `products` SET `name` = '$title', `price` = '$price', `image` = '$file_name' WHERE `id` = '$id'";

                $check_exist = mysqli_query($connection, "SELECT COUNT('id') AS `total_count` FROM `products` WHERE (`name` = '$title' AND `id` != '$id')");
                $is_exist = mysqli_fetch_assoc($check_exist);

                if ($is_exist['total_count'] != 0) {
                    echo json_encode(['code' => 'error', 'message' => 'Такой товар уже существует!']);
                } else if ($result = !mysqli_query($connection, $query)) {
                    echo $query;
                    echo json_encode(['code' => 'error', 'message' => 'Ошибка во время обновления товара!']);
                } else {
                    $query = "SELECT * FROM `products` WHERE `name` = '$title'";

                    $result = get_objects_query($query);

                    if (isset($_POST['categories'])) {
                        mysqli_query($connection, "DELETE * FROM `product_category` WHERE `product_id` = '$id'");
                        foreach ($_POST['categories'] as $category => $checked) {
                            $is_exist = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(`category_id`) AS `total_count` FROM `product_category` WHERE (`product_id` = '$id' AND `category_id` = $category)"));

                            if ($is_exist['total_count'] == 0) {
                                if ($checked['value'] == 'true') {
                                    mysqli_query($connection, "INSERT INTO `product_category` (`product_id`, `category_id`) VALUES ('$id', '$category')");
//                                    debug("INSERT INTO `product_category` (`product_id`, `category_id`) VALUES ('$id', '$category')");
                                }
                            } else {
                                if ($checked['value'] == 'false') {
                                    mysqli_query($connection, "DELETE FROM `product_category` WHERE `product_category`.`product_id` = $id AND `product_category`.`category_id` = $category");
//                                    debug("DELETE FROM `product_category` WHERE `product_category`.`product_id` = $id AND `product_category`.`category_id` = $category");
                                }
                            }
                        }

                    }

                    echo json_encode(['code' => 'ok', 'message' => 'Товар успешно обновлен!', 'image' => $config['uploads'] . $file_name]);
                }
                break;

            case 'change_status':
                $id = $_SESSION['user']['id'];
                $date = date("Y.m.d H:i:s");
                $query = "UPDATE `orders` SET `status` = 'Оплачен', `seller_id` = '$id', `purchase_time` = '$date' WHERE `id` =" . $_POST['id'];


                if ($result = !mysqli_query($connection, $query)) {
                    echo json_encode(['code' => 'error', 'answer' => $result]);

                } else {
                    echo json_encode(['code' => 'ok']);
                }

                break;

            case 'cancel_status':
                $id = $_SESSION['user']['id'];
                $date = date("Y.m.d H:i:s");
                $query = "UPDATE `orders` SET `status` = 'Отменен', `seller_id` = '$id', `purchase_time` = '$date' WHERE `id` =" . $_POST['id'];


                if ($result = !mysqli_query($connection, $query)) {
                    echo json_encode(['code' => 'error', 'answer' => $result]);

                } else {
                    echo json_encode(['code' => 'ok']);
                }

                break;
        }
    }

    mysqli_close($connection);
?>




