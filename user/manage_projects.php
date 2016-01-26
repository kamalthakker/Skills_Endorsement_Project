<?php
$page_title = "Manage Projects";
$linkno = 0;
include_once 'includes/header.php';
include_once 'classes/project.php';
?>

<?php
$objProject = new project();

// Get approved projects
$dbRow_Projects = $objProject->getAllProjects($userid);
?>

    <!-- Begin page content -->
    <div class="container-fluid">

        <!-- page header -->
        <div class = "page-header">
            <h2>Manage Projects</h2>
        </div>

        <div class="pull-right">
            <a  role="button" class="btn btn-primary" href="addedit_project.php">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Add Project</span>
            </a>
        </div>



        <br/><br/><br/>

        <!-- Projects Table -->
        <div class="table-responsive">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="display: none;">Project Id</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Manager</th>
                        <th>Approved</th>
                        <th>Edit</th>
                        <th>Delete</th>
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
	                        <span class="text-capitalize">
	                        <?php echo $dbRow['manager_fname'] . ' ' . $dbRow['manager_lname']; ?></span>

                        </td>
                        <td>
	                        <span class="text-capitalize">
	                        <?php echo  substr($dbRow['approved'],0,1); ?></span>
                        </td>

                        <!-- Edit Button -->
                        <td>
                            <a role="button" href="addedit_project.php?project_id=<?php echo $dbRow['project_id'];?>" class="btn btn-default" aria-label="Left Align" >
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <a role="button" href="delete_project.php?project_id=<?php echo $dbRow['project_id'];?>" class="btn btn-default" aria-label="Left Align">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
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