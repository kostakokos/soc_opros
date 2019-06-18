-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 18 2019 г., 14:56
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.15-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `socopros`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `name`) VALUES
(1, 'Воздержался'),
(2, 'Да'),
(3, 'Нет');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `famaly` varchar(60) DEFAULT NULL,
  `patronymic` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `personal_data`
--

INSERT INTO `personal_data` (`id`, `user_id`, `name`, `famaly`, `patronymic`) VALUES
(1, 3, 'Коновалов', 'Виталий', 'Василевич'),
(2, 4, 'Василий', 'Алибабаевич', 'Петров'),
(3, 5, 'Василий', 'Абдула', 'Мухамедов'),
(4, 6, 'Анатолий', 'Абдула', ''),
(5, 7, 'Валентина', 'Гавриловна', '');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `social_poll_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `social_poll_id`, `description`) VALUES
(1, 1, 'Верите ли Вы в любовь с первого взгляда?'),
(2, 1, 'Часто ли Вы моетесь в бане?'),
(3, 1, 'Обливаетесь ли Вы холодной водой?'),
(4, 1, 'Любите ли Вы готовить?'),
(5, 2, 'Кормите ли вы бездомных кошек?'),
(6, 2, 'Одеваете ли Вы лыжи летом?'),
(7, 2, 'Часто ли Вы опаздываете на работу (учёбу)?'),
(8, 2, 'Часто ли вы посещаете ресторан?');

-- --------------------------------------------------------

--
-- Структура таблицы `question_user`
--

CREATE TABLE `question_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `questions_id` int(10) UNSIGNED NOT NULL,
  `answers_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `question_user`
--

INSERT INTO `question_user` (`id`, `user_id`, `questions_id`, `answers_id`) VALUES
(1, 3, 1, 1),
(2, 3, 2, 2),
(3, 3, 3, 2),
(4, 3, 4, 2),
(9, 4, 1, 2),
(10, 4, 2, 3),
(11, 4, 3, 1),
(12, 4, 4, 3),
(17, 5, 1, 1),
(18, 5, 2, 1),
(19, 5, 3, 2),
(20, 5, 4, 2),
(25, 6, 1, 1),
(26, 6, 2, 3),
(27, 6, 3, 2),
(28, 6, 4, 3),
(29, 7, 5, 1),
(30, 7, 6, 2),
(31, 7, 7, 2),
(32, 7, 8, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `sex`
--

CREATE TABLE `sex` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sex`
--

INSERT INTO `sex` (`id`, `name`) VALUES
(1, 'Мужской'),
(2, 'Женский');

-- --------------------------------------------------------

--
-- Структура таблицы `social_poll`
--

CREATE TABLE `social_poll` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `social_poll`
--

INSERT INTO `social_poll` (`id`, `name`) VALUES
(1, '№1'),
(2, '№2');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `social_poll_id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sex_id` tinyint(3) UNSIGNED NOT NULL,
  `years_old` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `social_poll_id`, `phone`, `email`, `sex_id`, `years_old`) VALUES
(3, 1, '+8 (666) 666 66 66', 'yuy@ypok.com', 1, 35),
(4, 1, '+8 (555) 555 55 55', 'qwerty@ypok.com', 1, 45),
(5, 1, '+8 (888) 888 88 88', 'joim123@ypok.com', 1, 55),
(6, 1, '+8 (111) 111 11 11', 'joim999@ypok.com', 1, 50),
(7, 2, '+8 (444) 444 44 44', 'yu777y@ypok.com', 2, 96);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user-user_id` (`user_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_poll_id` (`social_poll_id`);

--
-- Индексы таблицы `question_user`
--
ALTER TABLE `question_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_user-user_id` (`user_id`),
  ADD KEY `questions_id` (`questions_id`),
  ADD KEY `answers_id` (`answers_id`);

--
-- Индексы таблицы `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_poll`
--
ALTER TABLE `social_poll`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sex_id` (`sex_id`),
  ADD KEY `social_poll_id` (`social_poll_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `question_user`
--
ALTER TABLE `question_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `sex`
--
ALTER TABLE `sex`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `social_poll`
--
ALTER TABLE `social_poll`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `personal_data`
--
ALTER TABLE `personal_data`
  ADD CONSTRAINT `personal_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`social_poll_id`) REFERENCES `social_poll` (`id`);

--
-- Ограничения внешнего ключа таблицы `question_user`
--
ALTER TABLE `question_user`
  ADD CONSTRAINT `question_user_ibfk_1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `question_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `question_user_ibfk_3` FOREIGN KEY (`answers_id`) REFERENCES `answers` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`social_poll_id`) REFERENCES `social_poll` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
