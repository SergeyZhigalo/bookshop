<?php
    require "../bd.php";

    $data = $_POST;
    if (isset($data['do_signup']))
    {
        $errors = array();
        if (trim($data['login']) == '') { 
            $errors[] = 'Введите логин!';
        }
    
        if (trim($data['email']) == '') {
            $errors[] = 'Введите почту!';
        }

        if ($data['password'] == '') {
            $errors[] = 'Введите пароль!';
        }

        if ($data['password_2'] != $data['password']) {
            $errors[] = 'Повторите пароль!';
        }

        if (R::count('users', "login = ?", array($data['login'])) > 0) {
            $errors[] = 'Пользователь с таким логином уже существует';
        }

        if (R::count('users', "email = ?", array($data['email'])) > 0) {
            $errors[] = 'Пользователь с такой почтой уже существует';
        }

        if (empty($errors)) {
            $user = R::dispense('users'); 
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = $data['password']; 
            R::store($user); 
            header('Location: login.php');
        }else{
            echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }
?>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/styleAuthorization.css">
<h2>Форма регистарации</h2>
<form action="signup.php" method="POST">
    <p>
        <p><strong>Ваш логин</strong></p>
        <input type="text" name="login" value="<?php echo @$data['login'];?>">
    </p>
    <p>
        <p><strong>Ваш email</strong></p>
        <input type="email" name="email" value="<?php echo @$data['email'];?>">
    </p>
    <p>
        <p><strong>Ваш пароль</strong></p>
        <input type="password" name="password" value="<?php echo @$data['password'];?>">
    </p>
    <p>
        <p><strong>Повторите пароль</strong></p>
        <input type="password" name="password_2">
    </p>
    <button type="submit" name="do_signup">Зарегистрироваться</button>
    <p id="text">Уже авторизованны? Можете <a href="login.php">перейти</a> на страницу входа</p>
</form>