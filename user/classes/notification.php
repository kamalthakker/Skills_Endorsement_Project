<?php

include_once '../dbconnection.php';
include_once 'classes/user.php';
include_once 'classes/email.php';
//require("../sendgrid-php/sendgrid-php.php");

class notification{
	
	public function getUnreadMessageCount($user_id){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
	
		$q = "/*Unread messages*/ 
				select count(*) as ncount from notifications nt
				where nt.recipient_user_id=".$user_id." and nt.read='N'";
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
	
		if (isset($r) && mysqli_num_rows($r) >= 1)
		{
			//found in DB
			$row = mysqli_fetch_array($r);
			return 	$row['ncount']; 		}
		else
		{
			// not found in DB
			return 0;
		}
	} // End of getUnreadMessageCount
	
	public function getNotifications($user_id, $notification_id=null){
	
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
		if(isset($notification_id)) $where="where n.notification_id=".$notification_id; else $where="where n.recipient_user_id=".$user_id;
	
		$q = "/*Notifications*/
				select  
				n.notification_id,
				n.notification_type_id,
				nt.notification_name,
				  n.recipient_user_id,
				  ru.fname as ru_fname, 
				  ru.lname as ru_lname, 
				  ru.userdp as ru_userdp,
				  ru.email as ru_email,
				 n.sender_user_id, 
				 su.fname as su_fname, 
				 su.lname as su_lname, 
				 su.userdp as su_userdp,
				 su.email as su_email,
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
				on nt.notification_name in ('project_added','project_approved', 'project_disapproved') and 
				   n.correspondence_id=p.project_id
				left join skill_endorsements se
				on nt.notification_name in ('endorsed') and
				   n.correspondence_id=skill_endorsement_id
				left join skills s on
				se.skill_id=s.skill_id	   
				". $where ."
				order by n.created_date desc
				limit 8" ;
	
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
	} // End of getNotifications
	
	public function markAsRead($user_id){
		
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "update notifications n
				set n.read='Y'
				where n.recipient_user_id=".$user_id." and n.read='N'";
		
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
		
		if($r)
			return true;
		else
			return false;
		
	} // End of markAsRead
	
	public function addNotification($notification_type_id, $recipient_user_id, $sender_user_id, $correspondence_id) {
		
		$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
		
		$q = "INSERT INTO notifications (notification_type_id, recipient_user_id, sender_user_id, correspondence_id)
				VALUES
				(".$notification_type_id.", ".$recipient_user_id.", ".$sender_user_id.", ".$correspondence_id.")";
		
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		
		// Get notification_id of the insert query
		$notification_id = -1; 
		if($r) $notification_id = mysqli_insert_id($dbc);
		
		mysqli_close($dbc); // close the connection
		
		if($r)
		{
			//$this->sendEmail($notification_type_id,$recipient_user_id);
			$this->emailNotification($notification_id);
			return true;
		}else{
			return false; }
			
	} // End of addNotification
	
	private function emailNotification($notification_id){
	
		$r = $this->getNotifications(null, $notification_id);	
		$row = mysqli_fetch_array($r);
		
		$to = $row['ru_email'];
		$subject='MITRE SE - New Notification';
		
		$message='';
		//$message='<img src="http://skillsendorsement-monmouth.rhcloud.com/images/userdp/'. $row['su_userdp'] . ' class="img-responsive voffset2" alt="img" width="60" height="60">';
		
		if ($row['notification_name']=="project_added"){
			$message .=  '<h3>' . $row['su_fname'] . ' ' . $row['su_lname'] . ':</h3>';
			$message .= 'I have added a new project, ' . $row['project_name'] . '. Please approve.';
		} 
		
		if ($row['notification_name']=="project_approved"){
			$message .=  '<h3><span class="text-capitalize">' . $row['su_fname'] . ' </span><span class="text-capitalize">' . $row['su_lname'] . '</span>:</h3>';
			$message .= 'I have approved ' . $row['project_name'] . ' project.';
		} 
		
		if ($row['notification_name']=="project_disapproved"){
			$message .=  '<h3><span class="text-capitalize">' . $row['su_fname'] . ' </span><span class="text-capitalize">' . $row['su_lname'] . '</span>:</h3>';
			$message .= 'I have disapproved ' . $row['project_name'] . ' project.';
		}
		
		if ($row['notification_name']=="endorsed"){
			$message .=  '<h3>' . $row['su_fname'] . ' ' . $row['su_lname'] . ':</h3>';
			$message .= 'Congratulations! I have endorsed you for '. $row['skill_name'] . '.';
			$message .= '<br/><q>' . $row['comments'] . '</q>';
			
		}
		
		$message .= '<br/><br/>Login here: <a href="http://skillsendorsement-monmouth.rhcloud.com">http://skillsendorsement-monmouth.rhcloud.com</a>';
		
		/*
		echo '<br/><br/><br/><br/><br/><br/>';
		echo $subject 	. 	'<br/>';
		echo $to 		.	'<br/>';
		echo $message 	. 	'<br/>';				
		*/
		
		// Create an object for email
		$objEmail = new email();
		
		// Send email
		$objEmail->sendEmail($to, $subject, $message);
	
	} // End of emailNotification
	
	/*
	private function sendEmail($notification_type_id, $recipient_user_id){
		
		$objUser = new user();
		$rowuser=$objUser->getUserInfo($recipient_user_id);
		$to_email_id=$rowuser['uname'];
		
		
        $sendgrid = new SendGrid('kkamalthakker696', 'm0nm0uth'); 
		$email    = new SendGrid\Email();
	
		//$to		= $to_email_id;
		$to 	= "kamalthakker@gmail.com";
		
		$subject = "You have a new notification!";
		
		if($notification_type_id==1){
			//Project added
			$message="A new project is added, please approve!";
		}else if($notification_type_id==2){
			//Project approved/disapproved
			$message="Your project has been approved or disapproved.";
		}else if($notification_type_id==3){
			//endorsed
			$message="You have been endorsed!";
		}
		
		$email->addTo($to)
		      ->setFrom("MITRE.SE.Notifications@skillsendorsement-monmouth.rhcloud.com")
		      ->setSubject($subject)
		      ->setHtml($message);
		
		$sendgrid->send($email);
		
	} // sendEmail
	*/
}
	
?>