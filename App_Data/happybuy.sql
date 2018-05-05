-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 05 2018 г., 17:14
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
-- Структура таблицы `apartments`
--

CREATE TABLE `apartments` (
  `Id` int(11) NOT NULL,
  `mainImage` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `countImage` int(20) NOT NULL,
  `room_Id` int(10) NOT NULL,
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
-- Дамп данных таблицы `apartments`
--

INSERT INTO `apartments` (`Id`, `mainImage`, `countImage`, `room_Id`, `areaLocation_Id`, `metro_Id`, `areaGeneral`, `areaKitchen`, `areaLiving`, `floor`, `floorGeneral`, `price`) VALUES
(1, 'imageforcontent.png', 10, 3, 6, 6, 10, 5, 1, 1, 5, 5000),
(33, 'url', 12, 1, 1, 1, 1, 12, 12, 12, 12, 1232);

-- --------------------------------------------------------

--
-- Структура таблицы `apartment_room`
--

CREATE TABLE `apartment_room` (
  `room_Id` int(11) NOT NULL,
  `apartment_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `arealocations`
--

CREATE TABLE `arealocations` (
  `Id` int(11) NOT NULL,
  `Text` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `arealocations`
--

INSERT INTO `arealocations` (`Id`, `Text`) VALUES
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
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `Id` int(11) NOT NULL,
  `Text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`Id`, `Text`) VALUES
(3, '1 комната'),
(4, '2 комнаты');

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
-- Индексы таблицы `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `countRoom` (`room_Id`),
  ADD KEY `metro_Id` (`metro_Id`),
  ADD KEY `areaLocation_Id` (`areaLocation_Id`);

--
-- Индексы таблицы `apartment_room`
--
ALTER TABLE `apartment_room`
  ADD KEY `apartment_Id` (`apartment_Id`),
  ADD KEY `room_Id` (`room_Id`);

--
-- Индексы таблицы `arealocations`
--
ALTER TABLE `arealocations`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Индексы таблицы `metro`
--
ALTER TABLE `metro`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT для таблицы `apartments`
--
ALTER TABLE `apartments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `arealocations`
--
ALTER TABLE `arealocations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `metro`
--
ALTER TABLE `metro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`areaLocation_Id`) REFERENCES `arealocations` (`Id`),
  ADD CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`metro_Id`) REFERENCES `metro` (`Id`);

--
-- Ограничения внешнего ключа таблицы `apartment_room`
--
ALTER TABLE `apartment_room`
  ADD CONSTRAINT `apartment_room_ibfk_1` FOREIGN KEY (`apartment_Id`) REFERENCES `apartments` (`Id`),
  ADD CONSTRAINT `apartment_room_ibfk_2` FOREIGN KEY (`room_Id`) REFERENCES `rooms` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
