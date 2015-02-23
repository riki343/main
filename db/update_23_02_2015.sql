-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.21 - Source distribution
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных main
CREATE DATABASE IF NOT EXISTS `main` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `main`;


-- Дамп структуры для таблица main.matrix
CREATE TABLE IF NOT EXISTS `matrix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `max_count` int(11) NOT NULL,
  `child_0` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `child_1` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `child_2` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `child_3` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `full` tinyint(1) NOT NULL,
  `user_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.matrix: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `matrix` DISABLE KEYS */;
INSERT INTO `matrix` (`id`, `max_count`, `child_0`, `child_1`, `child_2`, `child_3`, `full`, `user_count`) VALUES
	(1, 1, 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:1:{i:0;i:1;}', 1, 1),
	(2, 3, 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}', 1, 3),
	(3, 9, 'a:7:{i:0;i:7;i:1;i:8;i:2;i:9;i:3;i:10;i:4;i:11;i:5;i:12;i:6;i:13;}', 'a:2:{i:0;i:5;i:1;i:6;}', 'a:0:{}', 'a:0:{}', 0, 9),
	(4, 27, 'a:2:{i:0;i:14;i:1;i:15;}', 'a:0:{}', 'a:0:{}', 'a:0:{}', 0, 2);
/*!40000 ALTER TABLE `matrix` ENABLE KEYS */;


-- Дамп структуры для таблица main.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `registered` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6000B0D3F132696E` (`userid`),
  CONSTRAINT `FK_6000B0D3F132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.notifications: ~27 rows (приблизительно)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `userid`, `message`, `active`, `registered`) VALUES
	(1, 1, 'На ваш счет зачислено 21$ от: w w, который присоединился к вашей команде!', 0, '2015-02-23 02:18:10'),
	(2, 1, 'На ваш счет зачислено 21$ от: e e, который присоединился к вашей команде!', 0, '2015-02-23 02:20:21'),
	(3, 1, 'На ваш счет зачислено 21$ от: r r, который присоединился к вашей команде!', 0, '2015-02-23 02:21:43'),
	(4, 2, 'На ваш счет зачислено 3$ от a a, который присоединился к вашей команде!', 0, '2015-02-23 02:23:11'),
	(5, 1, 'На ваш счет зачислено 18$ от a a, который присоединился к вашей команде!', 0, '2015-02-23 02:23:11'),
	(6, 3, 'На ваш счет зачислено 3$ от s s, который присоединился к вашей команде!', 0, '2015-02-23 02:24:13'),
	(7, 1, 'На ваш счет зачислено 18$ от s s, который присоединился к вашей команде!', 0, '2015-02-23 02:24:14'),
	(8, 4, 'На ваш счет зачислено 3$ от d d, который присоединился к вашей команде!', 0, '2015-02-23 02:28:30'),
	(9, 1, 'На ваш счет зачислено 18$ от d d, который присоединился к вашей команде!', 0, '2015-02-23 02:28:30'),
	(10, 2, 'На ваш счет зачислено 3$ от z z, который присоединился к вашей команде!', 0, '2015-02-23 02:30:01'),
	(11, 1, 'На ваш счет зачислено 18$ от z z, который присоединился к вашей команде!', 0, '2015-02-23 02:30:01'),
	(12, 3, 'На ваш счет зачислено 3$ от x x, который присоединился к вашей команде!', 0, '2015-02-23 02:31:12'),
	(13, 1, 'На ваш счет зачислено 18$ от x x, который присоединился к вашей команде!', 0, '2015-02-23 02:31:12'),
	(14, 4, 'На ваш счет зачислено 3$ от c c, который присоединился к вашей команде!', 0, '2015-02-23 02:31:40'),
	(15, 1, 'На ваш счет зачислено 18$ от c c, который присоединился к вашей команде!', 0, '2015-02-23 02:31:40'),
	(16, 2, 'На ваш счет зачислено 3$ от qq qq, который присоединился к вашей команде!', 0, '2015-02-23 02:32:38'),
	(17, 1, 'На ваш счет зачислено 18$ от qq qq, который присоединился к вашей команде!', 0, '2015-02-23 02:32:38'),
	(18, 3, 'На ваш счет зачислено 3$ от ww ww, который присоединился к вашей команде!', 0, '2015-02-23 02:33:15'),
	(19, 1, 'На ваш счет зачислено 18$ от ww ww, который присоединился к вашей команде!', 0, '2015-02-23 02:33:15'),
	(20, 4, 'На ваш счет зачислено 3$ от ee ee, который присоединился к вашей команде!', 0, '2015-02-23 02:36:39'),
	(21, 1, 'На ваш счет зачислено 18$ от ee ee, который присоединился к вашей команде!', 0, '2015-02-23 02:36:39'),
	(22, 5, 'На ваш счет зачислено 3$ от aa aa, который присоединился к вашей команде!', 0, '2015-02-23 02:38:00'),
	(23, 2, 'На ваш счет зачислено 3$ от aa aa, который присоединился к вашей команде!', 0, '2015-02-23 02:38:01'),
	(24, 1, 'На ваш счет зачислено 15$ от aa aa, который присоединился к вашей команде!', 0, '2015-02-23 02:38:01'),
	(25, 6, 'На ваш счет зачислено 3$ от 1 1, который присоединился к вашей команде!', 0, '2015-02-23 02:57:39'),
	(26, 3, 'На ваш счет зачислено 3$ от 1 1, который присоединился к вашей команде!', 0, '2015-02-23 02:57:39'),
	(27, 1, 'На ваш счет зачислено 15$ от 1 1, который присоединился к вашей команде!', 0, '2015-02-23 02:57:39');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;


