<?php
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);

    if(mb_strlen($login)>90) {
        echo "invalid login length";
        exit();
    }
    else if(mb_strlen($mail)>40) {
        echo "invalid mail length";
        exit();
    }
    $pass = md5($pass."rns");

    require 'configDB.php';
    
    if ($mysql->connect_errno) {
        printf("Соединение не удалось: %s\n", $mysql->connect_error);
        exit();
    }

    $mysql->query("INSERT INTO `users` (`login`, `name`, `password`, `liberties`, `registerDate`, `lastLogindate`, `email`, `isBlock`) 
    VALUES ('$login', '$username', '$pass', 'default', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$mail', 0)");

    if (mysqli_errno($mysql)) {
        printf("register error: login is used", $mysql->mysqli_error);
        exit();
    }   

    $mysql->close();

    header('location: /');
?>