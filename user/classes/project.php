<?php

include_once '../dbconnection.php';

class project{

	public function getApprovedProjects($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*List of approved projects*/
				select p.*, u.fname as manager_fname, u.lname as manager_lname from projects p 
				inner join users u on p.manager_user_id=u.user_id
				where upper(approved)='Y' and p.user_id=".$user_id. " order by p.end_date is not null, p.end_date desc, p.start_date desc";
	
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
	
	public function getProjectSkills($project_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*Project skills with ranking*/
				select pskill.user_id, pskill.project_skill_id, pskill.project_id, pskill.skill_id, pskill.skill_name, skillrank.rank  from
				(
					select p.user_id, ps.project_skill_id, ps.project_id, ps.skill_id, s.name as skill_name from project_skills ps
					inner join skills s on s.skill_id=ps.skill_id
					inner join projects p on p.project_id=ps.project_id
					where p.project_id=".$project_id."
				) pskill
				left join
				( 
					select user_id, skill_id, count(skill_id) as rank from  skill_endorsements
					group by user_id, skill_id
				) skillrank
				on pskill.skill_id=skillrank.skill_id and pskill.user_id=skillrank.user_id
				order by skillrank.rank desc, pskill.skill_name;";
	
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
	} // End of getProjectSkills

	
}// End of project class