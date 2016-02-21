<?php
include_once 'classes/endorsement.php';
	
$skill_id=$_REQUEST['skillid'];
$skill_name=$_REQUEST['skillname'];
$display_user_id=$_REQUEST['displayuserid'];
$logged_user_id=$_REQUEST['loggedinuserid'];

// Create an object for categories
$objEndorsement = new endorsement();

// Get user info
$dbRow_EndorsedComment = $objEndorsement->getEndorsedComment($display_user_id, $logged_user_id, $skill_id);

if(isset($dbRow_EndorsedComment)) {
	$returnVal['found']='Y';
	$returnVal['skill_endorsement_id']=$dbRow_EndorsedComment['skill_endorsement_id'];
	$returnVal['comments']=$dbRow_EndorsedComment['comments'];
}
else
{
	$returnVal['found']='N';
}

echo json_encode($returnVal);

?>