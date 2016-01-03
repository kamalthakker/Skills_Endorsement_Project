# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: Skills_Endorsement
# Generation Time: 2016-01-03 00:29:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `project_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) DEFAULT NULL,
  `project_desc` varchar(5000) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `manager` varchar(50) DEFAULT NULL,
  `approved` char(1) DEFAULT 'N',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_project_skill
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_project_skill`;

CREATE TABLE `user_project_skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uname` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `uname` varchar(50) NOT NULL DEFAULT '',
  `role` varchar(50) NOT NULL DEFAULT '',
  `psword` varchar(20) DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `login_attempt` int(11) DEFAULT NULL,
  `blocked_time` datetime DEFAULT NULL,
  `approved_by_admin` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`uname`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`uname`, `role`, `psword`, `fname`, `lname`, `gender`, `email`, `phone`, `address`, `state`, `city`, `zip`, `registration_date`, `last_login`, `login_attempt`, `blocked_time`, `approved_by_admin`)
VALUES
	('mbush@mitre.org','user','test','mike','bush','m','mbush@mitre.org','410-272-5848',NULL,'MD','Aberdeen','03-441',NULL,'2016-01-02 15:25:40',0,NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
