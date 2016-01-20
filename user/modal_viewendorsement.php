<?php
include_once 'classes/user.php';



	
$skill_id=$_REQUEST['skillid'];
$skill_name=$_REQUEST['skillname'];
$display_user_id=$_REQUEST['displayuserid'];
$logged_user_id=$_REQUEST['loggedinuserid'];

/*
echo 'skill_id:' . $skill_id . '<br>';
echo 'skill_name:' . $skill_name . '<br>';
echo 'display_user_id:' . $display_user_id . '<br>';
echo 'logged_user_id:' . $logged_user_id . '<br>';
*/

// Create an object for categories
$objUser = new user();

// Get user info
$dbRow_Endorsements = $objUser->getEndorsements($display_user_id, $skill_id);

if (!isset($dbRow_Endorsements)){
	echo '<br/><p class="lead">The ' .$skill_name. ' skill is not yet endorsed!</p>';
}

while ( isset($dbRow_Endorsements) && $dbRow = mysqli_fetch_array($dbRow_Endorsements))
{
	//echo "--->".$dbRow['fname']."<br>";
?>

<div class="bs-callout bs-callout-primary">

    <div class="row">

        <div class="col-md-1" role="main" style="background-color: #ffffff">
	        <a href="#"> 
            <img src="../images/userdp/<?php echo $dbRow['userdp']?>" class="img-responsive" alt="img" width="80" height="80"> </a>
        </div>

        <div class="col-md-11" role="main" style="background-color: #ffffff">
            <h4>
	            <a href="#"> 
		            <span class="text-capitalize">
		            	<?php echo $dbRow['fname'] . ' ' . $dbRow['lname']; ?>
		            </span>
	            </a> 
	            
	            <span class="pull-right"> 
	            	<small>
	            		<?php 
		            		$EndorsedOn = new DateTime($dbRow['endorsed_on']);
							echo $EndorsedOn->format('m/d/y');
	            		?>
	            	</small>
	            </span>
	            
	            <br> 
	            
	            <small>
	            	<span class="text-capitalize">
		            	<?php echo $dbRow['job_title']; ?>
		            </span>
	            </small>
	         </h4>

            <q class="lead1">
            	<span class="more">
	            <?php echo trim($dbRow['comments']); ?>
	            </span>
            </q>

        </div>

    </div> <!-- end of row -->

</div> <!-- end of callout -->

<?php } /*End of while loop*/ 
?>


