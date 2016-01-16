<?php

include_once '../dbconnection.php';

class user{


public function getUserInfo($user_id){
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		
		$q = "select * from users
				where user_id=".$user_id;
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection

		if (mysqli_num_rows($r) == 1)
		{
			// User is found in DB
			$row = mysqli_fetch_array($r);
			return 	$row;
		}
		else
		{
			// User is not found in DB
			return null;
		}
	
	} // End of getUserInfo

public function getUserSkillsWithRank($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*All user's skills with endorsement rankings*/
				select userskills.user_id, userskills.skill_id, userskills.skill_name, skillrank.rank from 
				(
					select p.user_id, ps.skill_id, s.name as skill_name from project_skills ps 
					inner join projects p on p.project_id=ps.project_id
					inner join skills s on s.skill_id=ps.skill_id
				 	where upper(p.approved)='Y' and user_id=".$user_id."
				) userskills
				left join
				( 
					select skill_id, count(skill_id) as rank from  skill_endorsements
					where user_id=".$user_id."
					group by skill_id
				) skillrank
				on userskills.skill_id=skillrank.skill_id
				order by skillrank.rank desc, userskills.skill_name";
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
	
		if (isset($r) && mysqli_num_rows($r) >= 1)
		{
			//found in DB
			//$row = mysqli_fetch_array($r);
			return 	$r; // send collection
		}
		else
		{
			// not found in DB
			return null;
		}
	} // End of getUserSkills


	
} // End of class

?>	