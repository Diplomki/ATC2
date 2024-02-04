-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 29 2024 г., 06:10
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `atc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `user_id` bigint NOT NULL,
  `branch_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`user_id`, `branch_id`) VALUES
(2, 1),
(15, 1),
(16, 3),
(40, 1),
(43, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `attend`
--

CREATE TABLE `attend` (
  `id` tinyint NOT NULL,
  `attend` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attend`
--

INSERT INTO `attend` (`id`, `attend`) VALUES
(0, 'Н'),
(1, 'Б');

-- --------------------------------------------------------

--
-- Структура таблицы `branch`
--

CREATE TABLE `branch` (
  `id` int NOT NULL,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `branch`
--

INSERT INTO `branch` (`id`, `branch`) VALUES
(1, 'Филиал 1'),
(2, 'Филиал 2'),
(3, 'Филиал 3'),
(999, 'Для менеджера');

-- --------------------------------------------------------

--
-- Структура таблицы `classroom`
--

CREATE TABLE `classroom` (
  `classroom_id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` int DEFAULT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `classroom`
--

INSERT INTO `classroom` (`classroom_id`, `name`, `branch`, `active`) VALUES
(1, '3/515', 1, 1),
(2, '3/515', 2, 1),
(3, '3/520', 2, 1),
(4, '3/519', 2, 1),
(5, '3/516', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `day`
--

CREATE TABLE `day` (
  `day_id` tinyint NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `day`
--

INSERT INTO `day` (`day_id`, `name`) VALUES
(1, 'Понедельник'),
(2, 'Вторник'),
(3, 'Среда'),
(4, 'Четверг'),
(5, 'Пятница'),
(6, 'Суббота');

-- --------------------------------------------------------

--
-- Структура таблицы `gender`
--

CREATE TABLE `gender` (
  `gender_id` tinyint NOT NULL,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gender`
--

INSERT INTO `gender` (`gender_id`, `name`) VALUES
(1, 'Мужской'),
(2, 'Женский');

-- --------------------------------------------------------

--
-- Структура таблицы `grades`
--

CREATE TABLE `grades` (
  `grade_id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `subject_id` int NOT NULL,
  `grade` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attend` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `grade_accept`
--

CREATE TABLE `grade_accept` (
  `id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `subject_id` int NOT NULL,
  `grade` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attend` tinyint DEFAULT NULL,
  `branch_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `grade_accept`
--

INSERT INTO `grade_accept` (`id`, `user_id`, `subject_id`, `grade`, `date`, `attend`, `branch_id`) VALUES
(286, 18, 5, 0, '2023-12-07', 0, 1),
(287, 18, 5, 50, '2023-12-07', 1, 1),
(288, 18, 5, 0, '2023-12-15', 0, 1),
(289, 37, 5, 50, '2023-12-07', 1, 1),
(290, 18, 5, 70, '2023-12-15', 1, 1),
(291, 37, 5, 90, '2023-12-15', 1, 1),
(292, 37, 5, 0, '2023-12-07', 0, 1),
(293, 37, 5, 0, '2023-12-07', 0, 1),
(294, 37, 5, 0, '2023-12-07', 0, 1),
(295, 37, 5, 0, '2023-12-07', 0, 2),
(296, 37, 5, 0, '2023-12-15', 0, 1),
(297, 18, 6, 60, '2023-12-15', 1, 1),
(298, 37, 6, 70, '2023-12-15', 1, 1),
(299, 18, 5, 50, '2023-12-15', 1, 1),
(300, 37, 5, 50, '2023-12-15', 1, 1),
(301, 8, 2, 90, '2023-12-15', 1, 2),
(302, 8, 1, 90, '2023-12-15', 1, 2),
(303, 37, 5, 50, '2023-12-23', 1, 1),
(304, 18, 5, 90, '2023-12-23', 1, 1),
(305, 9, 6, 90, '2023-12-30', 0, 1),
(306, 18, 6, 50, '2023-12-30', 1, 1),
(307, 37, 6, 50, '2023-12-30', 1, 1),
(308, 9, 6, 90, '2023-12-30', 0, 1),
(309, 37, 6, 50, '2023-12-30', 0, 1),
(310, 9, 6, 100, '2023-12-30', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `gruppa`
--

CREATE TABLE `gruppa` (
  `gruppa_id` int NOT NULL,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_id` int NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `branch` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gruppa`
--

INSERT INTO `gruppa` (`gruppa_id`, `name`, `special_id`, `date_begin`, `date_end`, `branch`) VALUES
(1, '7В', 11, '2022-11-06', '2022-11-16', 1),
(2, '7А', 3, '2023-10-01', '2023-10-31', 1),
(3, '8В', 11, '2023-09-01', '2025-06-10', 1),
(4, '7А', 13, '2020-01-31', '2026-10-24', 2),
(5, '9А', 3, '2023-11-01', '2023-11-30', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `homework_parent`
--

CREATE TABLE `homework_parent` (
  `id` bigint NOT NULL,
  `homework_teacher_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` bigint NOT NULL,
  `gruppa_id` int NOT NULL,
  `student_id` bigint NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `subject_id` int NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_prepared` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `homework_parent`
--

INSERT INTO `homework_parent` (`id`, `homework_teacher_id`, `name`, `teacher_id`, `gruppa_id`, `student_id`, `date_begin`, `date_end`, `subject_id`, `file`, `file_prepared`) VALUES
(7, 13, 'asd', 6, 2, 8, '2023-12-21', '2023-12-31', 5, '1703641302_Оценки_1702869853.xlsx', '1703641317_Оценки_1702869853.xlsx'),
(8, 13, 'asd', 6, 2, 8, '2023-12-21', '2023-12-31', 5, '1703641302_Оценки_1702869853.xlsx', '1703641356_Оценки_1702869853.xlsx'),
(9, 12, 'asd', 6, 3, 9, '2023-12-21', '2023-12-29', 6, '1703555866_Оценки_1702869853.xlsx', '1703641998_ПРОЧИТАЙ!!!!!!!!!!!.txt');

-- --------------------------------------------------------

--
-- Структура таблицы `homework_teacher`
--

CREATE TABLE `homework_teacher` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `gruppa_id` int NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `subject_id` int NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `homework_teacher`
--

INSERT INTO `homework_teacher` (`id`, `name`, `user_id`, `gruppa_id`, `date_begin`, `date_end`, `subject_id`, `file`) VALUES
(8, 'test', 6, 3, '2023-12-01', '2023-12-20', 6, '1702873626_prolog.txt'),
(9, 'asd', 6, 1, '2023-12-01', '2023-12-29', 5, '1703043463_prolog.txt'),
(10, 'test', 6, 3, '2023-12-01', '2023-12-02', 6, '1703301362_prolog.txt'),
(11, 'test3', 6, 3, '2023-12-01', '2023-12-28', 6, '1703555545_prolog.txt'),
(12, 'asd', 6, 3, '2023-12-21', '2023-12-29', 6, '1703555866_Оценки_1702869853.xlsx'),
(13, 'asd', 6, 2, '2023-12-21', '2023-12-31', 5, '1703641302_Оценки_1702869853.xlsx'),
(14, 'asd', 6, 2, '2023-12-29', '2023-12-31', 6, '1703740738_ПРОЧИТАЙ!!!!!!!!!!!.txt');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_num`
--

CREATE TABLE `lesson_num` (
  `lesson_num_id` int NOT NULL,
  `name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_lesson` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lesson_num`
--

INSERT INTO `lesson_num` (`lesson_num_id`, `name`, `time_lesson`) VALUES
(1, '1 пара', '08:30:00'),
(2, '2 пара', '10:10:00'),
(3, '3 пара', '12:20:00'),
(4, '4 пара', '14:00:00'),
(5, '5 пара', '15:40:00');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson_plan`
--

CREATE TABLE `lesson_plan` (
  `lesson_plan_id` int NOT NULL,
  `gruppa_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `user_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lesson_plan`
--

INSERT INTO `lesson_plan` (`lesson_plan_id`, `gruppa_id`, `subject_id`, `user_id`) VALUES
(1, 1, 2, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `notice`
--

CREATE TABLE `notice` (
  `id` int NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `child_id` bigint DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notice`
--

INSERT INTO `notice` (`id`, `text`, `subject_id`, `user_id`, `child_id`, `date`) VALUES
(13, 'Оплатите до указанного срока по предмету:', 5, 10, 9, '2023-12-20'),
(14, 'Оплатите до указанного срока по предмету:', 4, 10, 18, '2023-12-29'),
(15, 'Оплатите до указанного срока по предмету:', 2, 38, 7, '2023-12-13'),
(16, 'Оплатите до указанного срока по предмету:', 3, 11, 8, '2023-12-16'),
(17, 'Оплатите до указанного срока по предмету:', 1, 10, 7, '2023-12-30');

-- --------------------------------------------------------

--
-- Структура таблицы `otdel`
--

CREATE TABLE `otdel` (
  `otdel_id` smallint NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `otdel`
--

INSERT INTO `otdel` (`otdel_id`, `name`, `active`) VALUES
(1, 'Математический', 1),
(2, 'Гуманитарный', 1),
(4, 'Естественные науки', 1),
(5, 'test', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `parent`
--

CREATE TABLE `parent` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `child_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parent`
--

INSERT INTO `parent` (`id`, `user_id`, `child_id`) VALUES
(1, 10, 7),
(2, 10, 9),
(3, 11, 8),
(4, 38, 9),
(9, 10, 7),
(10, 39, NULL),
(11, 39, 8),
(12, 38, 7),
(13, 10, 42),
(14, 46, NULL),
(15, 46, 42),
(16, 47, NULL),
(17, 10, 18),
(18, 10, 37),
(19, 11, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `child_id` bigint DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `count` int DEFAULT NULL,
  `tab` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payment_archive`
--

CREATE TABLE `payment_archive` (
  `id` int NOT NULL,
  `parent_id` bigint NOT NULL,
  `child_id` bigint NOT NULL,
  `subject_id` int DEFAULT NULL,
  `count` int NOT NULL,
  `tab` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `attend` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `payment_archive`
--

INSERT INTO `payment_archive` (`id`, `parent_id`, `child_id`, `subject_id`, `count`, `tab`, `price`, `attend`) VALUES
(37, 10, 7, 1, 65, '1699588297ПРОЧИТАЙ!!!!!!!!!!!.txt', 5000, 1),
(38, 10, 7, 2, 11, '1699588303ПРОЧИТАЙ!!!!!!!!!!!.txt', 5000, 1),
(39, 10, 7, 3, 5, '1699588308ПРОЧИТАЙ!!!!!!!!!!!.txt', 5000, 1),
(40, 10, 7, 4, 1, '1699588314ПРОЧИТАЙ!!!!!!!!!!!.txt', 5000, 1),
(41, 10, 7, 5, 1, '1699588319ПРОЧИТАЙ!!!!!!!!!!!.txt', 5000, 1),
(42, 10, 7, 6, 10, '1699588325ПРОЧИТАЙ!!!!!!!!!!!.txt', 5000, 1),
(77, 10, 9, 1, 25, '1699682076ПРОЧИТАЙ!!!!!!!!!!!.txt', 50000, 1),
(78, 10, 9, 5, 8, '1699682118ПРОЧИТАЙ!!!!!!!!!!!.txt', 50000, 1),
(79, 10, 9, 6, 23, '1699783960ПРОЧИТАЙ!!!!!!!!!!!.txt', 20000, 1),
(93, 10, 9, 3, 10, '1700012243ПРОЧИТАЙ!!!!!!!!!!!.txt', 50000, 1),
(94, 10, 9, 4, 10, '1700012553ПРОЧИТАЙ!!!!!!!!!!!.txt', 50000, 1),
(95, 10, 42, 6, 9, '1701246542iqstudy.txt', 50000, 1),
(96, 10, 42, 5, 8, '1701246675', 50000, 1),
(97, 10, 18, 5, 1, '1701912986iqstudy.zip', 50000, 1),
(98, 10, 18, 1, 10, '1701913128iqstudy.txt', 50000, 1),
(99, 10, 37, 5, 1, '1702611363iqstudy.txt', 50000, 1),
(100, 10, 37, 6, 47, '1702611608iqstudy.txt', 250000, 1),
(101, 10, 18, 6, 48, '1702611617iqstudy.txt', 250000, 1),
(102, 11, 8, 1, 9, '1702612736iqstudy.txt', 50000, 1),
(103, 11, 8, 2, 89, '1702612783iqstudy.txt', 450000, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role_id` tinyint NOT NULL,
  `sys_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role_id`, `sys_name`, `name`, `active`) VALUES
(2, 'admin', 'Администратор', 1),
(3, 'manager', 'Менеджер', 1),
(4, 'teacher', 'Преподаватель', 1),
(5, 'student', 'Студент', 1),
(6, 'procreator', 'Родитель', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int NOT NULL,
  `lesson_plan_id` int NOT NULL,
  `day_id` tinyint NOT NULL,
  `lesson_num_id` int NOT NULL,
  `classroom_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `lesson_plan_id`, `day_id`, `lesson_num_id`, `classroom_id`) VALUES
(1, 1, 2, 1, 1),
(2, 1, 2, 2, 5),
(3, 1, 2, 3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `special`
--

CREATE TABLE `special` (
  `special_id` int NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otdel_id` smallint NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `special`
--

INSERT INTO `special` (`special_id`, `name`, `otdel_id`, `active`) VALUES
(3, 'А', 1, 1),
(10, 'Б', 1, 1),
(11, 'В', 1, 1),
(12, 'Г', 2, 1),
(13, 'Д', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `user_id` bigint NOT NULL,
  `gruppa_id` int NOT NULL,
  `num_zach` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`user_id`, `gruppa_id`, `num_zach`) VALUES
(7, 2, '0'),
(8, 2, '0'),
(9, 3, '0'),
(18, 1, '0'),
(37, 1, '0'),
(42, 3, '0'),
(45, 5, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `subject_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otdel_id` smallint NOT NULL,
  `hours` smallint NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `otdel_id`, `hours`, `active`) VALUES
(1, 'Геометрия', 1, 40, 1),
(2, 'Алгебра', 1, 40, 1),
(3, 'Литература', 2, 40, 1),
(4, 'Физика', 1, 45, 1),
(5, 'География', 4, 50, 1),
(6, 'Биология', 4, 60, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher`
--

CREATE TABLE `teacher` (
  `user_id` bigint NOT NULL,
  `otdel_id` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `teacher`
--

INSERT INTO `teacher` (`user_id`, `otdel_id`) VALUES
(17, 1),
(22, 1),
(44, 1),
(48, 1),
(12, 2),
(25, 2),
(41, 2),
(6, 4),
(14, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` bigint NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_id` tinyint NOT NULL,
  `birthday` date DEFAULT NULL,
  `role_id` tinyint NOT NULL,
  `branch_id` int DEFAULT NULL,
  `active` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `patronymic`, `login`, `pass`, `gender_id`, `birthday`, `role_id`, `branch_id`, `active`) VALUES
(2, 'Смит', 'Джон', 'Тимофеевич', 'admin', '$2y$10$kkAc3Z1kd7baFhhpVj98feshP7nhhY8IeT7L04xY9I4PuuhKT3Aii', 1, '2023-11-01', 2, 1, 1),
(6, 'Ершов', 'Максимилиан', 'Иосифович', 'ershov', '$2y$10$kctvKQHKBEkiswKKFpqCf.yj9trLzGny8Q3k.29cQWgny.1N.wpzy', 1, '2000-03-12', 4, 1, 1),
(7, 'Носов', 'Клим', 'Алексеевич', 'nosov', '$2y$10$nxM0K958xhTYCpJekKAVzOLLTIkYiZs.R/VbUQ8VcX2dels8mEn5i', 1, '2007-05-25', 5, 1, 1),
(8, 'Шаров', 'Корней', 'Ростиславович', 'sharov', '$2y$10$hosMfj/tIw48P0tYCaQ1IuBwj6UYV9klgDsaVh/t5SxDcgPjAb7WS', 1, '2023-10-01', 5, 1, 1),
(9, 'Антонова', 'Асида', 'Игнатьевна', 'asida', '$2y$10$TE2o./47eSpX8WaCSQ.O2uzlks.vLNjIjE6tv5qtcg7eavAYMqO0q', 2, '2003-02-20', 5, 1, 1),
(10, 'Беспалов', 'Агафон', 'Даниилович', 'bespalov', '$2y$10$z11Uv1aXozyKpN07XKTNm.VTf9AHH95kfmyOtmOvuVPuoSh4SyGTq', 1, '1980-12-12', 6, 1, 1),
(11, 'Карпов', 'Антон', 'Онисимович', 'karpov', '$2y$10$yOW62BB4F8KYnC/Zs95xGeI7HnlX2Rxpdu9qkVInJDRV0igjzbZpq', 1, '1980-11-12', 6, 1, 1),
(12, 'Гришин', 'Мечеслав', 'Христофорович', 'grishin', '$2y$10$HiUHq9eyUODAWKKvKb072eJFP2mmX993WlE2yvSHlx0X6JqMftKEe', 1, '2002-12-20', 4, 2, 1),
(14, 'Макаров', 'Михаил', 'Робертович', 'makarov', '$2y$10$b2rzVJlTsd5hthE.zcAeVuAiFRilDqXrCWGTpn3p6DXxZQNX6v1Di', 1, '1977-06-05', 4, 1, 1),
(15, 'Андреев ', 'Венедикт ', 'Святославович', 'admin2', '$2y$10$mFlJsQgNvDQ27XfADrMh8O9OQA47f2gLmqYdwGeg8SpsvdoRUX95S', 1, '1975-08-03', 2, 2, 1),
(16, 'Лебедев', 'Альфред ', 'Викторович', 'admin3', '$2y$10$mFlJsQgNvDQ27XfADrMh8O9OQA47f2gLmqYdwGeg8SpsvdoRUX95S', 1, '1997-07-12', 2, 3, 1),
(17, 'Соловьёв', 'Бронислав', 'Федотович', 'soloviev', '$2y$10$hwoeqR.h7cOSrs8mPHnbm.bmDXUd/2i4Xg968skfMTFQ.gQystHdC', 1, '1999-05-14', 4, 2, 1),
(18, 'Кошелев', 'Эрнест', 'Лаврентьевич', 'koshelev', '$2y$10$mlU3F7DiiEWPXzdfjPiHseYtchL0YITkhg9XOGz72xF.klefiTgnO', 1, '2005-12-15', 5, 1, 1),
(19, 'Дроздов ', 'Арсений', 'Михайлович', 'manager', '$2y$10$b2rzVJlTsd5hthE.zcAeVuAiFRilDqXrCWGTpn3p6DXxZQNX6v1Di', 1, '1997-07-12', 3, 999, 1),
(22, 'Гурьев', 'Артур', 'Протасьевич', 'gurevvv', '$2y$10$Jg6maoeW.bxJGgciUu0/O.C68W13QqU6k14doNZnQhaF/sQ0pwNBW', 1, '2023-10-01', 4, 1, 1),
(25, 'Буров', 'Георгий', 'Матвеевич', 'burov', '$2y$10$7yGUP8SL7XyoEtvd5MPE1O9FBSiNSJ0NMp08qReKOAoySnAGPye6G', 1, '1999-05-15', 4, 1, 1),
(37, 'Жукова', 'Адельфина', 'Артемова', 'jykova', '$2y$10$LpJ3CgZk6cmh9B.9juW0vuZBxmcVlG.JMqyJKkc5/8QtfkqRpP0fa', 2, '2003-05-28', 5, 1, 1),
(38, 'Соловьёва', 'Лея', 'Георгьевна', 'solovieva', '$2y$10$iH5wNehSfohUxfUTwKSNB.F01vhtYuddPbxUNZADQqgf5weDX7is2', 2, '2000-05-18', 6, 1, 1),
(39, 'Шестаков', 'Бенедикт', 'Русланович', 'shestakov', '$2y$10$sSfncxp1TVq5wkKWWy/F4.6g1XKTimJXz2QfKQmNcGFW.Nkib5guq', 1, '2002-10-02', 6, 2, 1),
(40, 'asd', 'asd', 'asd', 'asd', '$2y$10$1k/j0P2IBoiIbU5LHo9Xju6RrUMraewrdvIPp8403qeYj8pcp3gVa', 1, '2023-11-01', 2, 2, 1),
(41, 'test', 'test', 'test', 'test', '$2y$10$oI8gKBvxGYd0bIf38EEQJulovcwqRfm38DRADUFKQdeTJqbFkyLci', 1, '2023-11-02', 2, 1, 1),
(42, 'asd', 'asd', 'asd', 'asd', '$2y$10$B0l.SdHgBelVzAQ1K2yWqu6KihUswbrTDT3YahUj6xzKVF7KqnlqC', 1, '2023-11-01', 5, 1, 1),
(43, 'test', 'test', 'test', '123', '$2y$10$noakuWFcWyR//2r.Kbdtle.IWXC06ZgjSVTCnt0NZD.hTHGBQgp5m', 1, '2023-12-01', 2, 2, 1),
(44, 'asdsad', 'sadsadas', 'asdasdas', 'asdasdasdsadsa', '$2y$10$3MOMIhCAMcK9L0bfYg2ZmOvW.aQGunvpFv4ZOEU/GjH106R6H3xU2', 1, '2023-12-02', 4, 1, 1),
(45, 'sadasd', 'sadasdas', 'dsadsadsad', 'asdasd', '$2y$10$A8zvAm8fL8D5P0A/rmFqm.3Q5Z0n4FFJYWavUrGoZgg2WqP5FZTUS', 1, '2023-12-01', 5, 1, 1),
(46, 'assdasd', 'sdasd', 'asdsad', '1234', '$2y$10$14s0XDLAKCCPTWX2l38H2.W7bfOJnQnO4skBIdSGAP70/mIwob4wK', 1, '2023-12-01', 6, 1, 1),
(47, 'asdsadasd', 'asdsadasdasd', 'asdasdasdasd', 'asdfd', '$2y$10$DTiIrLjw3ROCQmwTfqEiqOik2DMck67pDF3UiwDJi1WLuiL/r8zxG', 1, '2023-12-01', 6, 1, 1),
(48, 'test2', 'test2', 'test2', 'test2', '$2y$10$KgMM268dqpwL.oRtnM.o/.opCP9heolbsII0x2tKGHuHQF9FeFijy', 1, '2023-12-21', 4, 2, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Индексы таблицы `attend`
--
ALTER TABLE `attend`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`classroom_id`),
  ADD KEY `branch` (`branch`);

--
-- Индексы таблицы `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`day_id`);

--
-- Индексы таблицы `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Индексы таблицы `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `attend` (`attend`);

--
-- Индексы таблицы `grade_accept`
--
ALTER TABLE `grade_accept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `attend` (`attend`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Индексы таблицы `gruppa`
--
ALTER TABLE `gruppa`
  ADD PRIMARY KEY (`gruppa_id`),
  ADD KEY `special_id` (`special_id`),
  ADD KEY `branch` (`branch`);

--
-- Индексы таблицы `homework_parent`
--
ALTER TABLE `homework_parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gruppa_id` (`gruppa_id`),
  ADD KEY `homework_teacher_id` (`homework_teacher_id`),
  ADD KEY `homework_parent_ibfk_3` (`teacher_id`),
  ADD KEY `homework_parent_ibfk_2` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Индексы таблицы `homework_teacher`
--
ALTER TABLE `homework_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `gruppa_id` (`gruppa_id`);

--
-- Индексы таблицы `lesson_num`
--
ALTER TABLE `lesson_num`
  ADD PRIMARY KEY (`lesson_num_id`);

--
-- Индексы таблицы `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD PRIMARY KEY (`lesson_plan_id`),
  ADD KEY `gruppa_id` (`gruppa_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `child_id` (`child_id`);

--
-- Индексы таблицы `otdel`
--
ALTER TABLE `otdel`
  ADD PRIMARY KEY (`otdel_id`);

--
-- Индексы таблицы `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `child_id` (`child_id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Индексы таблицы `payment_archive`
--
ALTER TABLE `payment_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `day_id` (`day_id`),
  ADD KEY `lesson_plan_id` (`lesson_plan_id`),
  ADD KEY `lesson_plan_num` (`lesson_num_id`);

--
-- Индексы таблицы `special`
--
ALTER TABLE `special`
  ADD PRIMARY KEY (`special_id`),
  ADD KEY `otdel_id` (`otdel_id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gruppa_id` (`gruppa_id`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `otdel_id` (`otdel_id`);

--
-- Индексы таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `otdel_id` (`otdel_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_ibfk_1` (`gender_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT для таблицы `classroom`
--
ALTER TABLE `classroom`
  MODIFY `classroom_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `day`
--
ALTER TABLE `day`
  MODIFY `day_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT для таблицы `grade_accept`
--
ALTER TABLE `grade_accept`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT для таблицы `gruppa`
--
ALTER TABLE `gruppa`
  MODIFY `gruppa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `homework_parent`
--
ALTER TABLE `homework_parent`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `homework_teacher`
--
ALTER TABLE `homework_teacher`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `lesson_num`
--
ALTER TABLE `lesson_num`
  MODIFY `lesson_num_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `lesson_plan`
--
ALTER TABLE `lesson_plan`
  MODIFY `lesson_plan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `otdel`
--
ALTER TABLE `otdel`
  MODIFY `otdel_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `parent`
--
ALTER TABLE `parent`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT для таблицы `payment_archive`
--
ALTER TABLE `payment_archive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `role_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `special`
--
ALTER TABLE `special`
  MODIFY `special_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `student` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`attend`) REFERENCES `attend` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `grade_accept`
--
ALTER TABLE `grade_accept`
  ADD CONSTRAINT `grade_accept_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `grade_accept_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `grade_accept_ibfk_3` FOREIGN KEY (`attend`) REFERENCES `attend` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `grade_accept_ibfk_4` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `gruppa`
--
ALTER TABLE `gruppa`
  ADD CONSTRAINT `gruppa_ibfk_1` FOREIGN KEY (`special_id`) REFERENCES `special` (`special_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gruppa_ibfk_2` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `homework_parent`
--
ALTER TABLE `homework_parent`
  ADD CONSTRAINT `homework_parent_ibfk_1` FOREIGN KEY (`gruppa_id`) REFERENCES `gruppa` (`gruppa_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_parent_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_parent_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_parent_ibfk_4` FOREIGN KEY (`homework_teacher_id`) REFERENCES `homework_teacher` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_parent_ibfk_5` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `homework_teacher`
--
ALTER TABLE `homework_teacher`
  ADD CONSTRAINT `homework_teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_teacher_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_teacher_ibfk_3` FOREIGN KEY (`gruppa_id`) REFERENCES `gruppa` (`gruppa_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD CONSTRAINT `lesson_plan_ibfk_1` FOREIGN KEY (`gruppa_id`) REFERENCES `gruppa` (`gruppa_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lesson_plan_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lesson_plan_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `teacher` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `notice_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `notice_ibfk_3` FOREIGN KEY (`child_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `parent_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `student` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `parent` (`child_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `payment_archive`
--
ALTER TABLE `payment_archive`
  ADD CONSTRAINT `payment_archive_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `parent` (`child_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_archive_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_archive_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`classroom_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`day_id`) REFERENCES `day` (`day_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`lesson_plan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`lesson_num_id`) REFERENCES `lesson_num` (`lesson_num_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `special`
--
ALTER TABLE `special`
  ADD CONSTRAINT `special_ibfk_1` FOREIGN KEY (`otdel_id`) REFERENCES `otdel` (`otdel_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`gruppa_id`) REFERENCES `gruppa` (`gruppa_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`otdel_id`) REFERENCES `otdel` (`otdel_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`otdel_id`) REFERENCES `otdel` (`otdel_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
