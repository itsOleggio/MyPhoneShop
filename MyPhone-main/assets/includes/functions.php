<?php
    function generateSalt() {
        $salt = '';
        $saltLength = 60; //длина соли
        for($i = 0; $i < $saltLength; $i++) {
            $salt .= chr(mt_rand(33, 126)); //символ из ASCII-table
        }

        return $salt;
    }

    function updateCookie() {
        //session_start();
        global $connection;

        $key = generateSalt();
        $hash_key = hash('sha256', $key);
        setcookie('login', $_SESSION['user']['email'], time() + 86400, '/');
        setcookie('key', $hash_key,  time() + 86400, '/');

        $query = "UPDATE `users` SET `cookie`='$hash_key' WHERE `email`='".$_SESSION['user']['email']."'";
        mysqli_query($connection, $query);
    }

    function debug($data){
        echo '<pre>' . print_r($data, 1) . '</pre>';
    }

    function get_objects($name) : array {
        global $connection;

        $result = mysqli_query($connection, "SELECT * FROM `$name`");

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function get_objects_query($query) {
        global $connection;

        $result = mysqli_query($connection, $query);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function add_to_cart($product) {
        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['count'] += 1;
        } else {
            $_SESSION['cart'][$product['id']] = [
                'name' => $product['name'],
                'image' => $product['image'],
                'price' => $product['price'],
                'count' => 1
            ];
        }

        $_SESSION['cart.count'] = !empty($_SESSION['cart.count']) ? ++$_SESSION['cart.count'] : 1;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $product['price'] : $product['price'];
    }

    function del_from_cart($product) {
        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['count'] -= 1;

            $_SESSION['cart.count'] = !empty($_SESSION['cart.count']) ? --$_SESSION['cart.count'] : 0;
            $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] - $product['price'] : 0;

            if ($_SESSION['cart'][$product['id']]['count'] == 0) {
                unset($_SESSION['cart'][$product['id']]);
            }

            if ($_SESSION['cart'] == null) {
                unset($_SESSION['cart']);
            }
        }


    }

    function get_product($id) {
        global $connection;
        $result = mysqli_query($connection,"SELECT * FROM products WHERE id = $id");
        $product_result = mysqli_fetch_assoc($result);

        return !empty($product_result) ? $product_result : false;
    }

    function clear_cart() {
        unset($_SESSION['cart']);
        $_SESSION['cart.count'] = 0;
        $_SESSION['cart.sum'] = 0;
    }

function get_orders($query) {
    global $config;

    $orders = get_objects_query($query);
    for ($i = 0; $i < count($orders); $i++) {
        $query = "SELECT * FROM `products` INNER JOIN `product_order` ON `product_order`.`product_id` = `products`.`id` WHERE `product_order`.`order_id`=" . $orders[$i]['id'];

        if ($products = get_objects_query($query)) {
            for ($j = 0; $j < count($products); $j++) {
                $products[$j]['image'] = $config['uploads'] . $products[$j]['image'];
            }
            $orders[$i]['products'] = $products;
        }

    }

    return $orders;
}