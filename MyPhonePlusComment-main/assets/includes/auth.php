<?php
    session_start();
    require_once "../includes/config.php";
    require_once "functions.php";

    $email =  htmlspecialchars(trim($_POST['email'])); // принимаем значенпие в post, убираем пробелы и преобразуем спец символы в почте, чтобы прочитались 
    $password = trim($_POST['password']); // принимаем значение в глобальную переменную post, убираем пробелы.

    $query = "SELECT * FROM `users` WHERE `email` = '$email'"; // в переменную queru записываем запрос где в таблице юзерс емаил в бд равен введенному емайлу 
    $user = mysqli_query($connection, $query); // делвем запрос на бд и результ записываем в переменную юзер 
    $userResult = mysqli_fetch_assoc($user); // перобразуем в ассоциативный массив (извлекаек следующую строку и помещает в ассоциативный массив)

    $dbPassword = $userResult['password']; // из ассоциативного массива находит пароль и хаписываем его в перменную 
    $output = [];

    if (password_verify($password, $dbPassword)) { // если правильный пароль, то дальще авторизует сессию 
        $_SESSION['auth'] = true;
        $_SESSION['user'] =[ // записть данных в массив (по ключу записывает значение)
            'id' => $userResult['id'],
            'first_name' => $userResult['first_name'],
            'last_name' => $userResult['last_name'],
            'patronymic_name' => $userResult['patronymic_name'],
            'role_id' => $userResult['role_id'],
            'email' => $userResult['email'],
            'phone' => $userResult['phone'],
            'birthday' => $userResult['birthday']
        ];

        $_SESSION['message'] = 'Здравствуйте, ' . $_SESSION['user']['first_name'] . '!'; // в сессии записывает сообщение с конкотинацией имени юзера 
        $output = ['status' => 'OK', 'message' => $_SESSION['message']]; // массив аутпут в котором хранится все что склеил 

        updateCookie(); // обновление куки в него записывает емаил 

    } else {
        $_SESSION['message'] = 'Неправильные логин или пароль!';
        $output = ['status' => 'ERROR', 'message' => $_SESSION['message']];
    }

    exit(json_encode($output));

    mysqli_close($connection);

?>