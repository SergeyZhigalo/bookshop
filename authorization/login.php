<?php
    require "../bd.php";

    $data = $_POST;
    if (isset($data['do_login'])) 
    {
        $errors = array();

        $user = R::findOne('users', 'login = ?', array($data['login'])); 
        if ($user) {
            if ($data['password'] != $user['password']) {
                $errors[] = 'Неверно введен пароль!';
            }else{
                $_SESSION['logged_user'] = $user;
                header('Location: ../index.php');
            }
        }else{
            $errors[] = 'Пользователь с таким логином не найден!';
        }

        if (!empty($errors)) {
            echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }
?>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/styleAuthorization.css">
<h2>Форма входа</h2>
<form action="login.php" method="POST">
    <p>
        <p><strong>Ваш логин</strong></p>
        <input type="text" name="login" value="<?php echo @$data['login'];?>">
    </p>
    <p>
        <p><strong>Ваш пароль</strong></p>
        <input type="password" name="password" value="<?php echo @$data['password'];?>">
    </p>
    <button type="submit" name="do_login">Войти</button>
    <p id="text">Вы еще не зарегистрированны? Можете <a href="signup.php">перейти</a> на страницу регистрации</p>
</form>