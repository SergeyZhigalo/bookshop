<?php
    include '../db.php';

    $allBooksAdmin = false;
    $allBooksAdmin = $_GET['allBooksAdmin'];
    $allBooksModer = false;
    $allBooksModer = $_GET['allBooksModer'];
    $checkAllPublishing = false;
    $checkAllPublishing = $_GET['checkAllPublishing'];
    $checkAddBook = false;
    $checkAddBook = $_GET['checkAddBook'];
    $checkSearchSettings = false;
    $checkSearchSettings = $_GET['checkSearchSettings'];

    if ($allBooksAdmin) {
        $query = "SELECT books.book_id, books.book_name, author.author, genres_of_books.genre, publishing.publishing_name, books.age, books.sale_price, books.picture FROM author, books, genres_of_books, publishing WHERE author.author_id=books.autor_id AND publishing.publishing_id=books.publishing_id AND genres_of_books.genre_id=books.genre_id ";
        $result = mysqli_query($link,$query);
        if ($result) {
            $table = '<table border = 1px><tr><td>id книги</td><td>название книги</td><td>автор книги</td><td>жанр книги</td><td>издатель книги</td><td>год издания</td><td>цена книги</td><td>обложка</td><td id="t1">✍</td><td id="t2">❌</td></tr>';    
            while ($book = mysqli_fetch_assoc($result)){
                $table .= '<tr><td>'.$book['book_id'].'</td><td>'.$book['book_name'].'</td><td>'.$book['author'].'</td><td>'.$book['genre'].'</td><td>'.$book['publishing_name'].'</td><td>'.$book['age'].'</td><td>'.$book['sale_price'].'</td><td><img src="'.$book['picture'].'" width="50" height="77"></td><td><button type="button" name="change" value="'.$book['book_id'].'">Изменить</button></td><td><button type="button" name="delete" value="'.$book['book_id'].'">Удалить</button></td></tr>';
            }   
            $table .= '</table>';
    
            mysqli_free_result($result);
            echo json_encode($table);
        }
    }

    if ($allBooksModer) {
        $query = "SELECT books.book_id, books.book_name, author.author, genres_of_books.genre, publishing.publishing_name, books.age, books.sale_price, books.picture FROM author, books, genres_of_books, publishing WHERE author.author_id=books.autor_id AND publishing.publishing_id=books.publishing_id AND genres_of_books.genre_id=books.genre_id ";
        $result = mysqli_query($link,$query);
        if ($result) {
            $table = '<table border = 1px><tr><td>id книги</td><td>название книги</td><td>автор книги</td><td>жанр книги</td><td>издатель книги</td><td>год издания</td><td>цена книги</td><td>обложка</td><td id="t1">✍</td></tr>';    
            while ($book = mysqli_fetch_assoc($result)){
                $table .= '<tr><td>'.$book['book_id'].'</td><td>'.$book['book_name'].'</td><td>'.$book['author'].'</td><td>'.$book['genre'].'</td><td>'.$book['publishing_name'].'</td><td>'.$book['age'].'</td><td>'.$book['sale_price'].'</td><td><img src="'.$book['picture'].'" width="50" height="77"></td><td><button type="button" name="change" value="'.$book['book_id'].'">Изменить</button></td></tr>';
            }   
            $table .= '</table>';
    
            mysqli_free_result($result);
            echo json_encode($table);
        }
    }

    if ($checkAllPublishing) {
        $query = "SELECT * FROM `publishing`";
        $result = mysqli_query($link,$query);
        if ($result) {
            $table = '<table border = 1px><tr><td>id издательства</td><td>Издательство</td><td>Адрес</td><td>Телефон</td><td>Менеджер</td></tr>';           
            while ($publishing = mysqli_fetch_assoc($result)) 
                $table .= '<tr><td>'.$publishing['publishing_id'].'</td><td>'.$publishing['publishing_name'].'</td><td>'.$publishing['address'].'</td><td>'.$publishing['phone'].'</td><td>'.$genre['manager'].'</td></tr>';
            $table .= '</table>';
    
            mysqli_free_result($result);
            echo json_encode($table);
        }
    }

    if ($checkAddBook) {
        $addBook = '<p>Введите название книги: <input type="text" id="nameBook"></p>'; 

        $query = "SELECT * FROM author";
        $result = mysqli_query($link,$query);
        if ($result) {    
            $addBook .= '<p>Выберите автора книги: <select id="author"><option value="">Выберите автора</option>';   
            while ($book = mysqli_fetch_assoc($result))
                $addBook .= '<option value="'.$book['author_id'].'">'.$book['author'].'</option>';
            $addBook .= '</select></p>';
            mysqli_free_result($result); 
        }

        $query = "SELECT * FROM `genres_of_books`";
        $result = mysqli_query($link,$query);
        if ($result) {  
            $addBook .= '<p>Выберите жанр книги: <select id="genre"><option value="">Выберите жанр</option>';      
            while ($book = mysqli_fetch_assoc($result)) 
                $addBook .= '<option value="'.$book['genre_id'].'">'.$book['genre'].'</option>';
            $addBook .= '</select></p>';
            mysqli_free_result($result); 
        }

        $query = "SELECT * FROM `publishing`";
        $result = mysqli_query($link,$query);
        if ($result) {        
            $addBook .= '<p>Выберите издателя книги: <select id="publishing"><option value="">Выберите издательство издательства</option>';
            while ($book = mysqli_fetch_assoc($result)) 
                $addBook .= '<option value="'.$book['publishing_id'].'">'.$book['publishing_name'].'</option>';
            $addBook .= '</select></p>';
            mysqli_free_result($result); 
        }

        $addBook .= '<p>Введите год издания: <input type="text" id="age"></p><p>Введите цену: <input type="text" id="price"></p><p>Введите название обложки: <input type="text" id="picture"></p>';
        echo json_encode($addBook);
    }

    if ($checkSearchSettings) {
        $query = "SELECT `genre` FROM `genres_of_books`";
        $result = mysqli_query($link,$query);
        if ($result) {
            $header = '<p><select id="genrePoisk"><option value="">Все жанры</option>';
            while ($genre = mysqli_fetch_assoc($result)) 
                $header .= '<option value="'.$genre['genre'].'">'.$genre['genre'].'</option>';
            $header .= '</select> ';

            mysqli_free_result($result); 
        }
        
        $query = "SELECT `author` FROM `author`";
        $result = mysqli_query($link,$query);
        if ($result) {
            $header .= '<select id="authorPoisk"><option value="">Все авторы</option>';
            while ($author = mysqli_fetch_assoc($result)) 
                $header .= '<option value="'.$author['author'].'">'.$author['author'].'</option>';
            $header .= '</select> ';

            mysqli_free_result($result);
        }
        
        $header .= '<input type="text" id="poiskPoisk" placeholder="Поиск по названию книги"> ';
        
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
    }
    
    mysqli_close($link);