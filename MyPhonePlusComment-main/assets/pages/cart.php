<?php
    session_start();
    require_once "../includes/config.php";
    require_once "../includes/functions.php";
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/orders.css">
        <link rel="stylesheet" href="../css/product.css">
        <link rel="stylesheet" href="../css/cart.css">

        <script type="text/javascript" src="/assets/js/jquery-3.6.1.min.js"></script>

        <title>Корзина</title>
    </head>
    <body>

    <?php
    include "../includes/header.php";
    ?>

    <div class="cart_area">

        <h1 class = "cart_area_text">Оформление заказа</h1>
        <div class="order">
            <?php if (isset($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                        <a class="product_area" href="#">
                            <div class="name_container">
                                <img src="<?=$config['uploads'].$product['image']?>" alt="Товар">
                                <div class="text title"><?=$product['name']?></div>
                            </div>
                            <div class="cart_container">
                                <div class="">Количество: </div>
                                <div class="cart_buttons">

                                    <div class="product_button cart_btn del-from-cart" data-id="<?=$id?>">
                                        −
                                    </div>

                                    <div class="product_count" id="count-<?=$id?>" style="font-weight: normal;">
                                        <?= $product['count'] ?? 0 ?>
                                    </div>

                                    <div class="product_button cart_btn add-to-cart" data-id="<?=$id?>">
                                        +
                                    </div>
                                </div>
                                <div class=""> штук</div>

                            </div>
                            <div class="cart_cost_container">Цена: <?=$product['price'] * $product['count']?> ₽</div>
                        </a>
                <?php endforeach; ?>
            <?php endif;?>


            <div class="count" style="justify-content: flex-end">Всего товаров: <?=$_SESSION['cart.count'] ?? 0?></div>
            <div class="sum" style="justify-content: flex-end">Общая сумма: <?=$_SESSION['cart.sum'] ?? 0?> ₽</div>
            <button class="button checkout">Оформить заказ</button>
        </div>
    </div>
    <script type="module" src="/assets/js/cart.js"></script>

    </body>

</html>

<?php
mysqli_close($connection);
?>
