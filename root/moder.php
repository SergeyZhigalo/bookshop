<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleRoot.css">
    <title>Магазин книг</title>
</head>
<body>
<div id="login"><a href="../index.php">Вернуться на главную страницу</a><hr></div>
    <h3 class="zagolovok">Операции с книгами</h3>
	<div id="books" class="spoiler">
        <div id="poiskRoot"></div>
        <div id="allBooksModer"></div>
    </div>
    <h3 class="zagolovok">Просмотреть издательства</h3>
	<div id="all" class="spoiler">
        <div id="poiskPublishing">
            <p>
                <input type="text" id="poiskPublishingValue" placeholder="Поиск по издательству">
                <button type="button" id="poiskPublishingButton">Сортировка</button>
                <button type="button" id="poiskPublishingСlear">Сбросить</button>
            </p>
        </div>
        <div id="allPublishing"></div>
    </div>
    <h3 class="zagolovok">Добавить книгу</h3>
	<div id="addBook" class="spoiler">
        <div id="addBookOtvet"></div>
        <div id="addBookValue"></div>
        <div id="addBookButton">
            <p><button type="button" id="addBookSend">Добавить</button></p>
        </div>
    </div>
    <h3 class="zagolovok">Добавить жанр</h3>
	<div id="addGenre" class="spoiler">
        Введите новый жанр: <input type="text" id="addGenreValue">
        <div id="addGenreButton">
            <button type="button" id="addGenreSend">Добавить</button>
        </div>
    </div>
    <h3 class="zagolovok">Добавить автора</h3>
	<div id="addAuthor" class="spoiler">
        Введите нового автора: <input type="text" id="addAuthorValue">
        <div id="addAuthorButton">
            <button type="button" id="addAuthorSend">Добавить</button>
        </div>
    </div>
    <h3 class="zagolovok">Добавить издателя</h3>
	<div id="addPublishing" class="spoiler">
        Введите нового издателя: <input type="text" id="addPublishingValue">
        <div id="addPublishingButton">
            <button type="button" id="addPublishingSend">Добавить</button>
        </div>
    </div>
</body>
</html>
<script src="../libs/JQuery.js"></script>
<script src="script.js"></script>