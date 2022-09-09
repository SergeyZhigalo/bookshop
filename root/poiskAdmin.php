<?php
    include '../db.php';
    
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $genre = $data['gen'];
    $author = $data['aut'];
    $poisk = $data['poi'];
    $publishing = $data['pub'];

    $query = 'SELECT books.book_id, author.author, genres_of_books.genre, publishing.publishing_name, books.picture, books.book_name, books.sale_price, books.age FROM books, author, publishing, genres_of_books WHERE books.book_name LIKE "%'.$poisk.'%" AND author.author LIKE "%'.$author.'%" AND publishing.publishing_name LIKE "%'.$publishing.'%" AND genres_of_books.genre LIKE "%'.$genre.'%" AND author.author_id=books.autor_id AND publishing.publishing_id=books.publishing_id AND genres_of_books.genre_id=books.genre_id';
    $result = mysqli_query($link,$query);
    if ($result) {

        $table = '<table border = 1px><tr><td>id книги</td><td>название книги</td><td>автор книги</td><td>жанр книги</td><td>издатель книги</td><td>год издания</td><td>цена книги</td><td>обложка</td><td id="t1">✍</td><td id="t2">❌</td></tr>';    
        while ($book = mysqli_fetch_assoc($result)){
            $table .= '<tr><td>'.$book['book_id'].'</td><td>'.$book['book_name'].'</td><td>'.$book['author'].'</td><td>'.$book['genre'].'</td><td>'.$book['publishing_name'].'</td><td>'.$book['age'].'</td><td>'.$book['sale_price'].'</td><td><img src="'.$book['picture'].'" width="50" height="77"></td><td><button type="button" name="change" value="'.$book['book_id'].'">Изменить</button></td><td><button type="button" name="delete" value="'.$book['book_id'].'">Удалить</button></td></tr>';
        }   
        $table .= '</table>';
           
        if ($table == '<table border = 1px><tr><td>id книги</td><td>название книги</td><td>автор книги</td><td>жанр книги</td><td>издатель книги</td><td>год издания</td><td>цена книги</td><td>обложка</td><td id="t1">✍</td><td id="t2">❌</td></tr></table>') 
            $table = '<p id="pusto">Совпадений не найдено!</p>';
    }
    echo json_encode($table);
    mysqli_close($link);
?>