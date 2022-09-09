<?php
    require "bd.php";

    if (isset($_SESSION['logged_user'])){ 
    $check = true;
    }else{ 
    header('Location: authorization/login.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Магазин книг</title>
</head>
<body>
    <?php if ($check == true){ 
    echo'<div id="login">Вы авторизованы как '.$_SESSION['logged_user']["login"].'! ';
    echo'<a href="authorization/logout.php">Выйти</a><div>';
        if ($_SESSION['logged_user']["login"] == 'admin') { echo'Вы можете перейти на <a href="root/admin.php">страницу админа</a>';}
        if ($_SESSION['logged_user']["login"] == 'moder') { echo'Вы можете перейти на <a href="root/moder.php">страницу модератора</a>';}
    }
    ?>
    <hr>
    <h2>Каталог книг</h2>
    <div id="header">
        <div id="headerMain"></div>
        <div id="headerButton"><button type="button" id="buttonHeader">Отправить</button></div>
    </div>
    <div id="space"></div>
    <div id="main"></div>
</body>
</html>
<script src="libs/JQuery.js"></script>
<script src="script/main.js"></script>