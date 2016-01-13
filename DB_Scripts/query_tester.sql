CREATE TABLE `users` (
  `user_id` int(11)  NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`user_id`,`uname`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `users` (`uname`, `role`, `psword`, `fname`, `lname`, `gender`, `email`, `phone`, `address`, `state`, `city`, `zip`, `registration_date`, `last_login`, `login_attempt`, `blocked_time`, `approved_by_admin`)
VALUES
	( 'mbush@mitre.org', 'user', 'test', 'mike', 'bush', 'm', 'mbush@mitre.org', '410-272-5848', NULL, 'MD', 'Aberdeen', '03-441', NULL, '2016-01-02 15:25:40', 0, NULL, NULL);
	
	
select * from users	where user_id=1;

/*All user's skills with endorsement rankings*/
select userskills.skill_id, userskills.skill_name, skillrank.rank from 
(
	select ps.skill_id, s.name as skill_name from project_skills ps 
	inner join projects p on p.project_id=ps.project_id
	inner join skills s on s.skill_id=ps.skill_id
 	where upper(p.approved)='Y' and user_id=1
) userskills
left join
( 
	select skill_id, count(skill_id) as rank from  skill_endorsements
	where user_id=1
	group by skill_id
) skillrank
on userskills.skill_id=skillrank.skill_id
order by skillrank.rank desc, userskills.skill_name;

/*List of approved projects*/
select * from projects 
where upper(approved)='Y' and user_id=1;


select pskill.user_id, pskill.project_skill_id, pskill.project_id, pskill.skill_id, pskill.skill_name, skillrank.rank  from
(
	select p.user_id, ps.project_skill_id, ps.project_id, ps.skill_id, s.name as skill_name from project_skills ps
	inner join skills s on s.skill_id=ps.skill_id
	inner join projects p on p.project_id=ps.project_id
	where p.project_id=2
) pskill
left join
( 
	select user_id, skill_id, count(skill_id) as rank from  skill_endorsements
	group by user_id, skill_id
) skillrank
on pskill.skill_id=skillrank.skill_id and pskill.user_id=skillrank.user_id
order by skillrank.rank desc, pskill.skill_name;


 
 
