
<header>

    <link rel="apple-touch-icon" sizes="180x180" href="assets/pic/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/pic/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/pic/logo/favicon-16x16.png">
    <link rel="manifest" href="assets/pic/logo/site.webmanifest">
    <link rel="mask-icon" href="assets/pic/logo/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <div class="site-header-basket">
        <div class="left">
            <ul class="lk_header">
                <li>
                    <a href="/assets/pages/profile.php">Личный кабинет</a>
                    <!--                <img href="/assets/pages/profile.php" src="/assets/media/cabinet_ico.png" class="cabinet_button_image">-->
                </li>
                <li>
                    <a class="cabinet_button_text">
                        <?= $_SESSION['user']['first_name'] ?>
                    </a>
                </li>
            </ul>
        </div>


        <div class="right">

            <div class="corz">
                <a href="/assets/pages/cart.php" class="cart-button">
                    <span>Корзина</span>
                    <span id="cart-num"><?= $_SESSION['cart.count'] ?? 0 ?></span>
                </a>
            </div>


        </div>

    </div>

    <div class="header_middle">
        <nav>
            <ul>
                <li>

                </li>

                <li>
                    <a href="/">
                        <section>
                            <div class="content">
                                <h2 class="logo"> MY_PHONE </h2>
                            </div>
                        </section>
                    </a>
                </li>

                <li>
                    <div>

                    </div>
<!--                    --><?php //if ($_SESSION['auth'] == true): ?>
<!---->
<!---->
<!--                    --><?php //else: ?>
<!---->
<!--                    --><?php //endif; ?>
                </li>
            </ul>
        </nav>
    </div>

    <?php
    $categories = get_objects('categories');
    ?>
    <div class="header_down">

        <nav>
            <ul class="my_ul">
                <?php foreach ($categories as $category): ?>
                    <li class="my_li">
                        <a class="header_text"
                           href="/assets/pages/categories.php?category=<?= $category['id'] ?>"><?= $category['name'] ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </nav>

    </div>


</header>
