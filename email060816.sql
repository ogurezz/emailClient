-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 06 2016 г., 20:21
-- Версия сервера: 5.5.48
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `email`
--

-- --------------------------------------------------------

--
-- Структура таблицы `91zlf_letters`
--

CREATE TABLE IF NOT EXISTS `91zlf_letters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `91zlf_letters`
--

INSERT INTO `91zlf_letters` (`id`, `email`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(2, 'ogur-ezz@yandex.ru', 'Привет 4', 'Проверка связи и записи в БД', 1470246187, 1470246187),
(3, 'ogur-ezz@yandex.ru', 'Привет 5', 'Проверка связи и записи в БД', 1470246548, 1470246548),
(4, 'ogur-ezz@yandex.ru', 'Привет 6', 'Проверка связи и записи в БД', 1470251220, 1470251220),
(5, 'ogur-ezz@yandex.ru', 'Привет 7', '&lt;p&gt;rrrrrr&lt;/p&gt;', 1470257019, 1470257019),
(6, 'ogur-ezz@yandex.ru', 'Привет 6', '<b> Hello </b>', 1470257120, 1470257120),
(7, 'ogur-ezz@yandex.ru', 'Привет 7', 'Письмо будет отправлено в файл', 1470327024, 1470327024),
(8, 'ogur-ezz@yandex.ru', 'Привет 8', 'Транспорт false', 1470327153, 1470327153),
(9, 'ogur-ezz@yandex.ua', 'Привет 8', '&#039;mailer&#039; =&gt; [\r\n            &#039;class&#039; =&gt; &#039;yii\\swiftmailer\\Mailer&#039;,\r\n            &#039;useFileTransport&#039; =&gt; false,\r\n],\r\n OpenServer -&gt; Настройки -&gt; Почта -&gt; Способ отправки почты = через удаленный SMTP сервер\r\n', 1470328112, 1470328112),
(10, 'ogur-ezz@yandex.ua', 'Привет 9', 'Вариант 4\r\n----------\r\n&#039;mailer&#039; =&gt; [\r\n            &#039;class&#039; =&gt; &#039;yii\\swiftmailer\\Mailer&#039;,\r\n            &#039;useFileTransport&#039; =&gt; false,\r\n],\r\n OpenServer -&gt; Настройки -&gt; Почта -&gt; Способ отправки почты = через удаленный SMTP сервер\r\n\r\nНастроил данные smtp:\r\nsmtp.yandex.ua\r\nogur-ezz\r\n465\r\nSSL\r\n', 1470328500, 1470328500),
(11, 'ogur-ezz@yandex.ua', 'Привет 13', 'Вариант 8', 1470330503, 1470330503),
(12, 'ogur-ezz@yandex.ua', 'Привет 14', 'Проверка отправителя', 1470330992, 1470330992),
(13, 'ogur-ezz@yandex.ua', 'Привет 15', 'Вариант 8', 1470331202, 1470331202),
(14, 'ogur-ezz@yandex.ua', 'Привет 16', 'Вариант 9', 1470331739, 1470331739),
(15, 'ogur-ezz@yandex.ua', 'Привет 16', 'Вариант 10', 1470331980, 1470331980),
(16, 'ogur-ezz@yandex.ua', 'Привет 17', 'Вариант 11', 1470332169, 1470332169),
(17, 'ogur-ezz@yandex.ua', 'Привет 17', 'Вариант 12', 1470334026, 1470334026),
(18, 'ogur-ezz@yandex.ua', 'Окончательный привет', 'Ура!!! Работает', 1470335883, 1470335883),
(19, 'ogur-ezz@yandex.ua', 'На удаление', 'Удали меня', 1470427237, 1470427237),
(20, 'r11p@yandex.ua', 'Отправка письма из веб-приложения', 'Проверка настроек нового почтового ящика', 1470484025, 1470484025),
(21, 'r11p@yandex.ua', 'Отправка письма из веб-приложения №2', 'Изменение настроек', 1470485506, 1470485506),
(22, 'r11p@yandex.ua', 'Отправка письма из веб-приложения №3', 'Изменение настроек, оптимизация', 1470485914, 1470485914),
(23, 'r11p@yandex.ua', 'Проверяю работу', 'Работает', 1470496545, 1470496545);

-- --------------------------------------------------------

--
-- Структура таблицы `91zlf_migration`
--

CREATE TABLE IF NOT EXISTS `91zlf_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `91zlf_migration`
--

INSERT INTO `91zlf_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1470221622),
('m160802_172032_create_user_table', 1470221630),
('m160803_155122_create_letters_table', 1470241188);

-- --------------------------------------------------------

--
-- Структура таблицы `91zlf_user`
--

CREATE TABLE IF NOT EXISTS `91zlf_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `91zlf_user`
--

INSERT INTO `91zlf_user` (`id`, `username`, `email`, `password_hash`, `status`, `auth_key`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@email.com', '$2y$13$fPLyYXEeGHSfPvL2r59wL.ELRteiM1D1YAxQU6Rkz95qjiB6qvk/O', 10, 'zgmR_Ag24Pi4SfeRP_EeuOCAwvqdvbvJ', 1470224804, 1470224804),
(3, 'user', 'user@user.ru', '$2y$13$ql783NFpiRd0Nn.PhV1WMO1g8G0Fq0WbUezNnNf29k.enHRWJIl9q', 10, 'eYhVGy5hkGf2H5_uAkU9b1pcaSpboxfm', 1470226015, 1470226015),
(4, 'user2', 'user2@user.com', '$2y$13$z9FXgRTpQ3FCTjkYDT7PU.zKcBRH8GZvyxtjx479VUqh4dNKGSQli', 10, 'OiKW-qaxKaxnkeMt0O7bTTcM6Di5tp-s', 1470227816, 1470227816),
(5, 'ogurezz', 'ogur-ezz@yandex.ua', '$2y$13$CnhpuREBheB0ySt3SHKkm.NDDPKGOORUhg4UW8BK8wLrgg2j2D7fm', 10, 'dUpjZs9sRYSiu0QEO7Gk6Aoj20yPqYIH', 1470329416, 1470329416);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `91zlf_letters`
--
ALTER TABLE `91zlf_letters`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `91zlf_migration`
--
ALTER TABLE `91zlf_migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `91zlf_user`
--
ALTER TABLE `91zlf_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `91zlf_letters`
--
ALTER TABLE `91zlf_letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `91zlf_user`
--
ALTER TABLE `91zlf_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
