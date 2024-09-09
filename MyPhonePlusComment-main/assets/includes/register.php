<?php
    require_once "./config.php";

    $firstname = trim($_POST['first_name']); // принимаем значение в глобальную переменную post, убираем пробелы.
    $lastname = trim($_POST['last_name']);// принимаем значение в глобальную переменную post, убираем пробелы.
    $patronymicname = trim($_POST['patronymic_name']);// принимаем значение в глобальную переменную post, убираем пробелы.
    $email =  htmlspecialchars(trim($_POST['email']));// принимаем значение в глобальную переменную post, убираем пробелы.
    $password = trim($_POST['password']);// принимаем значение в глобальную переменную post, убираем пробелы.
    $password = password_hash($password, PASSWORD_BCRYPT); // хешируем пароль 

    $query = "SELECT COUNT(`id`) AS `total_count` 
        FROM `users` 
        WHERE (`email` = '$email')";  // подсчет пользователей в жтим майлом 

    $userExist = mysqli_query($connection, $query);
    $userCount = mysqli_fetch_assoc($userExist);

    $message = '';
    $output = [];

    if ($userCount['total_count'] == 0) {
        $query = "INSERT INTO `users` (`first_name`, `last_name`, `patronymic_name`,`role_id`, `email`, `password`) 
            VALUES ('$firstname', '$lastname', '$patronymicname', '2', '$email', '$password')";

        $result = mysqli_query($connection, $query);

        if (!empty($result)) {
            $message = 'Вы успешно зарегистрировались!';
            $output = ['status' => 'OK', 'message' => $message];
        }

    } else {
        $message = 'Пользователь с таким email уже существует!';
        $output = ['status' => 'ERROR', 'message' => $message]; // проерка если есть такой пользователь, то хуй, а еси нет то рейгайся дальше 
    }

    exit(json_encode($output));
?>
