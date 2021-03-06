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


/*Unread messages*/ 
select count(*) as ncount from notifications nt
where nt.recipient_user_id=3 and nt.read='N';

/*Notifications*/
select  
n.notification_id,
n.notification_type_id,
nt.notification_name,
n.recipient_user_id,
ru.fname as ru_fname, ru.lname as ru_lname, ru.userdp as ru_userdp,
su.fname as su_fname, su.lname as su_lname, su.userdp as su_userdp,
n.sender_user_id,
n.correspondence_id,
n.read,
n.created_date,
p.project_id,
p.project_name,
p.manager_user_id,
p.approved,
se.skill_endorsement_id,
s.name as skill_name,
se.comments
from notifications n 
inner join notification_types nt 
on n.notification_type_id=nt.notification_type_id
inner join users ru
on ru.user_id=n.recipient_user_id
inner join users su
on su.user_id=n.sender_user_id
left join projects p 
on nt.notification_name in ('project_added','project_approved') and 
   n.correspondence_id=p.project_id
left join skill_endorsements se
on nt.notification_name in ('endorsed') and
   n.correspondence_id=skill_endorsement_id
left join skills s on
	se.skill_id=s.skill_id	   
where n.recipient_user_id=2
order by n.created_date desc
limit 8;


update notifications set read='Y' where recipient_user_id=3 and read='N'

select * from skill_endorsements se2 
where se2.skill_endorsement_id =
(select max(se.skill_endorsement_id) from skill_endorsements se
where se.endorsed_by_user_id=2 and se.user_id=3 and se.skill_id=2918 and year(endorsed_on)=year(CURDATE()))


update skill_endorsements
set endorsed_on=CURRENT_TIMESTAMP
where skill_endorsement_id=24;
   
select s.skeyword from (
select u1.fname as skeyword from users u1
union all
select u2.lname as skeyword from users u2
union all
select distinct p.project_name as skeyword from projects p
union all
select s.name as skeyword from skills s
) s
where s.skeyword like 'ja%'


--- Clean up script for demo ---
--- Run this script to clean up database before giving the demo ---

delete from projects where project_id > 39;
delete from project_skills where project_id > 39;

-- delete all endorsements
delete from skill_endorsements;

delete from skills where skill_id>6590;

delete from notifications;

INSERT INTO `skill_endorsements` (`skill_endorsement_id`, `user_id`, `skill_id`, `endorsed_by_user_id`, `comments`, `endorsed_on`) VALUES
(38, 1, 2918, 2, 'Mike and I both have worked together on Android project. Mike exhibits high proficiency in comprehensive technologies. Especially, Mike is very knowledgeable in Java. He promotes positive energy among the team members.', '2016-04-02 22:44:36'),
(39, 1, 2918, 3, 'Mike is an outstanding leader and manager who provided steady direction to the group in Java development project.', '2016-04-02 22:48:08'),
(40, 1, 1010, 3, 'Mike is very knowledgeable. Over the years, Mike has accumulated tremendous amount of experience and knowledge in the field of XML and integrations.', '2016-04-02 22:49:56'),
(41, 2, 4439, 1, 'Kamal has a very good blend of business knowledge and technical skills. He is an excellent PHP developer with a strong understanding of server and client scripts. ', '2016-04-02 22:54:30');

INSERT INTO `notifications` (`notification_id`, `notification_type_id`, `recipient_user_id`, `sender_user_id`, `correspondence_id`, `read`, `created_date`) VALUES
(52, 3, 1, 2, 38, 'Y', '2016-04-02 22:44:36'),
(53, 3, 1, 3, 39, 'Y', '2016-04-02 22:48:08'),
(54, 3, 1, 3, 40, 'Y', '2016-04-02 22:49:56'),
(55, 3, 2, 1, 41, 'Y', '2016-04-02 22:54:30');


-- End of clean up scripts --

