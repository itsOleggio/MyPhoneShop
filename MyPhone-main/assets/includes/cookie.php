<?php
    session_start();
    require_once "config.php";
    require_once "functions.php";

if (empty($_SESSION['auth']) || $_SESSION['auth'] == false) {

    //Проверяем, не пустые ли нужные нам куки...
    if (!empty($_COOKIE['login']) && !empty($_COOKIE['key'])) {
        //Пишем логин и ключ из КУК в переменные (для удобства работы):

        $login = $_COOKIE['login'];
        $key = $_COOKIE['key']; //ключ из кук

        /*
            Формируем и отсылаем SQL запрос:
            ВЫБРАТЬ ИЗ таблицы_users ГДЕ поле_логин = $login.
        */

        $query = "SELECT * FROM users WHERE `email`='$login' AND `cookie`='$key'";
        //Ответ базы запишем в переменную $result:
        $result = mysqli_query($connection, $query);
        $userResult = mysqli_fetch_assoc($result);




        //Если база данных вернула не пустой ответ - значит пара логин-ключ_к_кукам подошла...
        if (!empty($userResult)) {
            //Стартуем сессию:
            //session_start();

            //Пишем в сессию информацию о том, что мы авторизовались:
            $_SESSION['auth'] = true;

            /*
                Пишем в сессию данные пользователя.
            */
            $_SESSION['user'] = [
                "id" => $userResult['id'],
                "first_name" => $userResult['first_name'],
                "last_name" => $userResult['last_name'],
                "patronymic_name" => $userResult['patronymic_name'],
                "role_id" => $userResult['role_id'],
                "email" => $userResult['email'],
                "phone" => $userResult['phone'],
                "birthday" => $userResult['birthday']
            ];


            //Перезапись куков.

            updateCookie();

        }
    }
}

?>