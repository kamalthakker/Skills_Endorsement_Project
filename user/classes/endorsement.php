<?php

include_once '../dbconnection.php';

class endorsement{
	
public function addEndorsement($skill_id, $display_user_id, $logged_user_id, $message){
		
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "INSERT INTO skill_endorsements (user_id, skill_id, endorsed_by_user_id, comments)
VALUES (".$display_user_id.",".$skill_id.",".$logged_user_id.",'".$message."')";
		
		//echo $q . '<br>';
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
		
		if($r)
			return true;
		else
			return false;
		
	}
	
}