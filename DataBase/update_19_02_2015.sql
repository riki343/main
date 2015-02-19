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


-- Дамп структуры для таблица main.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.roles: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'USER_ROLE'),
	(2, 'ADMIN_ROLE'),
	(3, 'SUPER_ADMIN_ROLE');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица main.statistics
CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `earned_money` int(11) NOT NULL,
  `spent_money` int(11) NOT NULL,
  `people_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E2D38B22F132696E` (`userid`),
  CONSTRAINT `FK_E2D38B22F132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.statistics: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` (`id`, `userid`, `user_id`, `earned_money`, `spent_money`, `people_count`) VALUES
	(1, 8, 0, 0, 0, 0),
	(2, 9, 0, 0, 0, 0),
	(3, 10, 0, 0, 0, 0),
	(4, 7, 0, 0, 0, 0),
	(6, 6, 0, 0, 0, 0);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;


-- Дамп структуры для таблица main.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `sponsor_id` int(11) NOT NULL,
  `account_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  UNIQUE KEY `UNIQ_1483A5E9A354774B` (`perfect_money`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `registered`, `lastactive`, `active`, `perfect_money`, `avatar`, `sponsor_id`, `account_active`) VALUES
	(1, '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, 0),
	(6, 'riki34', '2e6401531190d2c9ea5a91d4a16ed8ee026419d3703ee00f70defeae0416d2645b8bddb4d9a87fc8d6c5c812a0157bf59cab49b56b62aaed35a065637f509a6c', 'riki34@spaces.ru', 'Vlad', 'Kosko', '2015-02-18 02:41:33', '2015-02-18 02:41:33', 0, 'u1234565', 'files/default/default-avatar.png', 1, 0),
	(7, 'vlad', 'cce07c5fa918838c883849142d589b30d726c7f950ec1ea872ded13582bcc83456395cd972e2eb935be375c96adf2a26b1a1e4b4964e98f9601e36f1de31c1fe', 'email@email', 'Vlad', 'Kosko', '2015-02-18 14:59:04', '2015-02-18 14:59:04', 0, 'u1245879', 'files/default/default-avatar.png', 6, 0),
	(8, 'riki', '27537009e59cec4b616bf466a55f70248975b7123bbf012d753d27f7b4847bd4434ad235bdbc16c5801efc4a39c9ef4a58d2ac668d95ead6b209ea1aba6a6099', 'fefs@fesesf', 'Vlad', 'Kosko', '2015-02-19 01:24:47', '2015-02-19 01:24:47', 0, 'u7894561', 'default.png', 1, 0),
	(9, 'Andriy', 'ea3208753af1efc40faa76fa8d1d78d67ac5ababdbc44de96bd667bcb81618e5c29962c1bf77f69e7859bc664d8071bffc9ac986654c826d485a28d93120e16b', 'andriy.smuzahnitsya@gmail.com', 'andriy', 'andriy', '2015-02-19 10:27:18', '2015-02-19 10:27:18', 0, '1419233', 'files/default/default-avatar.png', 1, 0),
	(10, 'LuHoDIj', 'e3baf3f9e6186629aac0d8a1f68b5ab87bb654dad521413ad971adb3805f7662bc5ead2cf62a7f81525d84065cf618cc676dd70975e3a6e72759ad4b6fd9b904', 'vasya.lozan@gmail.com', 'Vasya', 'Lozan', '2015-02-19 12:33:44', '2015-02-19 12:33:44', 0, 'u7777777', 'files/default/default-avatar.png', 1, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


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

-- Дамп данных таблицы main.user_role: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
	(6, 1),
	(7, 1),
	(9, 1),
	(10, 1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Дамп структуры для таблица main.wallet
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7C68921FF132696E` (`userid`),
  CONSTRAINT `FK_7C68921FF132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.wallet: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `wallet` DISABLE KEYS */;
INSERT INTO `wallet` (`id`, `userid`, `balance`) VALUES
	(1, 7, 20),
	(2, 9, 100),
	(3, 10, 0);
/*!40000 ALTER TABLE `wallet` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
