-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 11 2018 г., 15:52
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `happybuy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apartment`
--

CREATE TABLE `apartment` (
  `Id` int(11) NOT NULL,
  `mainImage` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `countImage` int(20) NOT NULL,
  `countRoom` int(10) NOT NULL,
  `areaLocation_Id` int(11) NOT NULL,
  `metro_Id` int(11) NOT NULL,
  `areaGeneral` int(11) NOT NULL,
  `areaKitchen` int(11) NOT NULL,
  `areaLiving` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `floorGeneral` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `apartment`
--

INSERT INTO `apartment` (`Id`, `mainImage`, `countImage`, `countRoom`, `areaLocation_Id`, `metro_Id`, `areaGeneral`, `areaKitchen`, `areaLiving`, `floor`, `floorGeneral`, `price`) VALUES
(1, 'imageforcontent.png', 10, 1, 6, 6, 10, 5, 1, 1, 5, 5000);

-- --------------------------------------------------------

--
-- Структура таблицы `arealocation`
--

CREATE TABLE `arealocation` (
  `Id` int(11) NOT NULL,
  `Text` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `arealocation`
--

INSERT INTO `arealocation` (`Id`, `Text`) VALUES
(1, 'Голосіївський'),
(2, 'Оболонський'),
(3, 'Печерський'),
(4, 'Подільський'),
(5, 'Святошинський'),
(6, 'Солом\'янський'),
(7, 'Шевченківський'),
(8, 'Дарницький'),
(9, 'Деснянський'),
(10, 'Дніпровський');

-- --------------------------------------------------------

--
-- Структура таблицы `metro`
--

CREATE TABLE `metro` (
  `Id` int(11) NOT NULL,
  `Text` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `metro`
--

INSERT INTO `metro` (`Id`, `Text`) VALUES
(1, 'Академмістечко'),
(2, 'Житомирська'),
(3, 'Святошин'),
(4, 'Нивки'),
(5, 'Берестейська'),
(6, 'Шулявська'),
(7, 'Політехнічний інститут'),
(8, 'Вокзальна'),
(9, 'Університет'),
(10, 'Театральна'),
(11, 'Хрещатик'),
(12, 'Арсенальна'),
(13, 'Дніпро'),
(14, 'Гідропарк'),
(15, 'Лівобережна'),
(16, 'Дарниця'),
(17, 'Чернігівська'),
(18, 'Лісова');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `login`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin', 'admin'),
(2, 'alex', 'alex@123', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `countRoom` (`countRoom`),
  ADD KEY `metro_Id` (`metro_Id`),
  ADD KEY `areaLocation_Id` (`areaLocation_Id`);

--
-- Индексы таблицы `arealocation`
--
ALTER TABLE `arealocation`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Индексы таблицы `metro`
--
ALTER TABLE `metro`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apartment`
--
ALTER TABLE `apartment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `arealocation`
--
ALTER TABLE `arealocation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `metro`
--
ALTER TABLE `metro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `apartment`
--
ALTER TABLE `apartment`
  ADD CONSTRAINT `apartment_ibfk_1` FOREIGN KEY (`areaLocation_Id`) REFERENCES `arealocation` (`Id`),
  ADD CONSTRAINT `apartment_ibfk_2` FOREIGN KEY (`metro_Id`) REFERENCES `metro` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
