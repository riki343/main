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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы main.statistics: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` (`id`, `user_id`, `earned_money`, `spent_money`, `people_count`) VALUES
	(1, 6, 0, 0, 0),
	(2, 7, 0, 0, 0),
	(3, 8, 0, 0, 0),
	(4, 9, 0, 0, 0),
	(5, 10, 0, 0, 0),
	(7, 1, 0, 0, 0);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
