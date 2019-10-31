-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 17 2019 г., 17:55
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `camp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lager`
--

CREATE TABLE `lager` (
  `id_lager` int(11) NOT NULL,
  `name_lager` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lager`
--

INSERT INTO `lager` (`id_lager`, `name_lager`, `adres`, `url`) VALUES
(2, 'Горки', 'Калужское шоссе, 60 км', 'https://mos-tour.com/images/cms/thumbs/d2dc720fbd18fd8f0c8c582400fa84d64c15030b/5_gorki_800_auto_0_100.jpg'),
(4, 'Зеленый шум', 'Симферопольское шоссе,97 км', 'https://mos-tour.com/images/cms/thumbs/d2dc720fbd18fd8f0c8c582400fa84d64c15030b/3_zelshum_800_auto_0_100.jpg'),
(5, 'Вятичи', 'Калужское ш.оссе, 86 км от МКАД', 'http://www.krist.ru/files/mToursGallery/930/46f683f2cd1ef21ec2e11deebb96595f_39775__700x500.jpg'),
(6, 'Огонек', 'Ярославское шоссе, 78 км от МКАД', 'http://www.eduklgd.ru/ou/zol/ogonek/%D0%9E%D0%B1%D1%89%D0%B0%D1%8F2_01.JPG'),
(7, 'Заря', 'Ленинградское шоссе, 28 км', 'https://www.best-camp.ru/images/camps/photo/18_edfaca4a19ac91e40a8c5fde16dfbef2.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `period`
--

CREATE TABLE `period` (
  `id_period` int(11) NOT NULL,
  `id_lager` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_stop` date NOT NULL,
  `name_period` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `period`
--

INSERT INTO `period` (`id_period`, `id_lager`, `date_start`, `date_stop`, `name_period`, `price`) VALUES
(1, 2, '2019-06-03', '2019-06-23', 'Квадростарт', 45000),
(2, 6, '2019-06-16', '2019-07-14', 'DEX', 25000),
(3, 4, '2019-08-08', '2019-08-28', 'Вокруг света', 33000),
(4, 5, '2019-06-10', '2019-06-20', 'Школа капитанов', 20000),
(5, 7, '2019-05-28', '2019-06-17', 'Властелин кольца', 35000);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lager`
--
ALTER TABLE `lager`
  ADD PRIMARY KEY (`id_lager`);

--
-- Индексы таблицы `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`id_period`),
  ADD KEY `id_lager` (`id_lager`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lager`
--
ALTER TABLE `lager`
  MODIFY `id_lager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `period`
--
ALTER TABLE `period`
  MODIFY `id_period` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `period`
--
ALTER TABLE `period`
  ADD CONSTRAINT `period_ibfk_1` FOREIGN KEY (`id_lager`) REFERENCES `lager` (`id_lager`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
