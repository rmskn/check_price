-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 10 2021 г., 15:15
-- Версия сервера: 8.0.21
-- Версия PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `check_price`
--

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE `shops` (
  `id` int NOT NULL,
  `url` varchar(100) NOT NULL,
  `xpath_price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `xpath_title` text NOT NULL,
  `xpath_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id`, `url`, `xpath_price`, `xpath_title`, `xpath_image`) VALUES
(1, 'avito.ru', '//*[@id=\"price-value\"]/span/span[1]', '/html/body/div[3]/div[1]/div[3]/div[4]/div[1]/div[1]/div/div[1]/h1/span', '/html/body/div[3]/div[1]/div[3]/div[4]/div[1]/div[2]/div[1]/div[1]/div[1]/div[1]/div[1]/div'),
(2, 'wildberries.ru', '//*[@id=\"container\"]/div[1]/div[2]/div[3]/div[2]/div[2]/div/div/div/span', '//*[@id=\"container\"]/div[1]/div[2]/div[1]/div[1]/span[2]', '/html/body/div[1]/main/div[2]/div/div[2]/div[1]/div[2]/div[3]/div[1]/div/div[2]/div[2]/img[2]'),
(3, 'ozon.ru', '/html/body/div[1]/div/div[1]/div[5]/div[3]/div[2]/div[2]/div[1]/div/div/div/div[1]/div/div/div/div/div/div[2]/div[2]/span[1]/span', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int NOT NULL,
  `time` datetime NOT NULL,
  `text` varchar(100) NOT NULL,
  `lol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `time`, `text`, `lol`) VALUES
(11, '2021-07-09 20:15:11', 'kek lol кек лол', 4),
(12, '2021-07-09 20:24:34', 'kek lol кек лол', 4),
(13, '2021-07-09 20:46:28', 'kek lol кек лол', 4),
(14, '2021-07-09 20:48:29', 'kek lol кек лол', 4),
(15, '2021-07-09 20:49:29', 'kek lol кек лол', 4),
(16, '2021-07-09 20:50:29', 'kek lol кек лол', 4),
(17, '2021-07-09 20:51:29', 'kek lol кек лол', 4),
(18, '2021-07-09 20:52:29', 'kek lol кек лол', 4),
(19, '2021-07-09 20:53:29', 'kek lol кек лол', 4),
(20, '2021-07-09 20:54:29', 'kek lol кек лол', 4),
(21, '2021-07-09 20:55:29', 'kek lol кек лол', 4),
(22, '2021-07-09 20:56:29', 'kek lol кек лол', 4),
(23, '2021-07-09 20:57:29', 'kek lol кек лол', 4),
(24, '2021-07-09 20:58:29', 'kek lol кек лол', 4),
(25, '2021-07-09 20:59:29', 'kek lol кек лол', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tracking`
--

CREATE TABLE `tracking` (
  `id` int NOT NULL,
  `url` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_creating` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_registration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fullname`, `email`, `date_registration`) VALUES
(1, 'erosab', '$2y$10$OQ9CJ6N5bi5y5bdNCa5CtuQC/Y124E2sUSm3wAy2GgpKf/OOF49hO', 'Kirill', 'tremaskin2010@yandex.ru', '2021-07-08 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user_tracking`
--

CREATE TABLE `user_tracking` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `track` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_tracking`
--
ALTER TABLE `user_tracking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_tracking`
--
ALTER TABLE `user_tracking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
