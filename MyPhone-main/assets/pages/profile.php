<?php
    session_start();
    require_once "../includes/config.php";
    require_once "../includes/cookie.php";
    require_once "../includes/functions.php";

    if (empty($_SESSION['auth']) || $_SESSION['auth'] == false)
    {
        header('Location: /assets/pages/signin.php');
    }
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/orders.css">

    <title>Личный кабинет</title>

    <script type="text/javascript" src="/assets/js/jquery-3.6.1.min.js"></script>
<!--    <script type="text/javascript" src="/assets/js/seller-cabinet.js"></script>-->
    <script>



        let now = new Date();
        setInterval(get_current_time, 1000);

        function get_current_time()  {
            let date = new Date();
            let options = {
                weekday: "long",
                year: "numeric",
                month: "numeric",
                day: "numeric",
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            };

            $('.current-time').text(date.toLocaleDateString("ru", options));
        }


    </script>
</head>
<body>
    <?php
        include "../includes/header.php";
    ?>

    <div class="grid_area">
        <div class="profile_area">
            <div class="profile_status">

                <span>
                    Статус:
                    <?php
                        switch ($_SESSION['user']['role_id']) {
                            case '1':
                                echo ' Владельц ';
                                break;
                            case '2':
                                echo ' Покупатель ';
                                break;
                            case '3':
                                echo ' Продавец';
                                break;
                        }
                    ?>
                    <br>
                    <span> ФИО:
                    <span style="color: #ffffff">
                        <?= $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['second_name'] . ' '. $_SESSION['user']['patronymic_name']?>
                    </span>
                    </span>
                </span>
                <span>
                    Текущая дата:
                    <span class="current-time">
                        <?php
                            $now = time();
                            $days = array(
                                'воскресенье', 'понедельник', 'вторник', 'среда',
                                'четверг', 'пятница', 'суббота'
                            );

                            setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
                            $date = date(', d.m.Y г., H:i:s');

                            $dnum = date('w',strtotime(now));

                            echo $days[$dnum];
                            echo $date;
                        ?>
                    </span>
                </span>
                <br>
                <a href="/assets/includes/logout.php" style="color: #6fe4ff; font-family: Montserrat">Выйти из аккаунта</a>
            </div>
            <div class="profile_settings">
                <div class="profile_buttons">
                    <?php switch ($_SESSION['user']['role_id']): ?><?php case '1': ?>



                        <?php break; ?>

                    <?php case '2': ?>
                        <a class="button edit-info">Редактирование данных</a>
                        <a class="button show-orders">Просмотр заказов</a>

                        <?php break; ?>

                    <?php case '3': ?>
                        <a class="button add-product">Добавить товар</a>
                        <a class="button update-product">Изменить товар</a>
                        <a class="button delete-product">Удалить товар</a>
                        <a class="button update-status">Изменить статус заказа</a>

                        <?php break; ?>

                    <?php endswitch ?>
                </div>
                <div class="information_block">
                    <?php switch ($_SESSION['user']['role_id']): ?><?php case '1': ?>



                        <?php break; ?>

                    <?php case '2': ?>

                        <div class="show-orders-area none">
                            <form class="show-orders-form">
                                <input type="date" name="begin-date">
                                <input type="date" name="end-date">
                                <input class="button" type="submit" value="Поиск">

                                <div class="errors_block">

                                </div>
                            </form>

                        </div>

                        <?php break; ?>

                    <?php case '3': ?>

                        <form class="add-product-form">

                            <label>Название товара</label>
                            <input type="text" name="title" placeholder="Введите название" autofocus>

                            <label>Изображение товара</label>
                            <input type="file" name="image" placeholder="Выберите изображение">

                            <label>Стоимость товара</label>
                            <input type="number" name="price" step="0.01" placeholder="Введите стоимость">

                            <label>Категории товара:</label>
                            <div style="display: flex; width: 100%; flex-wrap: wrap; justify-content: space-around">
                                <?php
                                $categories = get_objects('categories');
                                ?>
                                <?php foreach ($categories as $category): ?>
                                    <div class="category_checkbox">
                                        <label><?= $category['name'] ?></label>
                                        <input class="form_checkbox" type="checkbox" name="categories[]" value="<?= $category['id'] ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button class="button" type="submit">Добавить товар</button>

                            <div class="errors_block">

                            </div>

                        </form>

                        <?php
                            $products = get_objects('products');
                        ?>
                        <div class="delete-product-area none">
                            <?php foreach ($products as $product): ?>

                                <div id="del-prod-<?=$product['id']?>" class="product_row">
                                    <img src="/assets/media/<?=$product['image']?>" class="mini_image">
                                    <div class="product_row_name"><?=$product['name']?></div>
                                    <div class="product_row_price"><?=$product['price']?> ₽</div>
                                    <a class="button delete-from-db special_button" data-id="<?=$product['id']?>">Удалить</a>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <div class="update-product-area none">
                            <?php foreach ($products as $product): ?>

                                <form id="upd-prod-<?=$product['id']?>" data-id="<?=$product['id']?>" class="product_row" style="box-shadow: 0 0">
                                    <input type="text" name="id" value="<?=$product['id']?>" hidden>
                                    <img src="/assets/media/<?=$product['image']?>" class="mini_image" alt="<?=$product['image']?>">
                                    <div class="update_inputs">
                                        <div class="update_inputs">
                                            <input class="upd_image" type="file" name="upd-image" placeholder="Изображение" value="<?=$product['image']?>">
                                            <input type="text" name="title" placeholder="Название" value='<?=$product['name']?>'>
                                            <input type="number" name="price" step="0.01" placeholder="Стоимость" value="<?=$product['price']?>">

                                            <?php
                                            $categories = get_objects('categories');
                                            //                                            $query = "SELECT `categories`.`id`, `categories`.`name`, `product_category`.`product_id` AS product_id FROM `categories`
                                            //                                                    LEFT OUTER JOIN `product_category` ON `categories`.`id` = `product_category`.`category_id`
                                            //                                                    WHERE product_category.product_id = ".$product['id']." OR `product_category`.`product_id` IS NULL;"
                                            //
                                            //                                            $categories = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                            ?>
                                            <div>
                                                <?php echo 'Категории: ' ?>
                                                <?php foreach ($categories as $category): ?>

                                                    <input class="form_checkbox tooltip" data-tooltip="<?= $category['name'] ?>" type="checkbox" name="categories[]" value="<?= $category['id'] ?>">


                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="errors_block">

                                        </div>

                                    </div>

                                    <input class="button update-to-db special_button" value="Изменить" type="submit">
                                </form>

                            <?php endforeach; ?>
                        </div>

                        <?php break; ?>

                    <?php endswitch ?>


                </div>
            </div>

            <?php switch($_SESSION['user']['role_id']): ?><?php case '1':?>
                    <form class="rating-profit-form">
                        <input type="date" name="begin-date">
                        <input type="date" name="end-date">

                        <a class="button check-rating">Посмотреть рейтинг</a>
                        <a class="button check-profit">Посмотреть прибыль</a>

                        <div class="errors_block">

                        </div>
                    </form>

                    <div class="order_area">

                    </div>


                <?php break;?>
            <?php case '2':?>
                <div class="show-orders-area none">
                    <div class="order_area">

                    </div>
                </div>
                <?php break; ?>
                <?php case '3':?>
                <div class="update-status-area none">
                    <h1>Заказы</h1>
                    <div class="order_area">
                        <?php
                            $query = "SELECT * FROM `orders` WHERE `status` = 'Оформлен'";
                        ?>
                        <?php if ($result = mysqli_query($connection, $query)): ?>
                            <?php $orders = get_orders($query); ?>
                            <?php foreach ($orders as $order): ?>
                                <?php
                                    $sum = 0;
                                ?>
                                <div class="order">
                                    <div class="date_order">
                                        Заказ № <?=$order['id']?> от <?=$order['ordering_time']?>
                                    </div>

                                    <?php if (isset($order['products'])) : ?>
                                        <?php foreach ($order['products'] as $product) :?>
                                            <a class="product_area" href="#">
                                                <div class="container">
                                                    <img src="<?=$product['image']?>" alt="Товар">
                                                    <div class="text title"><?=$product['name']?></div>
                                                </div>
                                                <div class="container">
                                                    <div class="text">Количество: <?=$product['count']?> штук</div>
                                                    <div class="text">Цена: <?=$product['price'] * $product['count']?> ₽</div>
                                                    <?php
                                                    $sum += $product['price'] * $product['count'];
                                                    ?>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>


                                    <div class="status_sum">
                                        <div class="status">Статус: <?=$order['status']?>  </div>
                                        <div class="sum">Общая сумма: <?=$sum?> ₽</div>
                                    </div>
                                    <button class="button payday" data-id="<?=$order['id']?>">Подтвердить оплату</button>
                                    <button class="button cancel" data-id="<?=$order['id']?>">Отменить</button>
                                </div>

                            <?php endforeach; ?>
                        <?php endif;?>
                    </div>
                </div>

                <?php break; ?>
            <?php endswitch; ?>


        </div>

    </div>
    <script type="module" src="../js/seller-cabinet.js"></script>
    <script type="module" src="../js/client-cabinet.js"></script>
    <script type="module" src="../js/owner-cabinet.js"></script>
</body>
</html>
<?php
    mysqli_close($connection);
?>