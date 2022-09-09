<?php
    include '../db.php';

    $value = $_GET['value'];

    $query = 'SELECT * FROM `publishing` WHERE `publishing_name` LIKE "%'.$value.'%"';
    $result = mysqli_query($link,$query);
    if ($result) {
        $table = '<table border = 1px><tr><td>id издательства</td><td>Издательство</td><td>Адрес</td><td>Телефон</td><td>Менеджер</td></tr>';           
        while ($publishing = mysqli_fetch_assoc($result)) 
            $table .= '<tr><td>'.$publishing['publishing_id'].'</td><td>'.$publishing['publishing_name'].'</td><td>'.$publishing['address'].'</td><td>'.$publishing['phone'].'</td><td>'.$genre['manager'].'</td></tr>';
        $table .= '</table>';
    }
    if ($table == '<table border = 1px><tr><td>id издательства</td><td>Издательство</td><td>Адрес</td><td>Телефон</td><td>Менеджер</td></tr></table>') {
        echo json_encode('<p id="pusto">Совпадений не найдено!</p>');
    }else {
        echo json_encode($table);
    }