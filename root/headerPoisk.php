<?php
    include '../db.php';
    $check = $_GET['check'];
    //-----
    $query = "SELECT `genre` FROM `genres_of_books`";
    $result = mysqli_query($link,$query);
    if ($result) {
        $header = '<p><select id="genrePoisk"><option value="">Все жанры</option>';
        while ($genre = mysqli_fetch_assoc($result)) 
            $header .= '<option value="'.$genre['genre'].'">'.$genre['genre'].'</option>';
        $header .= '</select> ';

        mysqli_free_result($result); 
    }
    //-----
    $query = "SELECT `author` FROM `author`";
    $result = mysqli_query($link,$query);
    if ($result) {
        $header .= '<select id="authorPoisk"><option value="">Все авторы</option>';
        while ($author = mysqli_fetch_assoc($result)) 
            $header .= '<option value="'.$author['author'].'">'.$author['author'].'</option>';
        $header .= '</select> ';

        mysqli_free_result($result);
    }
    //-----
    $header .= '<input type="text" id="poiskPoisk" placeholder="Поиск по названию книги"> ';
    //-----
    $query = "SELECT `publishing_name` FROM `publishing` ";
    $result = mysqli_query($link,$query);
    if ($result) {
        $header .= '<select id="publishingPoisk"><option value="">Все издательства</option>';
        while ($publishing = mysqli_fetch_assoc($result)) 
            $header .= '<option value="'.$publishing['publishing_name'].'">'.$publishing['publishing_name'].'</option>';
        mysqli_free_result($result);
    }
    $header .= '</select> <button type="button" name="sendData">Сортировка</button></p>';
    echo json_encode($header);
    mysqli_close($link);