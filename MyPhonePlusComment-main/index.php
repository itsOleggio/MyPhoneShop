<?php
    session_start();
    require_once "assets/includes/config.php";
    require_once "assets/includes/functions.php";
    require "assets/includes/cookie.php";

    $products = get_objects('products');

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $config['title']; ?></title>


    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/product.css">

    <meta charset="UTF-8">

    <script type="text/javascript" src="/assets/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="/assets/js/cart.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


</head>
    <body>
        <?php
            include "assets/includes/header.php";
        ?>

        <div class="slidershow middle">
            <div class="sliders">
                <div class="slider">
                    <img src="">
                </div>
            </div>
        </div>

        <div class="grid_area">
            <div class="products">
                <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                             require 'assets/includes/product_card.php';
                        }
                    }
                ?>
            </div>
        </div>

        <?php
            include "assets/includes/footer.php";
        ?>


    </body>

</html>
<?php

    mysqli_close($connection);

?>
