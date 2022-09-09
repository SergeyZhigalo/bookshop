<?php
    include '../db.php';

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $id = $data['id'];
    $type = $data['type'];

    switch ($type) {
        case 'change':
            $query = 'SELECT books.book_id, books.book_name, author.author, genres_of_books.genre, publishing.publishing_name, books.age, books.sale_price, books.picture FROM author, books, genres_of_books, publishing WHERE books.book_id = '.$id.' AND author.author_id=books.autor_id AND publishing.publishing_id=books.publishing_id AND genres_of_books.genre_id=books.genre_id';
            $result = mysqli_query($link,$query);
            if ($result) {
                $table = '<table border = 1px><tr><td>id книги</td><td>название книги</td><td>автор книги</td><td>жанр книги</td><td>издатель книги</td><td>год издания</td><td>цена книги</td><td>обложка</td></tr>';    
                while ($book = mysqli_fetch_assoc($result))
                {
                    $name = $book['book_name'];
                    $age = $book['age'];
                    $price = $book['sale_price'];
                    $picture = $book['picture'];
                    $table .= '<tr><td>'.$book['book_id'].'</td><td>'.$book['book_name'].'</td><td>'.$book['author'].'</td><td>'.$book['genre'].'</td><td>'.$book['publishing_name'].'</td><td>'.$book['age'].'</td><td>'.$book['sale_price'].'</td><td><img src="'.$book['picture'].'" width="50" height="77"></td></tr>';
                }   
                $table .= '</table>';

                $table .= '<br><p>Новое название книги: <input type="text" id="selectСhangeBookName" value="'.$name.'"></p><p>Выберите нового автора: <select id="selectСhangeAuthor"><option value="">Без изменений</option>';

                $query = 'SELECT * FROM `author`';
                $result = mysqli_query($link,$query);
                if ($result) {
                    while ($book = mysqli_fetch_assoc($result)) {
                        $table .= '<option value="'.$book['author_id'].'">'.$book['author'].'</option>';
                    } 
                    $table .= '</select></p><p>Выберите нового издателя: <select id="selectСhangePublishing"><option value="">Без изменений</option>';
                }
                mysqli_free_result($result);

                $query = 'SELECT * FROM `publishing`';
                $result = mysqli_query($link,$query);
                if ($result) {
                    while ($book = mysqli_fetch_assoc($result)) {
                        $table .= '<option value="'.$book['publishing_id'].'">'.$book['publishing_name'].'</option>';
                    } 
                    $table .= '</select></p><p>Выберите новый жанр: <select id="selectСhangeGenre"><option value="">Без изменений</option>';
                }
                mysqli_free_result($result);

                $query = 'SELECT * FROM `genres_of_books`';
                $result = mysqli_query($link,$query);
                if ($result) {
                    while ($book = mysqli_fetch_assoc($result)) {
                        $table .= '<option value="'.$book['genre_id'].'">'.$book['genre'].'</option>';
                    } 
                    $table .= '</select></p>';
                }
                $table .= '<p>Новый год издания: <input type="text" id="selectСhangeAge" value="'.$age.'"></p><p>Новая цена: <input type="text" id="selectСhangeSalePrice" value="'.$price.'"></p><p>Новая обложка: <input type="text" id="selectСhangePicture" value="'.$picture.'"></p><p><button type="button" id="buttonChangeBookValuesSend" name="changeData" value="'.$id.'">Изменить данные</button></p>';

                echo json_encode($table);
                mysqli_free_result($result); 
            }  
        break;
        
        case 'delete':
            $query = 'DELETE FROM `books` WHERE `books`.`book_id` = '.$id;
            $result = mysqli_query($link,$query);

            $query = "SELECT books.book_id, books.book_name, author.author, genres_of_books.genre, publishing.publishing_name, books.age, books.sale_price, books.picture FROM author, books, genres_of_books, publishing WHERE author.author_id=books.autor_id AND publishing.publishing_id=books.publishing_id AND genres_of_books.genre_id=books.genre_id ";
            $result = mysqli_query($link,$query);
            if ($result) {
                $table = '<table border = 1px><tr><td>id книги</td><td>название книги</td><td>автор книги</td><td>жанр книги</td><td>издатель книги</td><td>год издания</td><td>цена книги</td><td>обложка</td><td id="t1">✍</td><td id="t2">❌</td></tr>';    
                while ($book = mysqli_fetch_assoc($result))
                {
                    $table .= '<tr><td>'.$book['book_id'].'</td><td>'.$book['book_name'].'</td><td>'.$book['author'].'</td><td>'.$book['genre'].'</td><td>'.$book['publishing_name'].'</td><td>'.$book['age'].'</td><td>'.$book['sale_price'].'</td><td><img src="'.$book['picture'].'" width="50" height="77"></td><td><button type="button" name="change" value="'.$book['book_id'].'">Изменить</button></td><td><button type="button" name="delete" value="'.$book['book_id'].'">Удалить</button></td></tr>';
                }   
                $table .= '</table>';

                echo json_encode($table);
                mysqli_free_result($result);
            }
        break;
    }
    mysqli_close($link);
?>