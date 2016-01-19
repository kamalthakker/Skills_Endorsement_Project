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
select distinct userskills.user_id, userskills.skill_id, userskills.skill_name, skillrank.rank from 
(
	select p.user_id, ps.skill_id, s.name as skill_name from project_skills ps 
	inner join projects p on p.project_id=ps.project_id
	inner join skills s on s.skill_id=ps.skill_id
 	where upper(p.approved)='Y' and user_id=3
) userskills
left join
( 
	select skill_id, count(skill_id) as rank from  skill_endorsements
	where user_id=3
	group by skill_id
) skillrank
on userskills.skill_id=skillrank.skill_id
order by skillrank.rank desc, userskills.skill_name;

/*List of approved projects*/
select p.*, u.fname as manager_fname, u.lname as manager_lname from projects p 
inner join users u on p.manager_user_id=u.user_id
where upper(approved)='Y' and p.user_id=1
order by p.end_date is not null, p.end_date desc, p.start_date desc;

/*Project skills with ranking*/
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


/*Get user's endorsement*/
select se.skill_endorsement_id, se.user_id, se.skill_id,  
se.endorsed_by_user_id, se.endorsed_on, se.comments,
u.fname, u.lname, u.job_title, u.userdp
from skill_endorsements se
inner join users u on se.endorsed_by_user_id=u.user_id
where se.user_id=1 and se.skill_id=2918 
order by se.endorsed_on desc, u.lname;


/*Search results*/
select distinct user_id, fname, lname, job_title, speciality, speciality2, userdp 
from users
where fname like '%mike%'


union 

select distinct u.user_id, fname, lname, job_title, speciality, speciality2, userdp 
from project_skills ps 
	inner join projects p on p.project_id=ps.project_id
	inner join skills s on s.skill_id=ps.skill_id
	inner join users u on u.user_id=p.user_id
 	where upper(p.approved)='Y' and (s.name like '%java%' or p.project_name like '%an%')
order by fname;


/*Search results*/ select distinct user_id, fname, lname, job_title, speciality, speciality2, userdp from users where fname like '%java%' union select distinct u.user_id, fname, lname, job_title, speciality, speciality2, userdp from project_skills ps inner join projects p on p.project_id=ps.project_id inner join skills s on s.skill_id=ps.skill_id inner join users u on u.user_id=p.user_id where upper(p.approved)='Y' and (s.name like '%java%' or p.project_name like '%java%') order by fname




INSERT INTO skill_endorsements (skill_endorsement_id, user_id, skill_id, endorsed_by_user_id, comments)
VALUES
	(8, 1, 2918, 5, 'I write on behalf of xyz\'s application for a Rhodes Scholarship.  I believe abc to be an exemplary student-scholar as well as a person of tremendous character with significant leadership skills.\r\rI heard of xyz before I met her.  A top student of mine and Truman finalist came into my office and announced that she had met the next Truman finalist - a first year woman who was full of energy for leading the Students for Choice organization.  The young woman I encountered in my American Politics class that next semester was, in fact, quite enthusiastic for her studies and a solid, conscientious student.  Full of questions, xyz regularly participated in class discussions and probed the materials with a zest for learning.  In her first year, however, I was more struck by her openness to the world than her analytic ability.   ', '2016-01-16 16:39:30');



/*Endorsement suggestions*/
select p2.project_id, p2.project_name, u.user_id, u.fname, u.lname, 
case when already_endorsed.cskill is null then 
FLOOR(RAND() * 15) + 1 else already_endorsed.cskill end as cskill
 from projects p1
inner join projects p2 on
p1.project_name=p2.project_name and p2.user_id<>1 and p2.approved='Y'
inner join users u on
p2.user_id=u.user_id
left join 
(select user_id, count(skill_id)*100 cskill from skill_endorsements
where endorsed_by_user_id=1) already_endorsed on
already_endorsed.user_id=u.user_id
where p1.approved='Y' and p1.user_id=1 
order by cskill
limit 5;


/*Recent activity*/
select se.*, s.name from skill_endorsements se
inner join skills s on
se.skill_id=s.skill_id
order by se.endorsed_on desc
limit 5;




 
 
