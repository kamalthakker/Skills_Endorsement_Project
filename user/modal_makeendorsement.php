<?php 

include_once 'classes/endorsement.php';

if ( isset($_REQUEST['skillid']) && isset($_REQUEST['displayuserid']) && isset($_REQUEST['loggedinuserid']) && isset($_REQUEST['message']) )
{
	// Get values
	$skill_endorsement_id=$_REQUEST['skillendorsementid'];
	$skill_id=$_REQUEST['skillid'];
	$display_user_id=$_REQUEST['displayuserid'];
	$logged_user_id=$_REQUEST['loggedinuserid'];
	$message=$_REQUEST['message'];	
	
	/*	
	echo 'skill_id:' . $skill_id . '<br>';
	echo 'display_user_id:' . $display_user_id . '<br>';
	echo 'logged_user_id:' . $logged_user_id . '<br>';
	echo 'message:' . $message . '<br>';
	*/
	
	$objEndorsement = new endorsement();
	
	// Insert endorsement in DB
	$result = $objEndorsement->addUpdateEndorsement($skill_endorsement_id, $skill_id, $display_user_id, $logged_user_id, $message);
	
	if($result) 
	{
		$success = '<div class="alert alert-success" role="alert">
			<span class="lead1"><strong>Thank you, your recommendation has been submitted!</strong></span></div>';
			
			echo $success;
	}
	else
	{
		$failure = '<div class="alert alert-info" role="alert">
	<strong>Failed to submit the recommendation, please contact sys admin!</strong>
</div>'	;

		echo $failure;
	}

} else
{
$failure = '<div class="alert alert-info" role="alert">
	<strong>Get values are not provides, try again!</strong>
</div>'	;

echo $failure;
}
?>