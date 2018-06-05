-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 05 2018 г., 14:47
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.2.4

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
(1, 'apartment.jpg', 10, 3, 6, 6, 10, 5, 1, 1, 5, 1222),
(33, 'imageforcontent.png\r\n', 12, 4, 1, 1, 1, 12, 12, 12, 12, 1232),
(34, 'imageforcontent.png\r\n', 10, 4, 4, 14, 1, 12, 12, 12, 12, 1232),
(35, 'imageforcontent.png\r\n', 10, 5, 3, 12, 1, 12, 12, 12, 12, 1232),
(36, 'apartment.jpg', 10, 3, 6, 6, 10, 5, 1, 1, 5, 5000),
(37, 'apartment.jpg', 10, 3, 3, 6, 10, 5, 1, 1, 5, 5000),
(38, 'imageforcontent.png\r\n', 10, 3, 7, 9, 10, 5, 1, 1, 5, 1000),
(39, 'apartment.jpg', 10, 3, 7, 4, 10, 5, 1, 1, 5, 1000),
(40, 'imageforcontent.png\r\n', 1, 5, 1, 16, 50, 5, 20, 10, 12, 20000),
(41, 'imageforcontent.png', 1, 5, 1, 16, 100, 5, 20, 10, 12, 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `apartments_images`
--

CREATE TABLE `apartments_images` (
  `Id` int(11) NOT NULL,
  `apartment_Id` int(11) NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `apartments_images`
--

INSERT INTO `apartments_images` (`Id`, `apartment_Id`, `image_url`) VALUES
(4, 1, 'img-lg-1.png'),
(8, 1, 'img-lg-1.png'),
(9, 1, 'img-lg-1.png'),
(10, 1, 'img-lg-1.png'),
(11, 1, 'img-lg-1.png'),
(13, 41, 'img-lg-1.png'),
(14, 41, 'img-lg-1.png'),
(15, 41, 'img-lg-1.png'),
(16, 41, 'img-lg-1.png'),
(17, 41, 'img-lg-1.png'),
(18, 40, 'img-lg-1.png'),
(19, 40, 'img-lg-1.png'),
(20, 40, 'img-lg-1.png'),
(21, 40, 'img-lg-1.png'),
(22, 40, 'img-lg-1.png'),
(23, 39, 'img-lg-1.png'),
(24, 39, 'img-lg-1.png'),
(25, 39, 'img-lg-1.png'),
(26, 39, 'img-lg-1.png'),
(27, 39, 'img-lg-1.png');

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
-- Структура таблицы `role_users`
--

CREATE TABLE `role_users` (
  `Id` int(11) NOT NULL,
  `Value` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`Id`, `Value`) VALUES
(1, 'User'),
(2, 'Admin');

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
(3, '1 кімната'),
(4, '2 кімнати'),
(5, '3 кімнати'),
(6, '4 кімнати'),
(7, '5 кімнат');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` bit(1) NOT NULL,
  `token` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `roleUser_Id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `login`, `email`, `password`, `status`, `token`, `roleUser_Id`) VALUES
(33, 'def', 'def@aditus.info', '$2y$10$WYYxM1DPFbqs315EGpL2g.AXc0Tjgz69saxMrZ13V9sWBbT.L8ore', b'1', '', 2),
(37, 'user', 'def@aditus.info', '$2y$10$WYYxM1DPFbqs315EGpL2g.AXc0Tjgz69saxMrZ13V9sWBbT.L8ore', b'1', '', 1),
(51, 'asdqwe', 'frg@o3enzyme.com', '$2y$10$WjUiyXNaZtQyyNiJ7lqVx.po3Au.AIb3nvWcfgW35n3g.nQlsV/qu', b'1', '', 1),
(53, '123', 'asd@asd.asd', '$2y$10$zXmdYyyXANJsiRQG50AzyOFZZrjxCBPYD8QRl9q1Be32BQVpVRWYu', b'0', '4o3u6fp7kzqtpb8wv48xp15sly9nad', 1),
(54, 'alex', 'asdasda@asda.qwe', '$2y$10$rlVnaMZhvEeeDRO47epJEORrx53LZEcWND/JrPCVxtASDsnLCmOTG', b'0', 'jdfeqj2j2pamc9shze9tzd0sxkq7kw', 1);

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
-- Индексы таблицы `apartments_images`
--
ALTER TABLE `apartments_images`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `apartment_id` (`apartment_Id`);

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
-- Индексы таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`Id`);

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
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `roleUser_Id` (`roleUser_Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apartments`
--
ALTER TABLE `apartments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `apartments_images`
--
ALTER TABLE `apartments_images`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- AUTO_INCREMENT для таблицы `role_users`
--
ALTER TABLE `role_users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`areaLocation_Id`) REFERENCES `arealocations` (`Id`),
  ADD CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`metro_Id`) REFERENCES `metro` (`Id`),
  ADD CONSTRAINT `apartments_ibfk_3` FOREIGN KEY (`room_Id`) REFERENCES `rooms` (`Id`);

--
-- Ограничения внешнего ключа таблицы `apartments_images`
--
ALTER TABLE `apartments_images`
  ADD CONSTRAINT `apartments_images_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`Id`);

--
-- Ограничения внешнего ключа таблицы `apartment_room`
--
ALTER TABLE `apartment_room`
  ADD CONSTRAINT `apartment_room_ibfk_1` FOREIGN KEY (`apartment_Id`) REFERENCES `apartments` (`Id`),
  ADD CONSTRAINT `apartment_room_ibfk_2` FOREIGN KEY (`room_Id`) REFERENCES `rooms` (`Id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleUser_Id`) REFERENCES `role_users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
