<?php
    session_start();
    require_once "../includes/config.php";
    require_once "../includes/functions.php";

    $category = get_objects_query("SELECT * FROM categories WHERE id =" . $_GET['category']);
?>

<!DOCTYPE html>
<html>
    <head>

        <title><?= $category[0]['name'] ?></title>

        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/product.css">

        <meta charset="UTF-8">

        <script type="text/javascript" src="../js/jquery-3.6.1.min.js"></script>
        <script type="text/javascript" src="../js/cart.js"></script>

    </head>
    <body>
        <?php
            include "../includes/header.php";
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
                    $query = "SELECT products.*, product_category.category_id as category_id
                              FROM products INNER JOIN product_category  
                                 ON products.id = product_category.product_id
                              WHERE product_category.category_id =" .$_GET['category'];
                    $products = get_objects_query($query);
                ?>

                <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            require '../includes/product_card.php';
                        }
                    }
                ?>

            </div>



        </div>

        <?php
            include "../includes/footer.php";
        ?>

    </body>

</html>
<?php
    mysqli_close($connection);
?>
