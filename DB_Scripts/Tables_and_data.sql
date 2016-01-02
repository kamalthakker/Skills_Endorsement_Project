-- Database Name: Skills_Endorsement

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 

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


INSERT INTO `users` (`uname`, `role`, `psword`, `fname`, `lname`, `gender`, `email`, `phone`, `address`, `state`, `city`, `zip`, `registration_date`, `last_login`, `login_attempt`, `blocked_time`, `approved_by_admin`)
VALUES
	('mbush@mitre.org', 'user', 'test', 'mike', 'bush', 'm', 'mbush@mitre.org', '410-272-5848', NULL, 'MD', 'Aberdeen', '03-441', NULL, NULL, NULL, NULL, NULL);


---------------------------------------------------------------------------------------------------------------------------------------------------------------------------