<?php
    include '../db.php';

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $value = $data['value'];
    $check = $data['check'];

    if ($value == '') {
        echo json_encode('При проверке данных произошла ошибка! Введите данные и повторите отправку!');
    }else{
        switch ($check) {
            case 1:
                $query = 'SELECT `genre_id` FROM `genres_of_books`';
                $result = mysqli_query($link,$query);
                if($result)
                {
                    $id = array();
                    while ($user = mysqli_fetch_assoc($result))
                    {
                        $id[] = $user;
                    }
                    $testGenre = end($id);
                    $aiGenre = $testGenre['genre_id'] + 1; 
                }
                mysqli_free_result($result);
                $query = 'INSERT INTO `genres_of_books` (`genre_id`, `genre`) VALUES ("'.$aiGenre.'", "'.$value.'");';
            break;
            
            case 2:
                $query = 'SELECT `author_id` FROM `author`';
                $result = mysqli_query($link,$query);
                if($result)
                {
                    $id = array();
                    while ($user = mysqli_fetch_assoc($result))
                    {
                        $id[] = $user;
                    }
                    $testAuthor = end($id);
                    $aiAuthor = $testAuthor['author_id'] + 1; 
                }
                mysqli_free_result($result);
                $query = 'INSERT INTO `author` (`author_id`, `author`) VALUES ("'.$aiAuthor.'", "'.$value.'")';
            break;
            
            case 3:
                $query = 'SELECT `publishing_id` FROM `publishing` ';
                $result = mysqli_query($link,$query);
                if($result)
                {
                    $id = array();
                    while ($user = mysqli_fetch_assoc($result))
                    {
                        $id[] = $user;
                    }
                    $testPublishing = end($id);
                    $aiPublishing = $testPublishing['publishing_id'] + 1; 
                }
                mysqli_free_result($result);
                $query = 'INSERT INTO `publishing` (`publishing_id`, `publishing_name`, `address`, `phone`, `manager`) VALUES ("'.$aiPublishing.'", "'.$value.'", "", "", "");';
            break;
        }
        $result = mysqli_query($link,$query);
        echo json_encode('Данные успешно добавлены!');
    }
    mysqli_close($link);
?>