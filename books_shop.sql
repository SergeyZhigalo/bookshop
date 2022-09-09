-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 29 2020 г., 23:25
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `books_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `author`) VALUES
(1, 'Джон Харт'),
(2, 'Николай Леонов'),
(3, 'Алексей Макеев'),
(4, 'Валерия Вербина'),
(5, 'Сергей Александров'),
(6, 'Дуглас Перстон'),
(7, 'Иар Эльтеррус'),
(8, 'Ольга Грон'),
(9, 'Александр Беляев'),
(10, 'Рей Бредбери'),
(11, 'Девид Больдаччи'),
(12, 'Ден Браун'),
(13, 'Без автора (группа авторов)');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `publishing_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `autor_id`, `publishing_id`, `genre_id`, `age`, `purchase_price`, `sale_price`, `picture`) VALUES
(1, 'Король лжи', 1, 2, 1, 2002, 120, 300, '../picture/Korol_lzhi.jpg'),
(2, 'Пропала дочь президента', 2, 1, 1, 2012, 40, 90, '../picture/Propala_doch_prezidenta.jpg'),
(3, 'Игра по расписанию', 11, 2, 1, 2015, 50, 200, '../picture/Igra_po_raspisaniyu.jpg'),
(4, 'Московское время', 4, 5, 1, 1990, 50, 80, '../picture/Moskovskoe_vremya.jpg'),
(5, 'Цифровая крепость', 12, 1, 3, 2016, 150, 340, '../picture/Tsifrovaya_krepost.jpg'),
(6, 'Старая дама, или чехарда с ожерельем', 5, 1, 1, 2006, 50, 180, '../picture/Staraya_dama_ili_Cheharda_s_ozherelem.jpg'),
(7, 'Проект \"КРАКЕН\"', 6, 2, 1, 2016, 70, 320, '../picture/Proekt_Kraken.jpg'),
(8, 'Последняя битва', 7, 2, 1, 2012, 70, 160, '../picture/Poslednyaya_bitva.jpg'),
(9, 'Русская и советская фантастика', 5, 2, 2, 2000, 50, 80, '../picture/Russkaya_i_sovetskaya_fantastika.jpg'),
(10, 'Штурман космического демона', 13, 1, 2, 2016, 80, 250, '../picture/Shturman_kosmicheskogo_demona.jpg'),
(11, 'Голова профессора Доуэля', 9, 1, 2, 1990, 50, 80, '../picture/Golova_professora_Douelya.jpg'),
(12, 'Избранное. Великие шедевры под одной обложкой', 10, 2, 2, 2015, 100, 280, '../picture/Izbrannoe_Velikie_shedevri_pod_odnoy_jblozkoy.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `genres_of_books`
--

CREATE TABLE `genres_of_books` (
  `genre_id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres_of_books`
--

INSERT INTO `genres_of_books` (`genre_id`, `genre`) VALUES
(1, 'Детектив'),
(2, 'Фантастика'),
(3, 'Роман');

-- --------------------------------------------------------

--
-- Структура таблицы `publishing`
--

CREATE TABLE `publishing` (
  `publishing_id` int(11) NOT NULL,
  `publishing_name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `manager` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `publishing`
--

INSERT INTO `publishing` (`publishing_id`, `publishing_name`, `address`, `phone`, `manager`) VALUES
(1, 'Эксмо', '', '', ''),
(2, 'АСТ', '', '', ''),
(3, 'Просвещение', '', '', ''),
(4, 'Феникс', '', '', ''),
(5, 'Фламинго', '', '', ''),
(6, 'Питер', '', '', ''),
(7, 'Проспект', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1, 'admin', 'admin@mail.com', 12345),
(2, 'moder', 'moder@mail.com', 67890),
(3, 'user', 'user@mail.com', 111);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `publishing_id` (`publishing_id`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Индексы таблицы `genres_of_books`
--
ALTER TABLE `genres_of_books`
  ADD PRIMARY KEY (`genre_id`);

--
-- Индексы таблицы `publishing`
--
ALTER TABLE `publishing`
  ADD PRIMARY KEY (`publishing_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres_of_books` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`publishing_id`) REFERENCES `publishing` (`publishing_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
