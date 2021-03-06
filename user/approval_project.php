<?php
$page_title = "Approvals";
$linkno = 2;
include_once 'includes/header.php';
include_once 'classes/project.php';
?>

<?php

$objProject = new project();


if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['key'] == $_SESSION['key'] )
{
	//echo '<br/><br/><br/><br/><br/>--->' . $_POST['approvehid'] ;
	$project_id = $_POST['approvehid'];
	$requester_user_id = $_POST['requester_userid'];
	
	if (isset($_POST['approvechbx'])){
		//echo '=checked';
		$yesno='Y';
	}	
	else{
		//echo '=unchecked';
		$yesno='N';
	}
			
$result=$objProject->updateProjectToApprove($userid, $requester_user_id, $project_id, $yesno);
}

// When page is refreshed, this will avoid multiple post
$_SESSION['key'] = mt_rand(1, 1000);

// Get approved projects
$dbRow_Projects = $objProject->getProjectsToApprove($userid);

?>

<script type="text/javascript">
$(document).ready(function(){
/*--------------------------*/
$(':checkbox').checkboxpicker();

/*    
$(".checkbox_class").change(
            function()
            {
                //if( $(this).is(":checked") )
                {
	                alert("hhh");
                    $("#approveForm").submit();
                }
            }
        )
*/        
/*--------------------------*/
});
</script>

    <!-- Begin page content -->
    <div class="container-fluid">

        <!-- page header -->
        <div class = "page-header">
            <h2>Approve Projects</h2>
        </div>

        <!-- Projects Table -->
        <div class="table-responsive">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="display: none;">Project Id</th>
                        <th>User Name</th>                        
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Approved</th>
                    </tr>
                </thead>

                <tbody>
	                
<?php
while ( isset($dbRow_Projects) && $dbRow = mysqli_fetch_array($dbRow_Projects))
{
	//echo "--->".$dbRow['skill_name']."<br>";
?>
	                
                    <tr>
                        <td  style="display: none;"><?php echo $dbRow['project_id'];?></td>
                         <td>
	                        <span class="text-capitalize">
	                        <?php echo $dbRow['fname'] . ' ' . $dbRow['lname']; ?></span>

                        </td>
                        <td><?php echo $dbRow['project_name'];?></td>
                        <td>
	                        <?php
		                        // Start date
									$startDate = new DateTime($dbRow['start_date']);
									echo $startDate->format('M y');   
	                        ?>
                        </td>
                        <td>
	                        <?php
		                        // End date
									if (isset($dbRow['end_date'])) {
										$endDate = new DateTime($dbRow['end_date']);
										echo $endDate->format('M y'); }
									else 
										echo 'Present';     
	                        ?>
	                        
                        </td>
                       
                        <td>
	                        <?php 
		                        //echo  substr($dbRow['approved'],0,1); 
		                    	    
	                        ?>
	                        
	                        <!-- https://forums.digitalpoint.com/threads/html-checkbox-onclick-submit.1271195/ -->
	                        
	                        <form id="approveForm" method="post">
		                     
		                     <input type="hidden" name="approvehid" value="<?php echo $dbRow['project_id'];?>" />
		                     
							 <input type="hidden" name="requester_userid" value="<?php echo $dbRow['user_id'];?>" />
		                     
							 <input type="hidden" name="key" value="<?php echo $_SESSION['key']; ?>" />
		                        
		                        
	                        <input type="checkbox" data-off-class="btn-warning" data-on-class="btn-primary" class="checkbox_class" name="approvechbx" value="<?php echo $dbRow['project_id'];?>" onchange="this.form.submit();" 
	                        <?php if(substr($dbRow['approved'],0,1)=="Y") echo "checked";?> >
	                        </form>
                        </td>

                    </tr>
                    
<?php }/*End of while loop*/ ?> 

                </tbody>
            </table>

        </div>

    </div>
    <!-- End page content -->

<?php
include_once 'includes/footer.php';
?>