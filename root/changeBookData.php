<?php
    include '../db.php';

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $id = $data['id'];
    $name = $data['name'];
    $author = $data['author'];
    $genre = $data['genre'];
    $publishing = $data['publishing'];
    $age = $data['age'];
    $price = $data['price'];
    $picture = $data['picture'];

    if ($name == '' || $age == '' || $price == '' || $picture == '') {
        echo json_encode('Поля не должны быть пустые');
    }else {
        $query = 'UPDATE `books` SET `book_name` = "'.$name.'", `age` = "'.$age.'", `sale_price` = "'.$price.'", `picture` = "'.$picture.'" WHERE `books`.`book_id` = '.$id.'';
        $result = mysqli_query($link,$query);

        if ($author != '') {
            $query = 'UPDATE `books` SET `autor_id` = "'.$author.'" WHERE `books`.`book_id` = '.$id.'';
            $result = mysqli_query($link,$query);
        }

        if ($publishing != '') {
            $query = 'UPDATE `books` SET `publishing_id` = "'.$publishing.'" WHERE `books`.`book_id` = '.$id.'';
            $result = mysqli_query($link,$query);
        }

        if ($genre != '') {
            $query = 'UPDATE `books` SET `genre_id` = "'.$genre.'" WHERE `books`.`book_id` = '.$id.'';
            $result = mysqli_query($link,$query);
        }

        echo json_encode('Данные изменены');
    }
    mysqli_close($link);
?>