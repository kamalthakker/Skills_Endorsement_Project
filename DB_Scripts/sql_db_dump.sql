# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: Skills_Endorsement
# Generation Time: 2016-01-27 00:55:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `config_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;

INSERT INTO `config` (`config_id`, `name`, `value`)
VALUES
	(1,'max_endorsement','5'),
	(2,'endorsement_start','01/01/2016');

/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table non_project_skills
# ------------------------------------------------------------

DROP TABLE IF EXISTS `non_project_skills`;

CREATE TABLE `non_project_skills` (
  `non_project_skill_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `has_certificate` char(1) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`non_project_skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table project_skills
# ------------------------------------------------------------

DROP TABLE IF EXISTS `project_skills`;

CREATE TABLE `project_skills` (
  `project_skill_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`project_skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `project_skills` WRITE;
/*!40000 ALTER TABLE `project_skills` DISABLE KEYS */;

INSERT INTO `project_skills` (`project_skill_id`, `project_id`, `skill_id`)
VALUES
	(1,1,2918),
	(2,1,1010),
	(3,1,3731),
	(4,1,3050),
	(5,1,3067),
	(6,2,3070),
	(7,2,3080),
	(8,2,3084),
	(9,2,3141),
	(10,3,3183),
	(11,3,3059),
	(12,3,3060),
	(13,4,3103),
	(14,4,3153),
	(15,4,3181),
	(16,4,3216),
	(17,5,3317),
	(18,5,3559),
	(19,5,3558),
	(20,6,2918),
	(21,7,2918),
	(22,7,5302),
	(23,6,220),
	(24,8,2918),
	(25,8,3731),
	(26,8,3050),
	(27,8,3060),
	(28,9,2918),
	(29,9,1010),
	(30,9,3084),
	(31,9,3141),
	(32,10,3731),
	(33,10,3084),
	(34,10,3060),
	(35,11,3731),
	(36,11,3084),
	(37,11,3183),
	(38,12,1010),
	(39,12,3183),
	(40,12,3153),
	(41,12,2918),
	(42,13,1010),
	(43,13,3939),
	(44,13,6203),
	(45,13,6192),
	(130,39,114),
	(131,39,2479),
	(132,39,160),
	(133,39,292),
	(134,39,3712),
	(135,39,4341),
	(136,39,504),
	(137,39,4439),
	(138,39,2918),
	(139,39,1055),
	(140,39,6594),
	(141,39,2708),
	(142,39,3691),
	(143,39,538);

/*!40000 ALTER TABLE `project_skills` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `project_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `project_desc` varchar(5000) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `manager_user_id` int(11) DEFAULT NULL,
  `approved` char(1) DEFAULT 'N',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`project_id`, `user_id`, `project_name`, `project_desc`, `start_date`, `end_date`, `manager_user_id`, `approved`)
VALUES
	(1,1,'Android - PC Chatting & Image Sharing System','Chatting, image, audio and video sharing is possible between two or more people using mobile phones which is common now- a-days. This system enables user to send or receive messages and images with mobile phone and personal computer. This system involves two users where user can send messages, share images using their devices. Both the users must have this application to be installed in their devices in order to use the functionality of this system. For security purpose, system will encrypt and decrypt the images. So images are sent securely through network medium. This system enables the user to send messages from his mobile phone to the user using his personal computer. This system also enables the user to send and receive messages between two handheld devices i.e. mobile phones. This system requires good network connection. User can send or receive messages, images with their mobile phones as well as with their personal computers. This system is a web application in android technology. People can communicate with each other anywhere at any time. People can share their views. This system enables messages to be send between devices having two different operating system. This system is platform independent since this system works on different operating system. User can share their views by sending messages or images. User can feel this application to be visually appealing since it has an effective Graphical User Interface.','2015-10-01',NULL,2,'Y'),
	(2,1,'Railway Tracking and Arrival Time Prediction','It has happened so many times that you have been waiting on railway station for someone to arrive and you don\'t have any exact information about train timing and other stuff. So here we present to you a project on Railway Tracking and Arrival Time Prediction. Using this system user\'s can get the information about train timing, and is it on time or not, and other information. In this, system will track the train timing at what time train departed from a particular station and pass these timing details to other station\'s system where it will display the timing according to train departed from previous station. If system will find any delay in train due to signal it will automatically update the train timing in next station and will be displayed to viewers.\nIn this system there is an admin module, who enters the detail about trains and its timing and these details will be passed through internet server and is fetched by the system on other stations, and there is other system that shows train information to the viewers on platform. Second system will get all the information of all trains but will automatically select the data that refers to particular station and shows that information on screen. For example if an admin at Mumbai station enter information about Delhi station Chennai station system will not be effected, but Delhi Station system will show the information about train. This system works like - when train is departed late from a station, admin will enter details about departure and its time, and this information goes in real time on internet server and retrieved on other system through internet server and shows the details on screen. Station masters on every station have a login wherein them may update train arrival time at their station when it arrives. This second System is installed on various locations on station for viewers to view the information. Admin will add information like train departed from station, expected arrival at destination, delay in the train schedule, etc. This project publishes real-time train schedule events to subscribing multiple client applications.','2013-02-01','2015-09-01',1,'Y'),
	(3,1,'MLM Project','A multilevel marketing project is a system that allows companies to make and implement their MLM strategies for education tutorials online. Users may first register on website. As soon as a new member registers he needs to pay a fee. On paying fees he becomes a member and can view online education tutorials and download educational e-books and he may now refer other members. When these members register on website for form filling they can select the person who referred them. So these people are registered under their referrer. This can be done for various levels. User sees the users registered under him when he logs in. When a user is registered under him he gets 20 % of his registration fees. The referral fees decreases by levels. There are four referral levels and with every level the percentage of reference discount decreases.','2013-03-01','2013-01-01',2,'Y'),
	(4,1,'Image Editor Project','This is an image editor with various image editing functionality that allows you to crop, zoom, transform, adjust brightness and apply more such transformations over an image.','2012-01-01','2012-12-01',3,'Y'),
	(5,1,'Hotel Reservation Android','There are many mobile applications available which makes people’s work quicker. Here we introduce new android application where user can book rooms via Smartphone. This application allows users to book hotel rooms through android phones. Using this system user can view and check for various rooms available and simultaneously book them by making online payment via credit card. The system also provides user with additional facilities like Jacuzzi, swimming, meals and additional bed addition along with their associated charges. The system calculates the total cost on booking the services. Once the user makes the payment, system will provide online receipt to the user. User can view the room booking in an effective graphical user interface. Since room bookings will be displayed in effective graphical user interface user will get to know which rooms are booked and how many rooms are available for booking. Using this application user can select the room according to his preference. The rooms which are already will be disabled and the rooms which are available user just have to select it and then proceed to payment option. Once user makes the payment system will generate receipt and it will be sent to respective users email id and it will be reported to the admin, when user visits the hotel, he must show the receipt for the accommodation. To use this application user may require smart phone along with internet connection.','2012-03-01','2013-02-01',3,'Y'),
	(6,6,'Android - PC Chatting & Image Sharing System','Chatting, image, audio and video sharing is possible between two or more people using mobile phones which is common now- a-days. This system enables user to send or receive messages and images with mobile phone and personal computer. This system involves two users where user can send messages, share images using their devices. Both the users must have this application to be installed in their devices in order to use the functionality of this system. For security purpose, system will encrypt and decrypt the images. So images are sent securely through network medium. This system enables the user to send messages from his mobile phone to the user using his personal computer. This system also enables the user to send and receive messages between two handheld devices i.e. mobile phones. This system requires good network connection. User can send or receive messages, images with their mobile phones as well as with their personal computers. This system is a web application in android technology. People can communicate with each other anywhere at any time. People can share their views. This system enables messages to be send between devices having two different operating system. This system is platform independent since this system works on different operating system. User can share their views by sending messages or images. User can feel this application to be visually appealing since it has an effective Graphical User Interface.','2015-10-01',NULL,2,'Y'),
	(7,3,'Android - PC Chatting & Image Sharing System','Chatting, image, audio and video sharing is possible between two or more people using mobile phones which is common now- a-days. This system enables user to send or receive messages and images with mobile phone and personal computer. This system involves two users where user can send messages, share images using their devices. Both the users must have this application to be installed in their devices in order to use the functionality of this system. For security purpose, system will encrypt and decrypt the images. So images are sent securely through network medium. This system enables the user to send messages from his mobile phone to the user using his personal computer. This system also enables the user to send and receive messages between two handheld devices i.e. mobile phones. This system requires good network connection. User can send or receive messages, images with their mobile phones as well as with their personal computers. This system is a web application in android technology. People can communicate with each other anywhere at any time. People can share their views. This system enables messages to be send between devices having two different operating system. This system is platform independent since this system works on different operating system. User can share their views by sending messages or images. User can feel this application to be visually appealing since it has an effective Graphical User Interface.','2015-10-01',NULL,2,'Y'),
	(8,4,'MLM Project','A multilevel marketing project is a system that allows companies to make and implement their MLM strategies for education tutorials online. Users may first register on website. As soon as a new member registers he needs to pay a fee. On paying fees he becomes a member and can view online education tutorials and download educational e-books and he may now refer other members. When these members register on website for form filling they can select the person who referred them. So these people are registered under their referrer. This can be done for various levels. User sees the users registered under him when he logs in. When a user is registered under him he gets 20 % of his registration fees. The referral fees decreases by levels. There are four referral levels and with every level the percentage of reference discount decreases.','2013-03-01','2013-01-01',2,'Y'),
	(9,5,'MLM Project','A multilevel marketing project is a system that allows companies to make and implement their MLM strategies for education tutorials online. Users may first register on website. As soon as a new member registers he needs to pay a fee. On paying fees he becomes a member and can view online education tutorials and download educational e-books and he may now refer other members. When these members register on website for form filling they can select the person who referred them. So these people are registered under their referrer. This can be done for various levels. User sees the users registered under him when he logs in. When a user is registered under him he gets 20 % of his registration fees. The referral fees decreases by levels. There are four referral levels and with every level the percentage of reference discount decreases.','2013-03-01','2013-01-01',2,'Y'),
	(10,6,'Android - PC Chatting & Image Sharing System','Chatting, image, audio and video sharing is possible between two or more people using mobile phones which is common now- a-days. This system enables user to send or receive messages and images with mobile phone and personal computer. This system involves two users where user can send messages, share images using their devices. Both the users must have this application to be installed in their devices in order to use the functionality of this system. For security purpose, system will encrypt and decrypt the images. So images are sent securely through network medium. This system enables the user to send messages from his mobile phone to the user using his personal computer. This system also enables the user to send and receive messages between two handheld devices i.e. mobile phones. This system requires good network connection. User can send or receive messages, images with their mobile phones as well as with their personal computers. This system is a web application in android technology. People can communicate with each other anywhere at any time. People can share their views. This system enables messages to be send between devices having two different operating system. This system is platform independent since this system works on different operating system. User can share their views by sending messages or images. User can feel this application to be visually appealing since it has an effective Graphical User Interface.','2015-10-01',NULL,2,'Y'),
	(11,2,'Android - PC Chatting & Image Sharing System','Chatting, image, audio and video sharing is possible between two or more people using mobile phones which is common now- a-days. This system enables user to send or receive messages and images with mobile phone and personal computer. This system involves two users where user can send messages, share images using their devices. Both the users must have this application to be installed in their devices in order to use the functionality of this system. For security purpose, system will encrypt and decrypt the images. So images are sent securely through network medium. This system enables the user to send messages from his mobile phone to the user using his personal computer. This system also enables the user to send and receive messages between two handheld devices i.e. mobile phones. This system requires good network connection. User can send or receive messages, images with their mobile phones as well as with their personal computers. This system is a web application in android technology. People can communicate with each other anywhere at any time. People can share their views. This system enables messages to be send between devices having two different operating system. This system is platform independent since this system works on different operating system. User can share their views by sending messages or images. User can feel this application to be visually appealing since it has an effective Graphical User Interface.','2015-10-01',NULL,1,'Y'),
	(12,3,'Image Editor Project','This is an image editor with various image editing functionality that allows you to crop, zoom, transform, adjust brightness and apply more such transformations over an image.','2012-01-01','2012-12-01',2,'Y'),
	(13,4,'Image Editor Project','This is an image editor with various image editing functionality that allows you to crop, zoom, transform, adjust brightness and apply more such transformations over an image.','2012-01-01','2012-12-01',2,'Y'),
	(39,2,'Railway Tracking and Arrival Time Prediction','It has happened so many times that you have been waiting on railway station for someone to arrive and you don\'t have any exact information about train timing and other stuff. So here we present to you a project on Railway Tracking and Arrival Time Prediction. Using this system user\'s can get the information about train timing, and is it on time or not, and other information. In this, system will track the train timing at what time train departed from a particular station and pass these timing details to other station\'s system where it will display the timing according to train departed from previous station. If system will find any delay in train due to signal it will automatically update the train timing in next station and will be displayed to viewers.\nIn this system there is an admin module, who enters the detail about trains and its timing and these details will be passed through internet server and is fetched by the system on other stations, and there is other system that shows train information to the viewers on platform. Second system will get all the information of all trains but will automatically select the data that refers to particular station and shows that information on screen. For example if an admin at Mumbai station enter information about Delhi station Chennai station system will not be effected, but Delhi Station system will show the information about train. This system works like - when train is departed late from a station, admin will enter details about departure and its time, and this information goes in real time on internet server and retrieved on other system through internet server and shows the details on screen. Station masters on every station have a login wherein them may update train arrival time at their station when it arrives. This second System is installed on various locations on station for viewers to view the information. Admin will add information like train departed from station, expected arrival at destination, delay in the train schedule, etc. This project publishes real-time train schedule events to subscribing multiple client applications.','2014-01-01','2016-01-01',3,'Y');

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table skill_endorsements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `skill_endorsements`;

CREATE TABLE `skill_endorsements` (
  `skill_endorsement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `endorsed_by_user_id` int(11) DEFAULT NULL,
  `comments` varchar(5000) DEFAULT NULL,
  `endorsed_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`skill_endorsement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `skill_endorsements` WRITE;
/*!40000 ALTER TABLE `skill_endorsements` DISABLE KEYS */;

INSERT INTO `skill_endorsements` (`skill_endorsement_id`, `user_id`, `skill_id`, `endorsed_by_user_id`, `comments`, `endorsed_on`)
VALUES
	(1,1,2918,2,'It is my pleasure to write this letter of recommendation for xyz\rfor the Rhodes Scholarship. I first met 	when he was a student in my Integrated Sciences class (HONS 2306,2116). Although T was a freshman at the time, I was greatly impressed with his poise and drive. I also was struck by the commitment 	seemed to have to excellence, not only in his scholastic endeavors, but also in all aspects of his life. However, since HONS 2306 is one of our Honors classes, these attributes were not especially uncommon in that cohort of students. Nevertheless, 	sticks out in my mind from that class, even after a few years have now passed, from one particular incident.','2015-09-01 00:00:00'),
	(2,1,2918,3,'He is the best!!','2015-09-01 00:00:00'),
	(3,1,2918,4,'He is a Java expert','2015-09-01 00:00:00'),
	(4,1,3050,2,'very knowledgeable','2015-09-01 00:00:00'),
	(5,1,3067,2,'Very good!','2015-09-01 00:00:00'),
	(6,1,3050,3,'XYZ Training Services will be launching its new website in the second quarter of this year. We have been setting up a page for testimonials to give new clients an idea of what they can expect from our company. We would therefore like to ask if you could graciously share your own experiences for inclusion on this page. We would just like to highlight the benefits your staff members have received from their training sessions with us. Would you be comfortable with this? If so, we will be sending one of our representatives over to take down your comments. Thank you very much!\n','2015-09-01 00:00:00'),
	(7,1,3070,2,'Very nice skill','2015-09-01 00:00:00'),
	(8,1,2918,5,'I write on behalf of xyz\'s application for a Rhodes Scholarship.  I believe abc to be an exemplary student-scholar as well as a person of tremendous character with significant leadership skills.\r\rI heard of xyz before I met her.  A top student of mine and Truman finalist came into my office and announced that she had met the next Truman finalist - a first year woman who was full of energy for leading the Students for Choice organization.  The young woman I encountered in my American Politics class that next semester was, in fact, quite enthusiastic for her studies and a solid, conscientious student.  Full of questions, xyz regularly participated in class discussions and probed the materials with a zest for learning.  In her first year, however, I was more struck by her openness to the world than her analytic ability.   ','2016-01-16 16:39:30'),
	(14,3,2918,1,'he is an expert','2016-01-16 23:37:14'),
	(16,2,538,1,'He is an expert in Bootstrap!','2016-01-24 16:12:51'),
	(17,2,160,1,'yes, he knows it...','2016-01-24 16:13:19');

/*!40000 ALTER TABLE `skill_endorsements` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `speciality` varchar(75) DEFAULT NULL,
  `speciality2` varchar(75) DEFAULT NULL,
  `job_title` varchar(25) DEFAULT NULL,
  `userdp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`uname`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `uname`, `role`, `psword`, `fname`, `lname`, `gender`, `email`, `phone`, `address`, `state`, `city`, `zip`, `registration_date`, `last_login`, `login_attempt`, `blocked_time`, `approved_by_admin`, `speciality`, `speciality2`, `job_title`, `userdp`)
VALUES
	(1,'mbush@mitre.org','user','test','mike','bush','m','mbush@mitre.org','410-272-5848',NULL,'MD','Aberdeen','03-441',NULL,'2016-01-26 19:48:09',0,NULL,NULL,'Software Engineering','Software Apps Development','Group leader','mike.jpg'),
	(2,'kamalthakker@gmail.com','user','test','kamal','thakker','m','kamalthakker@gmail.com','123-456-7890',NULL,'NJ','Monroe','08831',NULL,'2016-01-26 19:47:51',0,NULL,NULL,'Software Engineering','Software Apps Development','Manager','kamal.jpg'),
	(3,'savon40@gmail.com ','user','test','steve','avon','m','savon40@gmail.com ','234-567-89101',NULL,'NJ','Point Pleasant','1234',NULL,'2016-01-23 18:28:35',0,NULL,NULL,'Software Engineering','Software Apps Development','Manager','steve.jpg'),
	(4,'hli1022@gmail.com ','user','test','howard','li','m','hli1022@gmail.com ','345-678-9012',NULL,'NJ','Point Pleasant','1234',NULL,'2016-01-19 19:23:47',0,NULL,NULL,'Software Engineering','Software Apps Development','Manager','howard.jpg'),
	(5,'bharti.chinni@gmail.com ','user','test','chaitanya','bharti','f','bharti.chinni@gmail.com ','456-789-0123',NULL,'NJ','Long Branch','1234',NULL,NULL,NULL,NULL,NULL,'Software Engineering','Software Apps Development','Group Leader','chaitanya.jpg'),
	(6,'chz8983@gmail.com','user','test','cathy','chen','f','chz8983@gmail.com','567-890-1234',NULL,'NJ','Long Branch','1234',NULL,NULL,NULL,NULL,NULL,'Software Engineering','Software Apps Development','Group Leader','cathy.jpg');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
