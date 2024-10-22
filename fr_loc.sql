-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MariaDB-11.2
-- Время создания: Окт 22 2024 г., 16:37
-- Версия сервера: 11.2.2-MariaDB
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fr_loc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `slug`, `created_at`) VALUES
(1, 'post-1', '2024-10-22 10:00:11'),
(2, 'post-2', '2024-10-22 11:00:11'),
(3, 'post-3', '2024-10-22 11:00:35');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_description`
--

CREATE TABLE `posts_description` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts_description`
--

INSERT INTO `posts_description` (`post_id`, `lang_id`, `title`, `content`) VALUES
(1, 1, 'Пост 1', 'Контент статьи 1'),
(1, 2, 'Article 1 en', 'Article 1 content'),
(1, 3, 'Article 1 fr', 'Contenu de l\'article 1'),
(2, 1, 'Пост 2', 'Контент статьи 2'),
(2, 2, 'Article 2 en', 'Article 2 content'),
(2, 3, 'Article 2 fr', 'Contenu de l\'article 2'),
(3, 1, 'Пост 3', 'Контент статьи 3'),
(3, 2, 'Article 3 en', 'Article 3 content'),
(3, 3, 'Article 3 fr', 'Contenu de l\'article 3');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'User 1', 'user1@mail.com', '$2y$10$C3dKVoY3SLYLT.x6vfZwC.kheM2VISpOq2lAkvnxXHFdD7YnUVm86', NULL, NULL),
(2, 'User 2', 'user2@mail.com', '$2y$10$zxRutaDcTT56wdMpoRYDj.AEUUdYPkbDUYyzs/KtLS0IAiVsYhPAm', NULL, NULL),
(4, 'Hanna Bentley', 'hyne@mailinator.com', '$2y$10$BfMMSvNytP7DNUwobVKhAOBlAnEXowBcFPZj2SCzyPsPNaw2t8sUu', NULL, NULL),
(5, 'User 3', 'user3@mail.com', '$2y$10$PMtpLCisYl./LBmZLOGYOuJTUxNZi.4YpRpAR.69sRBQKN56znIUi', NULL, NULL),
(6, 'User 4', 'user4@mail.com', '$2y$10$ozqabz8Emo9WvpiYp4dqdO1ibT6mdLDYhnDit9YIdTqkZ727sr.HW', NULL, NULL),
(7, 'Joan Mendoza', 'josyhozeq@mailinator.com', '$2y$10$KpsVlY2AwQW.pEiS8qxgzujM519gEFqO9TVMXVYtNljMxMprHkCR.', NULL, NULL),
(8, 'Elmo Cooper', 'pebery@mailinator.com', '$2y$10$qXBGNaZrWqFcdK5BIg2ya.zMI9jhgGhweAzrfL5Q9nYqmfBtSSLCW', NULL, NULL),
(9, 'Griffin Park', 'jevehiteq@mailinator.com', '$2y$10$9CavzKF/67n23Og6EZe7cuIe5xH8hoeWxIUoEgoR.7pJgMNWxu1Qi', NULL, NULL),
(10, 'Garrett Mcbride', 'cewepegafi@mailinator.com', '$2y$10$mgIRvLiorQTB6q8WcpRI8uL6SDAXsNj2.cJ8KJYqWsYPY/6f8aOaa', NULL, NULL),
(11, 'Brynne Garner', 'wybac@mailinator.com', '$2y$10$cQZFP2EVKMc2L.UGBum9.uIzoeWrtwmj1vr0yQH.y8VHb/KJGDN9O', NULL, NULL),
(12, 'Blossom Clayton', 'hukunuce@mailinator.com', '$2y$10$CALtNQ0iKX9001q99vG2kuKTDaN9V5gUHiKUpGcmnkmPC80eCz6Bq', NULL, NULL),
(13, 'Wendy Burgess', 'fetapez@mailinator.com', '$2y$10$eI9qEPolXQvG3fP4qFkgFOj1eJ1SxKOpqsSowFncWc6JM.Rc/ZemG', NULL, NULL),
(14, 'Rhona Adkins', 'kyvojehy@mailinator.com', '$2y$10$mlPTRrYZvGDOXWOi9FR7Ve4pKNf4RhA3RpZ/2FEIE.LMFnEvlJtfi', NULL, NULL),
(15, 'Herrod Sanchez', 'vywezon@mailinator.com', '$2y$10$4wgps7LQXVYC3UHHPRKso.0hNhXay5Fao8bPlzh/sAjfa76foXJzG', NULL, NULL),
(16, 'Gloria Allison', 'capojoka@mailinator.com', '$2y$10$D5oCwNxXcuW7275RQJGe0uurPfdOV93EJJi8uappvYWEBlrHxY.aq', NULL, NULL),
(17, 'Latifah Austin', 'hefi@mailinator.com', '$2y$10$flEXXWi/S8qiHyxdWALGWenuO2jKNP44.tjnhBPETWYSPiiWktR26', NULL, NULL),
(18, 'Flynn Sandoval', 'huzupu@mailinator.com', '$2y$10$ePlUlyFDuWlNhtMfTc8rY.iFDU/1NzC1QQ51883YieE6n90MEXDoG', NULL, NULL),
(19, 'Grady Vega', 'piweza@mailinator.com', '$2y$10$.Ig2/YsrUlafbdSkoRG0gOAvUwynw6Ae4uzBE6m.L9VpVXInjVMNW', NULL, NULL),
(20, 'Hiroko Howell', 'zojutizu@mailinator.com', '$2y$10$zAwkq5PZpao3P1rDZrpFPeLP0pMOjht6AHg7zUrvjI9pVXVuGt76q', NULL, NULL),
(21, 'Angelica Kent', 'bofyta@mailinator.com', '$2y$10$kb0qob6YGsRH86ergpMKbOoeJxLe5WXzN6E7JlxouqnQrqwgn0sOe', NULL, NULL),
(22, 'Clark Gregory', 'cemiguhune@mailinator.com', '$2y$10$fWR.XhfyPUKvIATd3OgRAeBGqzUpoR644r1DsS7qI.OGiFkaqNwBG', NULL, NULL),
(23, 'Simon Rowe', 'hosa@mailinator.com', '$2y$10$mQ5x410Cx8/2JCfoOLvqU.rX9C7VI/qKVxpq61cQmWc/CchJtOXv.', NULL, NULL),
(24, 'Thomas Armstrong', 'ravafenyse@mailinator.com', '$2y$10$hw2QkhjygQKAdxQ0teI8G.gUpqab8L3V.vmx5rqAYUkQ6eEkvLDE.', NULL, NULL),
(25, 'Stuart Snider', 'likijizy@mailinator.com', '$2y$10$bbIxXoWaIWeXBMfbK6csX.uC.5vo.TXxAR3LS.syl9qHZRX2fR1Qa', NULL, NULL),
(26, 'Blake Chandler', 'vize@mailinator.com', '$2y$10$nxN7uHhHTQDcKXDlLqEXcuMsD7.H7PZdarqAMUvPVHwO/tPsdox/e', NULL, NULL),
(27, 'Dylan Christensen', 'wame@mailinator.com', '$2y$10$B8EAyvEj2Yx5VSWpqy1Lyus3o7l6E8wj5Xv01ZG9ZAIyeqfDuY1Bu', NULL, NULL),
(28, 'Dominique Gilliam', 'desik@mailinator.com', '$2y$10$WsWqDCvLPVHisJndkytQT.J5FzFWcjEwiqewEFn/FZvY0hqcP2HWK', NULL, NULL),
(29, 'Tamekah Hubbard', 'zebisumexa@mailinator.com', '$2y$10$E5TcOqEjbdsTbeEdOn18KOjk/YZIDisGM4TNxM2TVdiIeFrz5EVOe', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `posts_description`
--
ALTER TABLE `posts_description`
  ADD PRIMARY KEY (`post_id`,`lang_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
