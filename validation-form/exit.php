<?php 
    setcookie ('user', $user['name'], time() - 3600, "/");
    setcookie ('admin', $user['name'], time() - 3600, "/");
    header('location: /');
?>