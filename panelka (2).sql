-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 06 2024 г., 23:47
-- Версия сервера: 10.5.23-MariaDB-0+deb11u1
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fgpl`
--

-- --------------------------------------------------------

--
-- Структура таблицы `log_activity`
--

CREATE TABLE `log_activity` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IP` varchar(32) NOT NULL,
  `Status` int(11) NOT NULL,
  `Date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `log_activity`
--

INSERT INTO `log_activity` (`ID`, `UserID`, `IP`, `Status`, `Date`) VALUES
(24, 2, '172.71.99.185', 1, '2024-06-06 21:02:45'),
(25, 7, '172.68.138.248', 2, '2024-06-06 21:34:43'),
(26, 7, '172.68.138.249', 1, '2024-06-06 21:34:52'),
(27, 7, '172.68.138.248', 2, '2024-06-06 21:38:19'),
(28, 8, '172.71.103.209', 1, '2024-06-06 21:38:31'),
(29, 7, '172.68.138.249', 1, '2024-06-06 21:38:40'),
(30, 2, '172.71.103.149', 1, '2024-06-06 22:18:46'),
(31, 5, '162.158.94.71', 1, '2024-06-06 22:53:28'),
(32, 9, '172.71.102.176', 1, '2024-06-06 22:53:45'),
(33, 10, '172.71.182.163', 1, '2024-06-06 23:21:06'),
(34, 11, '172.70.85.92', 1, '2024-06-06 23:21:17'),
(35, 8, '172.71.98.92', 1, '2024-06-06 23:21:23'),
(36, 7, '108.162.221.149', 2, '2024-06-06 23:34:34'),
(37, 7, '108.162.221.149', 1, '2024-06-06 23:35:15'),
(38, 5, '172.69.151.22', 1, '2024-06-06 23:44:40');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `Title` varchar(32) NOT NULL,
  `Image` text NOT NULL,
  `Link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Title` varchar(124) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Link` varchar(124) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`ID`, `Date`, `Title`, `Link`) VALUES
(1, '2024-06-06 18:00:00', 'Конец техническим работам!', 'https://vk.com/no.code?w=wall-224625771_535');

-- --------------------------------------------------------

--
-- Структура таблицы `promo`
--

