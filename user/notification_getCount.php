<?php
include_once 'classes/notification.php';	

if (isset($_REQUEST['user_id'])){
	$user_id=$_REQUEST['user_id'];

	$objNotification = new notification();
	$unreadMessageCount = $objNotification->getUnreadMessageCount($user_id);

	if (isset($unreadMessageCount) && $unreadMessageCount>0)
		echo $unreadMessageCount;
}	
?>