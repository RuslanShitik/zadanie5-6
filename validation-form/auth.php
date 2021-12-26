<?php
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    
    $pass = md5($pass."rns");

    require 'configDB.php';

    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass' AND `isBlock` = 0");
    $user = $result->fetch_assoc();

    if(count($user) == 0){
   
        echo "Неверный логин или пароль!";
        exit();
    }
    if ($user['liberties']=="admin"){

        setcookie('admin', $user['login'], time()+3600, "/");
    }
    else{
        setcookie('user', $user['login'], time()+3600, "/");
    }
    $mysql->query("UPDATE `users` SET `lastLogindate` = CURRENT_TIMESTAMP WHERE `users`.`login` = '$login'");
    $mysql->close();

    header('Location: /');
?>