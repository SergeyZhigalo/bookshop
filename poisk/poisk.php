<?php
    include '../db.php';
    
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $genre = $data['gen'];
    $author = $data['aut'];
    $poisk = $data['poi'];
    $publishing = $data['pub'];

    $query = 'SELECT books.picture, books.book_name, books.sale_price FROM books, author, publishing, genres_of_books WHERE books.book_name LIKE "%'.$poisk.'%" AND author.author LIKE "%'.$author.'%" AND publishing.publishing_name LIKE "%'.$publishing.'%" AND genres_of_books.genre LIKE "%'.$genre.'%" AND author.author_id=books.autor_id AND publishing.publishing_id=books.publishing_id AND genres_of_books.genre_id=books.genre_id';
    $result = mysqli_query($link,$query);
    if ($result) {
        $headers = array();   
        while ($header = mysqli_fetch_assoc($result))
           $main .= '<div id="book"><p><img src="'.$header['picture'].'" width="200" height="307"></p><p>'.$header['book_name'].'</p><p>Цена: '.$header['sale_price'].' руб.</p></div>';
           
        if ($main == '') {
            $main = '<p id="pusto">Совпадений не найдено!</p>';
        }
        mysqli_free_result($result);
    }

    echo json_encode($main);
    mysqli_close($link);
?>