-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 15 2022 г., 23:29
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ads_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `img_1` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img_2` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `img_3` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `price` mediumint NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `img_1`, `img_2`, `img_3`, `price`, `date`) VALUES
(32, 'Объявление 1', 'Описание объявления 1', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', 100, '2022-06-15 20:00:05'),
(33, 'Объявлений 2', 'Описание объявления 2', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', '', '', 200, '2022-06-15 20:01:09'),
(34, 'Объявлений 3', 'Описание объявления 3', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', '', '', 300, '2022-06-15 20:02:25'),
(35, 'Объявлений 4', 'Описание объявления 4', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', '', '', 400, '2022-06-15 20:03:37'),
(36, 'Объявлений 5', 'Описание объявления 5', 'https://bookflow.ru/wp-content/uploads/2016/04/programmist-768x475.jpg', '', '', 500, '2022-06-15 20:05:35'),
(37, 'Объявлений 6', 'Описание объявления 6', 'https://bookflow.ru/wp-content/uploads/2016/04/programmist-768x475.jpg', '', '', 600, '2022-06-15 20:07:54'),
(38, 'Объявлений 7', 'Описание объявления 7', 'https://bookflow.ru/wp-content/uploads/2016/04/programmist-768x475.jpg', '', '', 700, '2022-06-15 20:09:03'),
(39, 'Объявлений 8', 'Описание объявления 8', 'https://incrussia.ru/upload/iblock/9e3/9e3c3b5cc8801ce397490a5516bfbab5.png', 'https://bookflow.ru/wp-content/uploads/2016/04/programmist-768x475.jpg', '', 800, '2022-06-15 20:11:39'),
(40, 'Объявлений 9', 'Описание объявления 9', 'https://say-hi.me/wp-content/uploads/2014/09/programmer.jpg', 'https://bookflow.ru/wp-content/uploads/2016/04/programmist-768x475.jpg', '', 900, '2022-06-15 20:12:51'),
(41, 'Объявлений 10', 'Описание объявления 10', 'https://say-hi.me/wp-content/uploads/2014/09/programmer.jpg', 'https://bookflow.ru/wp-content/uploads/2016/04/programmist-768x475.jpg', '', 1000, '2022-06-15 20:13:36'),
(42, 'Объявлений 11', 'Описание объявления 11', 'https://say-hi.me/wp-content/uploads/2014/09/programmer.jpg', '', '', 1100, '2022-06-15 20:14:04'),
(43, 'Простое объявление', 'Описание простого объявления', 'https://3dnews.ru/assets/external/illustrations/2021/02/17/1032826/pay_cod.jpg', '', '', 599, '2022-06-15 20:15:56'),
(44, 'Объявлений', 'Описание объявления', 'https://3dnews.ru/assets/external/illustrations/2021/02/17/1032826/pay_cod.jpg', '', '', 425, '2022-06-15 20:21:05');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
