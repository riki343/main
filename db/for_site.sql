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

-- Дамп структуры для таблица main.admin_record
CREATE TABLE IF NOT EXISTS `admin_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invested_money` double NOT NULL DEFAULT '0',
  `spent_money` double NOT NULL DEFAULT '0',
  `user_count` int(11) NOT NULL DEFAULT '0',
  `active_user_count` int(11) NOT NULL DEFAULT '0',
  `earned_money` int(11) NOT NULL DEFAULT '0',
  `system_balance` double NOT NULL DEFAULT '0',
  `perfect_money` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `perfect_money_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `perfect_money_pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C6FCAE68A354774B` (`perfect_money`),
  UNIQUE KEY `UNIQ_C6FCAE6816F6DD6E` (`perfect_money_id`),
  UNIQUE KEY `UNIQ_C6FCAE68A4013C04` (`perfect_money_pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.admin_record: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `admin_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_record` ENABLE KEYS */;


-- Дамп структуры для таблица main.keys_for_access
CREATE TABLE IF NOT EXISTS `keys_for_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `keyForForgotPassword` longtext COLLATE utf8_unicode_ci,
  `keyForPerfectMoney` longtext COLLATE utf8_unicode_ci,
  `keyForConfirmAccount` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.keys_for_access: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `keys_for_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `keys_for_access` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.matrix: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `matrix` DISABLE KEYS */;
INSERT INTO `matrix` (`id`, `max_count`, `child_0`, `child_1`, `child_2`, `child_3`, `full`, `user_count`) VALUES
	(1, 1, 'a:1:{i:0;i:1;}', 'a:0:{}', 'a:0:{}', 'a:0:{}', 0, 1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.notifications: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.statistics: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.users: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.user_history: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_history` DISABLE KEYS */;
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

-- Дамп данных таблицы main.user_role: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Дамп структуры для таблица main.wallet
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7C68921FF132696E` (`userid`),
  CONSTRAINT `FK_7C68921FF132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.wallet: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `wallet` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
