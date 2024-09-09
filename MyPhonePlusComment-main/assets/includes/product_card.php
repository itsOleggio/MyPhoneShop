<div class="product">
    <div style="width: 100%">
        <a href="#"><img src="<?=$config['uploads'].$product['image'] ?>" alt="<?= $product['name'] ?>" class="product_image"></a>
    </div>

    <div class="product_info">
        <a class="product_name" href="#"><?= $product['name'] ?></a>

        <div class="product_price">
            <?= $product['price'] ?> ₽
        </div>
        <span class="product_buttons">
<!--            <a class="product_button card-btn del-from-cart" href="?cart=delete&id=--><?//= $product['id'] ?><!--" data-id="--><?//= $product['id'] ?><!--">−</a>-->
<!--            <div id="count---><?//=$product['id']?><!--" style="font-weight: normal;">--><?//= $_SESSION['cart'][$product['id']]['count'] ?? 0 ?><!--</div>-->
<!--                <a class="product_button add-to-cart" href="?cart=add&id=--><?//= $product['id'] ?><!--" data-id="--><?//= $product['id'] ?><!--">В корзину</a>-->
<!--            <a class="product_button_more " href="/assets/pages/cart.php">В корзину</a>-->
                <a class="product_button_more add-to-cart" href="?cart=add&id=<?= $product['id'] ?>" data-id="<?= $product['id'] ?>">В корзину</a>
        </span>

    </div>
</div>

