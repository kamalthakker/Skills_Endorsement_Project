<?php

include_once '../dbconnection.php';
include_once 'classes/notification.php';

class endorsement{
	
public function addUpdateEndorsement($skill_endorsement_id, $skill_id, $display_user_id, $logged_user_id, $message){
		
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		if ($skill_endorsement_id <= 0)
		{
			$q = "INSERT INTO skill_endorsements (user_id, skill_id, endorsed_by_user_id, comments)
VALUES (".$display_user_id.",".$skill_id.",".$logged_user_id.",'".$message."')";
		}
		else
		{
			$q = "Update skill_endorsements 
					set 
						comments='".$message."',
						endorsed_on=CURRENT_TIMESTAMP
					where skill_endorsement_id=".$skill_endorsement_id;
		}
		//echo $q . '<br>';
		
		$r = mysqli_query($dbc,$q);
		
		// Get $skill_endorsement_id of the insert query
		if ($skill_endorsement_id <= 0) {
			$skill_endorsement_id = -1; 
			if($r) $skill_endorsement_id = mysqli_insert_id($dbc); }

		mysqli_close($dbc); // close the connection
		
		if($r) {
			
			// Add notification -- endorsed
			$objNotification = new notification();
			$result = $objNotification->addNotification(3,$display_user_id,$logged_user_id,$skill_endorsement_id);
			
			return true;
		}	
		else {
			return false;
		}
	} // End of addUpdateEndorsement

public function getEndorsementSuggestions($logged_user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*Endorsement suggestions*/
				select p2.project_id, p2.project_name, u.user_id, u.fname, u.lname, 
				case when already_endorsed.cskill is null then 
				FLOOR(RAND() * 15) + 1 else already_endorsed.cskill end as cskill
				FROM projects p1
				inner join projects p2 on
				p1.project_name=p2.project_name and p2.user_id<>".$logged_user_id." and p2.approved='Y'
				inner join users u on
				p2.user_id=u.user_id
				left join 
				(select user_id, count(skill_id)*100 cskill from skill_endorsements
				WHERE endorsed_by_user_id=1) already_endorsed on
				already_endorsed.user_id=u.user_id
				where p1.approved='Y' and p1.user_id=".$logged_user_id." 
				order by cskill
				limit 5;";
	
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
	} // End of getEndorsementSuggestions

public function getRecentActivities(){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*Recent activities*/
				select se.*, s.name, 
				uto.fname as uto_fname, 
				uto.lname as uto_lname,
				uby.fname as uby_fname,
				uby.lname as uby_lname
				from skill_endorsements se
				inner join skills s on
				se.skill_id=s.skill_id
				inner join users uto on 
				uto.user_id=se.user_id
				inner join users uby on 
				uby.user_id=se.endorsed_by_user_id
				order by se.endorsed_on desc
				limit 5";
	
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
	} // End of getRecentActivities

public function getEndorsementLeft($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "select (select c.value from config c where c.name='max_endorsement')-count(*) as endorsement_left from  skill_endorsements se
					where year(endorsed_on)=year(CURDATE()) and se.endorsed_by_user_id=".$user_id;
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
	
		if (isset($r) && mysqli_num_rows($r) >= 1)
		{
			//found in DB
			$row = mysqli_fetch_array($r);
			return 	$row['endorsement_left']; 
		}
		else
		{
			// not found in DB
			return null;
		}
	} // End of getEndorsementLeft

public function getEndorsedComment($display_user_id, $logged_user_id, $skill_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*Get latest endorsed comment*/
				select * from skill_endorsements se2 
				where se2.skill_endorsement_id =
					(select max(se.skill_endorsement_id) from skill_endorsements se
					where se.endorsed_by_user_id=".$logged_user_id." and se.user_id=".$display_user_id." and se.skill_id=".$skill_id."  and year(endorsed_on)=year(CURDATE()) )";
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
	
		if (isset($r) && mysqli_num_rows($r) >= 1)
		{
			//found in DB
			$row = mysqli_fetch_array($r);
			return 	$row; 
		}
		else
		{
			// not found in DB
			return null;
		}
	} // End of getEndorsedComment

	
} // End of class

?>	