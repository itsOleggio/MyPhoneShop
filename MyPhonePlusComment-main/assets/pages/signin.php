<?php
    require_once "../includes/config.php";
    require_once "../includes/functions.php";
    session_start();

    include "../includes/cookie.php";

    if (!empty($_SESSION['auth']) || $_SESSION['auth'] == true)
    {
        header('Location: /assets/pages/profile.php'); // если сессия не пуская или активка, то переадресация на profile.php
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Авторизация</title>

        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/header.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    </head>
    <body>
        <?php
            include "../includes/header.php";
        ?>

        <div class="grid_area">
            <div>
                <form class="auth_reg" name="auth_form">

                    <label>Электронная почта</label>
                    <input type="email" name="email" placeholder="Введите свой email" autofocus>

                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="Введите пароль">

                    <div class="g-recaptcha" data-sitekey="<?php echo $config['SITE_KEY'] ?>" style="margin: auto";></div>

                    <button class="button" type="submit">Авторизоваться</button>

                    <p class="p_reg">
                        У вас нет аккаунта? - <a href="signup.php" class="a_reg">зарегистрируйтесь</a>!
                    </p>

                    <div class="errors_block">

                    </div>

                </form>

            </div>


        </div>

        <script type="module" src="../js/auth.js"></script>

    </body>
</html>
<?php
    mysqli_close($connection);
?>