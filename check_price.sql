-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 20 2021 г., 03:13
-- Версия сервера: 8.0.21
-- Версия PHP: 7.4.10

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
  `xpath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id`, `url`, `xpath`) VALUES
(1, 'avito.ru', '/html/body/div[3]/div[1]/div[3]/div[4]/div[2]/div[1]/div/div[1]/div/div[1]/div/div/span/span[1]'),
(2, 'wildberries.ru', '/html/body/div[1]/main/div[2]/div/div[2]/div[1]/div[2]/div[3]/div[2]/div[2]/div/div/div/span'),
(3, 'ozon.ru', '/html/body/div[1]/div/div[1]/div[5]/div[3]/div[2]/div[2]/div[1]/div/div/div/div[1]/div/div/div/div/div/div[2]/div[2]/span[1]/span');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
