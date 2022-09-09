<?php
    include '../db.php';
    
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $name = $data['name'];
    $author = $data['author'];
    $genre = $data['genre'];
    $publishing = $data['publishing'];
    $age = $data['age'];
    $price = $data['price'];
    $picture = $data['picture'];

    if ($name == '' || $author == '' || $genre == '' || $publishing == '' || $age == '' || $price == '' || $picture == '') {
        echo json_encode('При проверке данных произошла ошибка! Проверьте правильность введенных данных и повторите отправку. Помните, что варианты списка "Выберите автора", "Выберите жинр" и "Выберите издательство" не являются вариантами выбора!');
    }else{
        $query = 'INSERT INTO `books` (`book_id`, `book_name`, `autor_id`, `publishing_id`, `genre_id`, `age`, `purchase_price`, `sale_price`, `picture`) VALUES (NULL, "'.$name.'", "'.$author.'", "'.$publishing.'", "'.$genre.'", "'.$age.'", "85", "'.$price.'", "'.$picture.'")';
        $result = mysqli_query($link,$query);
        echo json_encode('Книга успешно добавлена!');
    }
    mysqli_close($link);
?>