-- Дамп структуры для таблица main.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.roles: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'USER_ROLE'),
	(2, 'ADMIN_ROLE'),
	(3, 'SUPER_ADMIN_ROLE');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица main.statistics
CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `earned_money` int(11) NOT NULL,
  `spent_money` int(11) NOT NULL,
  `people_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E2D38B22A76ED395` (`user_id`),
  CONSTRAINT `FK_E2D38B22A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.statistics: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` (`id`, `user_id`, `earned_money`, `spent_money`, `people_count`) VALUES
	(1, 1, 255, 0, 14),
	(2, 2, 12, 0, 4),
	(3, 3, 12, 0, 4),
	(4, 4, 9, 0, 3),
	(5, 5, 3, 0, 1),
	(6, 6, 3, 0, 1),
	(7, 7, 0, 0, 0),
	(8, 8, 0, 0, 0),
	(9, 9, 0, 0, 0),
	(10, 10, 0, 0, 0),
	(11, 11, 0, 0, 0),
	(12, 12, 0, 0, 0),
	(13, 13, 0, 0, 0),
	(14, 14, 0, 0, 0),
	(15, 15, 0, 0, 0);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;


-- Дамп структуры для таблица main.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` datetime NOT NULL,
  `lastactive` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `perfect_money` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  UNIQUE KEY `UNIQ_1483A5E9A354774B` (`perfect_money`),
  KEY `IDX_1483A5E912F7FB51` (`sponsor_id`),
  CONSTRAINT `FK_1483A5E912F7FB51` FOREIGN KEY (`sponsor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.users: ~15 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `sponsor_id`, `username`, `password`, `email`, `name`, `surname`, `registered`, `lastactive`, `active`, `perfect_money`, `avatar`, `account_active`) VALUES
	(1, 1, 'q', '5a0c988a92dfab7e74fd9d06153c64f196a35b33376aea9e68c8f1cbebce3caf934435ec4e84ebb045cd47cc8b1068fdc0ebe6445ca3d975956ef0eb9f23aa0c', 'q', 'q', 'q', '2015-02-23 02:14:39', '2015-02-23 02:14:39', 0, 'q', 'files/default/default-avatar.png', 1),
	(2, 1, 'w', 'db0bcca8278e3719734a2e1b04eb0f3482900eb5959aeb9efe00b6065a5e98591a7ceae28ffdb5c9e08de7eb35882996ac8baedacd7ca937d752f6752022fbaa', 'w', 'w', 'w', '2015-02-23 02:16:30', '2015-02-23 02:16:30', 0, 'w', 'files/default/default-avatar.png', 1),
	(3, 1, 'e', 'ccac64092d3587f0cd6db1a34d3aabb7f5fe7c909925b4e63868ce88247998f965c73f905c4d77dd33f8a1fbd12ac6d802a7ef5a7b52b9000e012b99ef4c7f9a', 'e', 'e', 'e', '2015-02-23 02:20:04', '2015-02-23 02:20:04', 0, 'e', 'files/default/default-avatar.png', 1),
	(4, 1, 'r', 'fba90fc4acafe06ed2d11ebb877f3a77808840ae6107271204c7d853c264703622d25e24ba524d664ef70679b7f24b9e1022fa971a280dae1cd3281b9787724c', 'r', 'r', 'r', '2015-02-23 02:21:15', '2015-02-23 02:21:15', 0, 'r', 'files/default/default-avatar.png', 1),
	(5, 2, 'a', '52defde6c07a95c4e0426c394ff9701c27128f165cbab06cd0f4fa6ac34ff577afbaefb4f1b795e79b65fdda203acaa746c1b2ab5f97d1b9a1bb3bcd7c76f967', 'a', 'a', 'a', '2015-02-23 02:22:34', '2015-02-23 02:22:34', 0, 'a', 'files/default/default-avatar.png', 1),
	(6, 3, 's', '6778125c736b20345eed937f7346cb61d567322b10b1be844572b868e87d7ea98994f4fb7fb207175ace63b648f5a211516050dfa5cfa543ebe73254e9de3cda', 's', 's', 's', '2015-02-23 02:23:58', '2015-02-23 02:23:58', 0, 's', 'files/default/default-avatar.png', 1),
	(7, 4, 'd', '82d3f293685701dda9e4eab88226fca9c40db57d17c239b58ffa926c38c58080f0b98349b88ed830ad8b0374983f4c0c44589c5ffb437494ae894be85ceb6622', 'd', 'd', 'd', '2015-02-23 02:28:12', '2015-02-23 02:28:12', 0, 'd', 'files/default/default-avatar.png', 1),
	(8, 2, 'z', '20e825d01236363f976f41a06b24602b1cc6473a9530f9b16439992bdf4a8d7795dbd11d68060d112519c9e3537e933fcac753cac491baac171c5cc6e90630cb', 'z', 'z', 'z', '2015-02-23 02:29:44', '2015-02-23 02:29:44', 0, 'z', 'files/default/default-avatar.png', 1),
	(9, 3, 'x', '139783aeb09bc3343c5867a24dd584a63b49a9bfaea325e99dedaee8a96e20324bd1d57250f7e2022a0d819dd61071b09fdca408cfb22f5832a530a2c99d4df7', 'x', 'x', 'x', '2015-02-23 02:30:58', '2015-02-23 02:30:58', 0, 'x', 'files/default/default-avatar.png', 1),
	(10, 4, 'c', '8c9ea7b5955ccbac1144d18497589b5e9cc649faea2797f8b62f3076d3789996333424168bac47eb872cea514362b95c4460fd5398d7c87327c294734e192617', 'c', 'c', 'c', '2015-02-23 02:31:26', '2015-02-23 02:31:26', 0, 'c', 'files/default/default-avatar.png', 1),
	(11, 2, 'qq', '44602cfcfbfc9eb76347cca34ec5a8a58239d57202340975d78aca0114d0f67d959bbc1ef35ab9e2273ae1a02b1b5fa8414cd72c09c2c195f35b92e037d19006', 'qq', 'qq', 'qq', '2015-02-23 02:31:53', '2015-02-23 02:31:53', 0, 'qq', 'files/default/default-avatar.png', 1),
	(12, 3, 'ww', 'e30f44645bfe0078b5575b91ef0e797723b63ff8f34190741baa46ee28db41390c376f09a55e10f800e446068550033cb4620310e7cde16267e33fcfccc4c705', 'ww', 'ww', 'ww', '2015-02-23 02:32:59', '2015-02-23 02:32:59', 0, 'ww', 'files/default/default-avatar.png', 1),
	(13, 4, 'ee', 'd7072457c9917f9f9dce170fe75a242f827ace2a9c1c2f5376703030e719f1ea7d379cb73935dd52fde9a844a5ffb79a37b5fcd9bc6393f0ded5bf16f116572d', 'ee', 'ee', 'ee', '2015-02-23 02:36:15', '2015-02-23 02:36:15', 0, 'ee', 'files/default/default-avatar.png', 1),
	(14, 5, 'aa', 'def5642cf20eebfb47955e85042f4c030a2f67ebd8c20a089f8f3f2cbdcc7047d970c783353c886d2033a1285eb3cef4ca62f00f4094208bb883982cdb111699', 'aa', 'aa', 'aa', '2015-02-23 02:37:36', '2015-02-23 02:37:36', 0, 'aa', 'files/default/default-avatar.png', 1),
	(15, 6, '1', '11def698940ab8a454b903c9eb5384ea419b6bd5b4cad7910724c74552c547ad2a7ed867652b6e75e9635780940a092fe87fdad7dc1d6f9ea22f78756465ee75', '1', '1', '1', '2015-02-23 02:56:51', '2015-02-23 02:56:51', 0, '1', 'files/default/default-avatar.png', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица main.user_history
CREATE TABLE IF NOT EXISTS `user_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance_before` double NOT NULL,
  `balance_after` double NOT NULL,
  `ammount` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7FB76E41F132696E` (`userid`),
  CONSTRAINT `FK_7FB76E41F132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.user_history: ~26 rows (приблизительно)
/*!40000 ALTER TABLE `user_history` DISABLE KEYS */;
INSERT INTO `user_history` (`id`, `userid`, `date`, `description`, `balance_before`, `balance_after`, `ammount`) VALUES
	(1, 1, '2015-02-23 02:18:10', 'Получено 21$ за активацию аккаунта от пользователя w w', 0, 21, 21),
	(2, 1, '2015-02-23 02:20:21', 'Получено 21$ за активацию аккаунта от пользователя e e', 21, 42, 21),
	(3, 1, '2015-02-23 02:21:43', 'Получено 21$ за активацию аккаунта от пользователя r r', 42, 63, 21),
	(4, 2, '2015-02-23 02:23:11', 'Получено 3$ за активацию аккаунта от пользователя a a', 0, 3, 3),
	(5, 1, '2015-02-23 02:23:11', 'Получено 18$ за активацию аккаунта от пользователя a a', 63, 81, 18),
	(6, 3, '2015-02-23 02:24:14', 'Получено 3$ за активацию аккаунта от пользователя s s', 0, 3, 3),
	(7, 1, '2015-02-23 02:24:14', 'Получено 18$ за активацию аккаунта от пользователя s s', 81, 99, 18),
	(8, 4, '2015-02-23 02:28:30', 'Получено 3$ за активацию аккаунта от пользователя d d', 0, 3, 3),
	(9, 1, '2015-02-23 02:28:30', 'Получено 18$ за активацию аккаунта от пользователя d d', 99, 117, 18),
	(10, 2, '2015-02-23 02:30:01', 'Получено 3$ за активацию аккаунта от пользователя z z', 3, 6, 3),
	(11, 1, '2015-02-23 02:30:01', 'Получено 18$ за активацию аккаунта от пользователя z z', 117, 135, 18),
	(12, 3, '2015-02-23 02:31:12', 'Получено 3$ за активацию аккаунта от пользователя x x', 3, 6, 3),
	(13, 1, '2015-02-23 02:31:12', 'Получено 18$ за активацию аккаунта от пользователя x x', 135, 153, 18),
	(14, 4, '2015-02-23 02:31:40', 'Получено 3$ за активацию аккаунта от пользователя c c', 3, 6, 3),
	(15, 1, '2015-02-23 02:31:40', 'Получено 18$ за активацию аккаунта от пользователя c c', 153, 171, 18),
	(16, 2, '2015-02-23 02:32:38', 'Получено 3$ за активацию аккаунта от пользователя qq qq', 6, 9, 3),
	(17, 1, '2015-02-23 02:32:38', 'Получено 18$ за активацию аккаунта от пользователя qq qq', 171, 189, 18),
	(18, 3, '2015-02-23 02:33:15', 'Получено 3$ за активацию аккаунта от пользователя ww ww', 6, 9, 3),
	(19, 1, '2015-02-23 02:33:15', 'Получено 18$ за активацию аккаунта от пользователя ww ww', 189, 207, 18),
	(20, 4, '2015-02-23 02:36:39', 'Получено 3$ за активацию аккаунта от пользователя ee ee', 6, 9, 3),
	(21, 1, '2015-02-23 02:36:39', 'Получено 18$ за активацию аккаунта от пользователя ee ee', 207, 225, 18),
	(22, 5, '2015-02-23 02:38:01', 'Получено 3$ за активацию аккаунта от пользователя aa aa', 0, 3, 3),
	(23, 2, '2015-02-23 02:38:01', 'Получено 3$ за активацию аккаунта от пользователя aa aa', 9, 12, 3),
	(24, 1, '2015-02-23 02:38:01', 'Получено 15$ за активацию аккаунта от пользователя aa aa', 225, 240, 15),
	(25, 6, '2015-02-23 02:57:39', 'Получено 3$ за активацию аккаунта от пользователя 1 1', 0, 3, 3),
	(26, 3, '2015-02-23 02:57:39', 'Получено 3$ за активацию аккаунта от пользователя 1 1', 9, 12, 3),
	(27, 1, '2015-02-23 02:57:39', 'Получено 15$ за активацию аккаунта от пользователя 1 1', 240, 255, 15);
/*!40000 ALTER TABLE `user_history` ENABLE KEYS */;


-- Дамп структуры для таблица main.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.user_role: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Дамп структуры для таблица main.wallet
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7C68921FF132696E` (`userid`),
  CONSTRAINT `FK_7C68921FF132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.wallet: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `wallet` DISABLE KEYS */;
INSERT INTO `wallet` (`id`, `userid`, `balance`) VALUES
	(1, 1, 255),
	(2, 2, 12),
	(3, 3, 12),
	(4, 4, 9),
	(5, 5, 3),
	(6, 6, 3),
	(7, 7, 0),
	(8, 8, 0),
	(9, 9, 0),
	(10, 10, 0),
	(11, 11, 0),
	(12, 12, 0),
	(13, 13, 0),
	(14, 14, 0),
	(15, 15, 0);
/*!40000 ALTER TABLE `wallet` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
