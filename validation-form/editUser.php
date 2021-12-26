<?php
    require 'configDB.php';
    $s = array_keys($_POST['cb']);
    print_r($s);
    print_r(array_keys($_POST));

    $button = array_keys($_POST);
    $button = $button[0];
    

    if ($button == "deleteButton"){
        foreach($s as $val){
            $mysql->query("DELETE FROM `users` WHERE `id` = $val");
        }
        $mysql->close();
        header('Location: /');
        
    }
    if ($button == "blockButton"){
        foreach($s as $val){
            $mysql->query("UPDATE `users` SET `isBlock` = '1' WHERE `users`.`id` = $val");
        }
        $mysql->close();
        header('Location: /');
    }
    if ($button == "unblockButton"){
        foreach($s as $val){
            $mysql->query("UPDATE `users` SET `isBlock` = '0' WHERE `users`.`id` = $val");
        }
        $mysql->close();
        header('Location: /');
    }
    if ($button == "changeRoleButton"){
        foreach($s as $val){
            $result = $mysql->query("SELECT `liberties` FROM `users` WHERE id = $val");
            $result = $result->fetch_assoc();
            if ($result['liberties']=="admin"){
                $mysql->query("UPDATE `users` SET `liberties` = 'default' WHERE `users`.`id` = $val");
            }
            else {
                $mysql->query("UPDATE `users` SET `liberties` = 'admin' WHERE `users`.`id` = $val");
            }
        }
        $mysql->close();
        header('Location: /');
    }
    $mysql->close();