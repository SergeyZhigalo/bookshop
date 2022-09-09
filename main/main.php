<?php
    include '../db.php';
    $check = $_GET['check'];
    $query = "SELECT `picture`, `book_name`, `sale_price` FROM `books`";
    $result = mysqli_query($link,$query);
    if ($result) {
        $main;
        while ($book = mysqli_fetch_assoc($result)) 
            $main .= '<div id="book"><p><img src="'.$book['picture'].'" width="200" height="307"></p><p>'.$book['book_name'].'</p><p>Цена: '.$book['sale_price'].' руб.</p></div>';
        mysqli_free_result($result);
        echo json_encode($main);
        mysqli_close($link);
    }
?>