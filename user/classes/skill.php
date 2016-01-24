<?php

include_once '../dbconnection.php';

class skill{

public function getSkillId($skill_name){
	
	/*If found in DB (by removing all spaces), send its id
		if found, skill_id > 0, else skill_id = 0
	*/
	
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "select IFNULL(max(skill_id),0) as skill_id from skills
				where REPLACE(name, ' ', '') = REPLACE('".$skill_name."',' ', '')";
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
	
		if (isset($r) && mysqli_num_rows($r) >= 1)
		{
			//found in DB
			$row = mysqli_fetch_array($r);
			return 	$row['skill_id']; 
		}
		else
		{
			// not found in DB
			return 0;
		}
	} // End of getSkillId

public function insertSkill($skill_name) {
	
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "Insert into skills (name) value
(trim(CONCAT(UCASE(SUBSTRING('".$skill_name."',1,1)),'', LCASE(SUBSTRING('".$skill_name."',2,LENGTH('".$skill_name."'))))))";
		
		//echo $q . '<br>';
		
		$r = mysqli_query($dbc,$q);
		
		// Get project_id of the insert query
		$skill_id = -1; 
		if($r) $skill_id = mysqli_insert_id($dbc);
		
		//echo '---->' . $skill_id;
		
		mysqli_close($dbc); // close the connection
		
		return $skill_id; // success= >0, failure=-1
		
	} // End of insertSkill

} // End of class
	
?>