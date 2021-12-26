<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 5-6</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    
    
</head>
<body>
    <?php
        require 'validation-form/configDB.php';
        $_COOKIE['user']!= '' ? $login =  $_COOKIE['user'] : $login = $_COOKIE['admin'];
        $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `isBlock` = '0'");
        $result = $result->fetch_assoc();
        $mysql->close();

        if ($_COOKIE['user'] != '' AND count($result) != 0):
            //TODO: is blocked not 0/1
    ?>

    <?php require "block/header.php"?>

    <div class="container-fluid">
        <?php require "block/sidemenu.php"?>
        <div class="row">
            

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><form action = "validation-form/editUser.php" method="post"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
           
                <h2>All users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">EMail</th>
                            <th scope="col">Register Date</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">isBlocked</th>
                            <th scope="col">
                                <label>
                                    <input type="checkbox" value="headCheck" OnClick="checkAll(this)"> Check all
                                </label>
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'validation-form/configDB.php';
                            $result = $mysql->query("SELECT * FROM `users`");

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr><td>'.$row["id"].'</td><td>'.$row["name"]
                                .'</td><td>'.$row["email"].'</td><td>'.$row["registerDate"]
                                .'</td><td>'.$row["lastLogindate"].'</td><td>';
                                if ($row["isBlock"] == 0){
                                    echo ('not blocked</td><td><input type="checkbox" name="cb['.$row[id].']" value="remember-me"></td></tr>');
                                }
                                else {
                                    echo 'blocked</td><td><input type="checkbox" name="cb['.$row[id].']" value="remember-me"></td></tr>';
                                }
                            }
                            $mysql->close();
                        ?>
                    </tbody>
                    </table>
                </div>
                </form>
            </main>
        </div>
    </div>

    <?php
        elseif ($_COOKIE['admin'] != '' AND count($result) != 0):
    ?>

    <?php require "block/header.php"?>

    <div class="container-fluid">
        <div class="row">
            <?php require "block/sidemenu.php"?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><form action = "validation-form/editUser.php" method="post"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="blockButton">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-octagon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                </svg>
                                Block
                            </button>

                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="unblockButton">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                </svg>
                                Unblock
                            </button>
                            
                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="deleteButton">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Delete
                            </button>
                            
                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="changeRoleButton">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                </svg>
                                Change role
                            </button>
                        </div>
                    </div>
                </div>


                <h2>All users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">EMail</th>
                            <th scope="col">Register Date</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">isBlocked</th>
                            <th scope="col">
                                <label>
                                    <input type="checkbox" value="remember-me" OnClick="checkAll(this)"> Check all
                                </label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'validation-form/configDB.php';
                            $result = $mysql->query("SELECT * FROM `users`");

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr><td>'.$row["id"].'</td><td>'.$row["name"]
                                .'</td><td>'.$row["email"].'</td><td>'.$row["registerDate"]
                                .'</td><td>'.$row["lastLogindate"].'</td><td>';
                                if ($row["isBlock"] == 0){
                                    echo ('not blocked</td><td><input type="checkbox" name="cb['.$row[id].']" value="remember-me"></td></tr>');
                                }
                                else {
                                    echo 'blocked</td><td><input type="checkbox" name="cb['.$row[id].']" value="remember-me"></td></tr>';
                                }
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
                </form>
            </main>
        </div>
    </div>


    <?php else: ?>
        <div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0 mt-4">
        <div class="row bg-white shadow-sm">
            <div class="col border rounded p-4">
                <h1 class="h3 mb-3 fw-normal text-center">Вход</h1>
                <form action="validation-form/auth.php" method="post">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Логин"><br>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Пароль"><br>
                    <button class="btn btn-primary w-100" type="submit">Войти</button>
                    <a href="registration.html" class="btn btn-link w-100 mt-2">Регистрация</a>
                </form>
            </div>
        </div>
    </div>
    <?php endif;?>
    <script language="javascript">
        function checkAll(btn) {
            
            var boxes = document.querySelectorAll("table input[value='remember-me']");
            for (var i = 0; i < boxes.length; i++) {
                boxes[i].checked = btn.checked;
            }
        }       
    </script>
</body>
</html>