CREATE TABLE `promo` (
  `ID` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Skidka` int(11) NOT NULL,
  `Uses` int(11) NOT NULL,
  `Used` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE `purchases` (
  `BuyID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Title` varchar(32) NOT NULL,
  `Opisanie` varchar(1024) NOT NULL,
  `Image` text NOT NULL,
  `Date` varchar(32) NOT NULL,
  `Type` int(11) NOT NULL,
  `mode_ip` varchar(32) NOT NULL DEFAULT 'none',
  `laun_name` varchar(256) NOT NULL DEFAULT 'ARIZONA',
  `laun_background` varchar(256) NOT NULL DEFAULT '/engine/img/launcher/background.png',
  `laun_logo` varchar(256) NOT NULL DEFAULT '/engine/img/launcher/logo.png',
  `laun_install` varchar(256) NOT NULL DEFAULT 'Arizona RP',
  `laun_character` varchar(256) NOT NULL DEFAULT '/engine/img/launcher/character.png',
  `laun_site` varchar(256) NOT NULL DEFAULT 'none',
  `laun_forum` varchar(256) NOT NULL DEFAULT 'none',
  `laun_report` varchar(256) NOT NULL DEFAULT 'none',
  `laun_youtube` varchar(256) NOT NULL DEFAULT 'none',
  `laun_vkontakte` varchar(256) NOT NULL DEFAULT 'none',
  `laun_instagram` varchar(256) NOT NULL DEFAULT 'none',
  `laun_telegram` varchar(256) DEFAULT 'none',
  `laun_servers` varchar(256) NOT NULL DEFAULT 'none',
  `laun_ips` varchar(256) NOT NULL DEFAULT 'none',
  `laun_xdonate` int(11) DEFAULT 2,
  `laun_xpayday` int(11) NOT NULL DEFAULT 2,
  `Status` int(11) NOT NULL DEFAULT 0,
  `DownloadLink` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `purchases`
--

INSERT INTO `purchases` (`BuyID`, `UserID`, `Title`, `Opisanie`, `Image`, `Date`, `Type`, `mode_ip`, `laun_name`, `laun_background`, `laun_logo`, `laun_install`, `laun_character`, `laun_site`, `laun_forum`, `laun_report`, `laun_youtube`, `laun_vkontakte`, `laun_instagram`, `laun_telegram`, `laun_servers`, `laun_ips`, `laun_xdonate`, `laun_xpayday`, `Status`, `DownloadLink`) VALUES
(1, 7, 'Сайт ARIZONA RP 2023', '- Копия сайта Arizona RP 95%<br>\r\n- Карта штата/личный кабинет<br>\r\n- Бесплатные обновления сайта<br>\r\n- Последняя версия сайта\r\n- Полный доступ к сайту', 'https://suvorov-company.com/public/images/site-arizona.png', '2024-06-06 19:06:33', 2, 'none', 'ARIZONA', '/engine/img/launcher/background.png', '/engine/img/launcher/logo.png', 'Arizona RP', '/engine/img/launcher/character.png', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 2, 2, 0, '/engine/tovars/sitearznou.rar'),
(2, 7, 'ФОРУМ ARIZONA GAMES', '- Копия форума Arizona RP<br>\r\n- Заполненные разделы<br>\r\n- Баннеры должностей<br>\r\n- Бесплатные обновления<br>', 'https://suvorov-company.com/public/images/forum-arizona.png', '2024-06-06 19:06:40', 2, 'none', 'ARIZONA', '/engine/img/launcher/background.png', '/engine/img/launcher/logo.png', 'Arizona RP', '/engine/img/launcher/character.png', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 2, 2, 0, '/engine/tovars/forum.zip'),
(3, 1, 'Сайт ARIZONA RP 2023', '- Копия сайта Arizona RP 95%<br>\r\n- Карта штата/личный кабинет<br>\r\n- Бесплатные обновления сайта<br>\r\n- Последняя версия сайта\r\n- Полный доступ к сайту', 'https://suvorov-company.com/public/images/site-arizona.png', '2024-06-06 19:06:48', 2, 'none', 'ARIZONA', '/engine/img/launcher/background.png', '/engine/img/launcher/logo.png', 'Arizona RP', '/engine/img/launcher/character.png', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 2, 2, 0, '/engine/tovars/sitearznou.rar'),
(4, 7, 'Мод Arizona Games', '123', 'https://suvorov-company.com/public/images/mods-arizona.png', '2024-06-06 19:13:10', 1, '141.94.184.107:2765', 'ARIZONA', '/engine/img/launcher/background.png', '/engine/img/launcher/logo.png', 'Arizona RP', '/engine/img/launcher/character.png', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 2, 2, 0, '/engine/tovars/ModSell.zip'),
(5, 7, 'Лаунчер Arizona RP [CEF]', 'Оригинальный лаунчер Arizona RP с полной настройкой под ваш сервер.\r\n<br><br>\r\nВозможность менять:<br>\r\n- Список серверов (Максимальное число серверов: 24)<br>\r\n- Новости в лаунчере\r\n<br><br>\r\nДополнительно:<br>\r\n- Поддержка CEF', 'https://suvorov-company.com/public/img/launcher-vc.png', '2024-06-06 22:18:09', 3, '', 'ARIZONA', '/engine/img/launcher/background.png', '/engine/img/launcher/logo.png', 'Arizona RP', '/engine/img/launcher/character.png', 'https:/vk.com/no.code', 'https:/vk.com/no.code', 'https:/vk.com/no.code', 'https:/vk.com/no.code', 'https:/vk.com/no.code', 'https:/vk.com/no.code', 'https:/vk.com/no.code', 'Servachokkl', '141.94.184.107:2765', 2, 2, 0, 'null');

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE `shop` (
  `ID` int(11) NOT NULL,
  `Title` varchar(32) NOT NULL,
  `Image` text NOT NULL,
  `Cost` int(11) NOT NULL,
  `NewCost` int(11) NOT NULL,
  `Skidka` int(11) NOT NULL,
  `Type` int(11) NOT NULL DEFAULT 1,
  `Category` int(11) NOT NULL,
  `MinDiscreption` varchar(1024) NOT NULL,
  `SetupDiscreption` varchar(2048) NOT NULL,
  `DownloadLink` text NOT NULL,
  `VideoLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `shop`
--

INSERT INTO `shop` (`ID`, `Title`, `Image`, `Cost`, `NewCost`, `Skidka`, `Type`, `Category`, `MinDiscreption`, `SetupDiscreption`, `DownloadLink`, `VideoLink`) VALUES
(1, 'Лаунчер Arizona RP [CEF]', 'https://lk.no-codes.ru/engine/img/tovars/gamepc.png', 250, 150, 40, 3, 1, 'Оригинальный лаунчер Arizona RP с полной настройкой под ваш сервер.\r\n<br><br>\r\nВозможность менять:<br>\r\n- Список серверов (Максимальное число серверов: 24)<br>\r\n- Новости в лаунчере\r\n<br><br>\r\nДополнительно:<br>\r\n- Поддержка CEF', '1. Настройте лаунчер (настраивать лаунчер можно в любой момент, без повторной установки)<br><br>\r\n2. Скачайте лаунчер, после чего установите его через файл ArizonaLauncherSetup.exe<br><br>\r\n<strong>Дополнительно</strong><br>\r\n1. Сервер кикает с причиной: Версия клиента не подходит для игры на сервере<br>\r\nРешение: В инклуде nex-ac.inc нужно убрать, либо закомментировать строку: ac_KickWithCode(playerid, \"\", 0, 41);', 'null', 'KEL4bBxwCV8'),
(2, 'Мод Arizona Games', 'https://lk.no-codes.ru/engine/img/tovars/mod.png', 250, 150, 40, 1, 0, 'Мод Arizona RP для вашего проекта, частные обновления, новые системы.', '111', '/engine/tovars/ModSell.zip', 'sKp9488-m0k'),
(3, 'Сайт ARIZONA RP 2024', 'https://lk.no-codes.ru/engine/img/tovars/site.png', 150, 120, 20, 2, 2, '- Копия сайта Arizona RP 95%<br>\n- Бесплатные обновления сайта<br>\n- Последняя версия сайта\n- Полный доступ к сайту', '- Копия сайта Arizona RP 95%\r\n- Карта штата/личный кабинет\r\n- Бесплатные обновления сайта\r\n- Последняя версия сайта\r\n- Полный доступ к сайту', '/engine/tovars/sitearznou.rar', 'x66437gv9d'),
(4, 'ФОРУМ ARIZONA GAMES', 'https://lk.no-codes.ru/engine/img/tovars/forum.png', 200, 150, 20, 2, 2, '- Копия форума Arizona RP<br>\r\n- Заполненные разделы<br>\r\n- Баннеры должностей<br>\r\n- Бесплатные обновления<br>', '- Копия форума Arizona RP\r\n- Заполненные разделы\r\n- Баннеры должностей\r\n- Бесплатные обновления', '/engine/tovars/forum.zip', 'x66437gv9d'),
(5, 'ЛОГИ ARIZONA GAMES', 'https://lk.no-codes.ru/engine/img/tovars/logs.png', 190, 120, 30, 1, 2, '- Логирование всех действий<br>\r\n- Просмотр/поиск аккаунтов<br>\r\n- Удобный интерфейс<br>\r\n- Бесплатные обновления<br>', '- Логирование всех действий\r\n- Просмотр/поиск аккаунтов\r\n- Удобный интерфейс\r\n- Бесплатные обновления', '/engine/tovars/logs.zip', 'x66437gv9d'),
(6, 'VK GUARD', 'https://lk.no-codes.ru/engine/img/tovars/vk.png', 150, 100, 20, 1, 3, '- Удобный бот ВКонтакте<br>\r\n- Защита аккаунтов<br>\r\n- Легкая установка<br>\r\n- Бесплатные обновления<br>', '- Удобный бот ВКонтакте\r\n- Защита аккаунтов\r\n- Легкая установка\r\n- Бесплатные обновления', '/engine/tovars/guard.zip', 'x66437gv9d'),
(7, 'Fake Online', 'https://lk.no-codes.ru/engine/img/tovars/bots.png', 150, 75, 50, 1, 3, 'Fake Online (bots) На ваш сервер в любых колличествах', 'После покупки в папке будет Инструкиция', 'https://disk.yandex.by/d/5_JkNm0Br1Gtwg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(11) NOT NULL,
  `Theam` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Type` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Status` int(11) NOT NULL,
  `Data` varchar(124) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TicketID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`ID`, `Theam`, `Type`, `Status`, `Data`, `TicketID`) VALUES
(13, 'иии', 'sells', 1, '2024-06-06 21:42:19', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets_messages`
--

CREATE TABLE `tickets_messages` (
  `MessageID` int(11) NOT NULL,
  `UserMessage` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Admin` int(11) NOT NULL DEFAULT 0,
  `UserID` int(11) NOT NULL,
  `TicketID` int(11) NOT NULL,
  `UserSurName` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserLastName` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserAvatar` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tickets_messages`
--

INSERT INTO `tickets_messages` (`MessageID`, `UserMessage`, `Admin`, `UserID`, `TicketID`, `UserSurName`, `UserLastName`, `UserAvatar`, `Data`) VALUES
(18, 'ри', 0, 8, 13, 'Connor', 'Samson', '0', '2024-06-06 18:42:19'),
(19, 'ппп', 2, 8, 13, 'Connor', 'Samson', '0', '2024-06-06 18:42:28');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderID` varchar(256) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Method` text NOT NULL,
  `Date` varchar(32) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`ID`, `UserID`, `OrderID`, `Amount`, `Method`, `Date`, `Status`) VALUES
(1, 7, '6661dd8b4b559', 123123, 'GidPay', '2024-06-06 19:02:19', 1),
(2, 7, '6661ddf0dacdc', 111, 'GidPay', '2024-06-06 19:04:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LastName` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Balance` int(11) NOT NULL DEFAULT 0,
  `Admin` int(11) NOT NULL DEFAULT 0,
  `user_status` int(11) NOT NULL DEFAULT 1,
  `Theme` int(11) NOT NULL DEFAULT 1,
  `Avatar` int(11) NOT NULL DEFAULT 0,
  `Agent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Balance`, `Admin`, `user_status`, `Theme`, `Avatar`, `Agent`) VALUES
(1, 'Максим', 'Чуриков', 'maksimchurikov11@mail.ru', '6dd5d976afbcf4d7bccdefb3ca3a353f', 9880, 1, 1, 1, 0, 0),
(2, 'Hog', 'Hog', 'zhukovromann1985@gmail.com', 'fa2eb34c7a8c36b29e9c0836620db500', 0, 0, 1, 1, 4, 0),
(3, 'Никита', 'Пирогов', 'its.16bit@gmail.com', '1530f775afcc4af1831a6671ce46463f', 0, 1, 1, 1, 0, 0),
(4, 'Biber', 'Bib', 'biberov@internet.ru', '1fc3719aa9f5aa1f61cc7f3b31dbb306', 0, 0, 1, 1, 0, 0),
(5, 'Павел', 'Филатов', 'c11533806@gmail.com', '9a4cd921287bec14b5626c20d6f821bc', 0, 1, 1, 1, 0, 0),
(6, 'Роман', 'Роман', 'qusev659@gmail.com', '8c1e88e5159335087327357a6a135ed1', 0, 0, 1, 1, 0, 0),
(7, 'No', 'Code', 'no.code@gmail.com', '8c1e88e5159335087327357a6a135ed1', 1353895, 1, 1, 1, 11, 0),
(8, 'Connor', 'Samson', 'roma_denisov_yt@bk.ru', '9d222c7c20e60cd0eee7649c92910fd0', 0, 0, 1, 1, 0, 1),
(9, 'Vladik', 'Vladimirov', 'vladiiik1524@gmail.com', '7b4a55a83b72a66f86c5d69aa6e0eace', 0, 0, 1, 1, 0, 0),
(10, 'Treyz', 'Flare', 'treyzflare@gmail.com', '591d1fd9a2342271d3c9d875433ab688', 0, 0, 1, 1, 0, 0),
(11, 'Дмитрий', 'Рудько', 'akkso2ytyber@gmail.com', 'f4e4c3263de3eb899a196f46aedac082', 0, 0, 1, 1, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Индексы таблицы `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`BuyID`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Индексы таблицы `tickets_messages`
--
ALTER TABLE `tickets_messages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `promo`
--
ALTER TABLE `promo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `BuyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `shop`
--
ALTER TABLE `shop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `tickets_messages`
--
ALTER TABLE `tickets_messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
