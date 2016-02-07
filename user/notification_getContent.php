<?php
include_once 'classes/notification.php';	

// Return the value of time different in "xx times ago" format
function ago($timestamp)
{

//$today = new DateTime(date('y-m-d h:m:s'));
$today = new DateTime(null, new DateTimeZone('America/New_York'));

//$thatDay = new DateTime('Sun, 10 Nov 2013 14:26:00 GMT');
//$thatDay = new DateTime($timestamp);
$thatDay = $timestamp;

$dt = $today->diff($thatDay);

if ($dt->y > 0)
{
    $number = $dt->y;
    $unit = "year";
}
else if ($dt->m > 0)
{
    $number = $dt->m;
    $unit = "month";
}   
else if ($dt->d > 0)
{
    $number = $dt->d;
   $unit = "day";
}
else if ($dt->h > 0)
{
    $number = $dt->h;
    $unit = "hour";
}
else if ($dt->i > 0)
{
    $number = $dt->i;
    $unit = "minute";
}
else if ($dt->s > 0)
{
    $number = $dt->s;
    $unit = "second";
}

$unit .= $number  > 1 ? "s" : "";

$ret = $number." ".$unit." "."ago";
return $ret;
}


if (isset($_REQUEST['user_id'])){
	$user_id=$_REQUEST['user_id'];

	$objNotification = new notification();
	$dbRows_Notifications = $objNotification->getNotifications($user_id);
	
	if (!isset($dbRows_Notifications))
		echo '<li><a href="#">No new notifications</a></li>';

	$ncount=0;
		
	while ( isset($dbRows_Notifications) && $dbRow = mysqli_fetch_array($dbRows_Notifications))
	{
		$ncount=$ncount+1;
		
		if ($ncount>1) echo '<li class="divider"></li>';

?>		

	<li><a href="#">
	
	<div class="row">
		<div class="col-sm-2">
			
			<img src="../images/userdp/<?php echo $dbRow['su_userdp']?>" class="img-responsive voffset2" alt="img" width="60" height="60">
			
		</div> <!-- end of column -->
		
		<div class="col-sm-10">
			<h4>
				<span class="text-capitalize">
			        <?php echo $dbRow['su_fname'] . ' ' . $dbRow['su_lname']; ?>
			    </span>
			    
				<?php if ($dbRow['read']=='N'){?>
					<span class="badge progress-bar-info pull-right">New</span> 
	            <?php }?>	
		    </h4>
		    
		    <p>
			  
			  <?php if ($dbRow['notification_name']=='project_added'){?>
			  <!-- When project is added, notify the manager-->
			  I have added <span class="text-capitalize"><?php echo $dbRow['project_name'];?></span> project. Please approve.
			  <?php }?> 
			  
			  <?php if ($dbRow['notification_name']=='project_approved'){?>
			  <!-- When project is approved/disapproved, notify the requester-->
			  I have 
			  <?php if($dbRow['approved']=='N') echo 'disapproved'; else echo 'approved'; ?>
			  <span class="text-capitalize"><?php echo $dbRow['project_name'];?></span> project.
			  <?php }?> 
			  
			  <?php if ($dbRow['notification_name']=='endorsed'){?>
			  <!-- When a skill endorsed, notify the requester-->
			  Congratulations! I have endorsed you for <?php echo $dbRow['skill_name'];?>
			  <br/>
			  <q class="lead1">
            	<span class="more">
	            <?php echo trim($dbRow['comments']); ?>
	            </span>
			  </q>

			  
			  <?php }?>
			  
			  &nbsp;&nbsp;·&nbsp;&nbsp;<!--2h ago-->
			  
			  <?php 
				$created_date=new DateTime(null, new DateTimeZone('America/New_York')); 
				$created_date = new DateTime($dbRow['created_date'], new DateTimeZone('America/New_York'));
			  
				$diff = ago($created_date);    // output: 23 hrs ago  
				echo $diff;
				  
			/*  To be deleted
			  $created_date=new DateTime(null, new DateTimeZone('America/New_York')); 
			  $created_date = new DateTime($dbRow['created_date'], new DateTimeZone('America/New_York'));
			  $now = new DateTime(null, new DateTimeZone('America/New_York'));
			  
			  $since_start = $created_date->diff($now);
			  
			  if ($since_start->s < 60) 				//  Seconds
			  	echo $since_start->s.'seconds ago';
			  else if ($since_start->i < 60) 			//  Minutes
			  	echo $since_start->i.'minutes ago';
			  else if ($since_start->h < 24)			//	Hours
			  	echo $since_start->h.'hours ago';
			  else if ($since_start->d < 32)			//	Days
			  	echo $since_start->d.'days ago';
			  else 	echo $since_start->m.'months ago';	//	Months
			*/  
			  ?>
			  
		    </p>
		    
		</div>	<!-- end of column -->
		
	</div> <!-- end of row -->	 
		
	
	</a></li>
	                        	
	

<?php		
		
	} // End of while loop
	
	// Mark unread messages as read
	$objNotification->markAsRead($user_id);
	
}// end of If Condition		
	
	
	
?>

<!--
<li><a href="#">
	<span class="badge progress-bar-info"><small>New</small></span>
	aaaa aaaaa aaaaa aaaaa aaaa aaaaa aaa &nbsp;&nbsp;·&nbsp;&nbsp;2h ago</a></li>
	                        	
	                        	<li class="divider"></li>
                            <li><a href="#">bbbb</a></li>
                            	<li class="divider"></li>
                            <li><a href="#">cccc</a></li>
                            	<li class="divider"></li>
							<li><a href="#">dddd</a></li>
							
							<li><a href="#">aaaa</a></li>
	                        	<li class="divider"></li>
                            <li><a href="#">bbbb</a></li>
                            	<li class="divider"></li>
                            <li><a href="#">cccc</a></li>
                            	<li class="divider"></li>
							<li><a href="#">dddd</a></li>
							
							<li><a href="#">aaaa</a></li>
	                        	<li class="divider"></li>
                            <li><a href="#">bbbb</a></li>
                            	<li class="divider"></li>
                            <li><a href="#">cccc</a></li>
                            	<li class="divider"></li>
							<li><a href="#">dddd</a></li>
-->							