<?php

include_once '../dbconnection.php';
include_once 'classes/skill.php';

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
	} // End of getApprovedProjects
	
	public function getAllProjects($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*List of all projects*/
				select p.*, u.fname as manager_fname, u.lname as manager_lname from projects p 
				inner join users u on p.manager_user_id=u.user_id
				where p.user_id=".$user_id. " order by p.end_date is not null, p.end_date desc, p.start_date desc";
	
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
	} // End of getAllProjects
	
	public function getProjectsToApprove($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*List of projects to approve*/
				select p.*, u.fname, u.lname from projects p 
				inner join users u on p.user_id=u.user_id
				where p.manager_user_id=".$user_id. " order by approved, p.end_date is not null, p.end_date desc, p.start_date desc";
	
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
	} // End of getProjectsToApprove
	
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
	
	public function getNotEnteredProjects($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*List of projects yet not entered by the user*/
				SELECT distinct project_name FROM projects 
				WHERE project_name not in (
				select distinct project_name from projects where user_id=".$user_id.")";
	
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
	} // End of getNotEnteredProjects
	
	public function addProject($user_id, $project_name, $project_desc, $start_date, $end_date, $manager_user_id, $skills){
		
		$project_id = $this->insertProject($user_id, $project_name, $project_desc, $start_date, $end_date, $manager_user_id);
		
		if ($project_id>0)
		{
			// Successfuly inserted project, now insert skills
			$result = $this->insertProjectSkills($project_id, $skills);
		}
		else
		{
			$result = false;
		}
		
		return $result;
		
	} // End of addProject
	
	public function editProject($project_id, $user_id, $project_name, $project_desc, $start_date, $end_date, $manager_user_id, $skills){
		
	} // End of updateProject
	
	private function insertProject($user_id, $project_name, $project_desc, $start_date, $end_date, $manager_user_id)
	{
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		if(!empty($end_date))
			$enddate="'".$end_date."'";
		else 
			$enddate="null";
		
		$q = "INSERT INTO projects (user_id, project_name, project_desc, start_date, end_date, manager_user_id)
			VALUES (".$user_id.",'".$project_name."','".$project_desc."','".$start_date."',".$enddate.",".$manager_user_id.")";
		
		//echo $q . '<br>';
		
		$r = mysqli_query($dbc,$q);
		
		// Get project_id of the insert query
		$project_id = -1; 
		if($r) $project_id = mysqli_insert_id($dbc);
		
		//echo '---->' . $project_id;
		
		mysqli_close($dbc); // close the connection
		
		return $project_id; // success= >0, failure=-1
		
	} // End of insertProject

	private function updateProject($project_id, $user_id, $project_name, $project_desc, $start_date, $end_date, $manager_user_id){
		
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "update projects
				set project_name='".$project_name."',
					project_desc='".$project_desc."',
					start_date='".$start_date."',
					end_date='".$end_date."',
					manager_user_id='".$manager_user_id."'
				where project_id=".$project_id." and user_id=".$user_id."";
		
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
		
		if($r)
			return true;
		else
			return false;
		
	} // End of updateProject
	
	private function insertProjectSkills($project_id, $skills){
		
		$result = true;
		
		foreach($skills as $skill_id) 
		{
			//echo '<br/>skill_id:'.$skill_id;
			
			if (is_numeric($skill_id)){
				
				// it is an existing skill
				$r=$this->insertProjectSkill($project_id,$skill_id);
				
				if ($r==false) $result=$r;	
			}
			else {
				// Insert a new skill
				$result = $this->insertCustomSkill($project_id,$skill_id);
			}
				
		}
		
		return $result;
		
	} // End of insertProjectSkills
	
	private function insertProjectSkill($project_id, $skill_id)
	{
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "INSERT INTO project_skills (project_id, skill_id)
				VALUES
				(".$project_id.", ".$skill_id.")";
		
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
		
		if($r)
			return true;
		else
			return false;
	} // End of insertProjectSkill
	
	private function deleteAllProjectSkill($project_id)
	{
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "Delete from project_skills where project_id=".$project_id;
		
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
		
		if($r)
			return true;
		else
			return false;
	} // End of deleteAllProjectSkill

	private function insertCustomSkill($project_id, $skill_name){
		// Create an object for skill
		$objSkill = new skill();
		
		// First check if it a duplicate skill, if yes, add that skill in the project table
		$skill_id=$objSkill->getSkillId($skill_name);
		
		if($skill_id<=0)
		{
			// It is a new skill and not fond in DB, so insert it
			$skill_id=$objSkill->insertSkill($skill_name);
		}
		else
		{
			// If skill_id>0, use it to insert below...
			// No need to do anything, this block is just for info
		}
		
		$result=$this->insertProjectSkill($project_id,$skill_id);

		return $result;
		
	} // End of insertCustomSkill
	
}// End of project class