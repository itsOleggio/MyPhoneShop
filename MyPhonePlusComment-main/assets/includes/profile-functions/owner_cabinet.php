<?php
    session_start();
    require_once '../config.php';
    require_once '../functions.php';

    error_reporting(-1);

    if (empty($_SESSION['user']['role_id']) || $_SESSION['user']['role_id'] != '1') {
        header('Location: /assets/pages/profile.php');
    }

    if (isset($_POST['owner_action'])) {
        switch ($_POST['owner_action']) {
            case 'rating':
                $begin_date = $_POST['begin-date'];
                $end_date = $_POST['end-date'];

                if ($begin_date == null) {
                    $begin_date = date("Y.m.d H:i:s", null);
                }
                if ($end_date == null) {
                    $end_date = date("Y.m.d H:i:s");
                }

                $query = "SELECT
                                    `products`.`id`,
                                    `products`.`name`,
                                    `products`.`image`,
                                    SUM(`products`.`price` * `product_order`.`count`) as `total_price`
                                FROM  `products`
                                INNER JOIN `product_order`
                                ON `product_order`.`product_id` = `products`.`id`
                                INNER JOIN `orders`
                                ON `product_order`.`order_id` = `orders`.`id`
                                WHERE `orders`.`purchase_time`
                                BETWEEN '$begin_date' AND '$end_date'
                                GROUP BY `products`.`id`
                                ORDER BY `total_price` DESC
                                LIMIT 3";

                $products = get_objects_query($query);

                echo json_encode(['code' => 'ok', 'products' => $products]);

                break;

            case 'profit':
                $begin_date = $_POST['begin-date'];
                $end_date = $_POST['end-date'];

                if ($begin_date == null) {
                    $begin_date = date("Y.m.d H:i:s", null);
                }
                if ($end_date == null) {
                    $end_date = date("Y.m.d H:i:s");
                }

                $query = "SELECT
                                    SUM(`product_order`.`count` * `products`.`price`) as `total_price`
                                FROM  `products`
                                INNER JOIN `product_order`
                                ON `product_order`.`product_id` = `products`.`id`
                                INNER JOIN `orders`
                                ON `product_order`.`order_id` = `orders`.`id`
                                WHERE `orders`.`purchase_time`
                                BETWEEN '$begin_date' AND '$end_date'";

                $products = get_objects_query($query);

                echo json_encode(['code' => 'ok', 'total_price' => $products[0]['total_price']]);

                break;

        }
    }
?>
