<?php
$page_title = "Home";
$linkno = 1;	
$search_user_id=null;
	
if(isset($_REQUEST['search_user_id'])) {	
	$search_user_id=$_REQUEST['search_user_id'];
	$page_title = "Search";
	$linkno = 0;	
}


include_once 'includes/header.php';
include_once 'classes/user.php';
include_once 'classes/project.php';
?>

<?php 
function printSkills($dbRows_UserSkillsWithRank, $HowManyShow, $LoggedInUserId, $DisplayUsername)
{
	$counter = 0;
	$more = 0;
	
	
	echo '<ul class="nav nav-pills" role="tablist">';	
	
	while ( isset($dbRows_UserSkillsWithRank) && $dbRow = mysqli_fetch_array($dbRows_UserSkillsWithRank))
	{
		$counter = $counter + 1;
		
		$li_str = '<li role="presentation"><a href="#" data-toggle="modal" data-target="#makeViewEndorsementsModal" data-skillid="'.$dbRow['skill_id'].'"  data-skillname="'.$dbRow['skill_name'].'"  data-displayuserid="'.$dbRow['user_id'].'"  data-loggedinuserid="'.$LoggedInUserId.'" data-displayusername="'.$DisplayUsername.'">'. $dbRow['skill_name'] .'<span class="badge">'. $dbRow['rank'] .'</span></a></li>';
		
		if ($counter <= $HowManyShow)
		{
			echo $li_str;
		}
		else if ($counter==$HowManyShow+1)
		{
			$more = $more + 1;
			echo '<span class="nav nav-pills collapse" id="hiddenskills">';
			echo $li_str;	
		}
		else if ($counter>$HowManyShow)
		{
			$more = $more + 1;
			echo $li_str;
		}
		
		
	} // End of while
	
	// If skills are not set, show that skills are not available.
	if ( !isset($dbRows_UserSkillsWithRank) ) echo '<li role="presentation">Skills are not entered!</li>';


	if ($counter>$HowManyShow) echo '</span>';
	echo '</ul>';
	
	if ($counter>$HowManyShow) 
		echo '<a href="#" id="more" data-more="'.$more.'" class="morelessul" data-toggle="collapse" data-target="#hiddenskills">See more ('.$more.'+) </a>';
}
?>

<?php 


/*	
echo "<br><br><br><br><br><br><br>";
echo $userid;
		
$objUser = new user();
$dbRowsUserSkillsWithRank = $objUser->getUserSkillsWithRank(1);


// Collection	
while ( isset($dbRowsUserSkillsWithRank) && $dbRow = mysqli_fetch_array($dbRowsUserSkillsWithRank))
{
	echo "--->".$dbRow['skill_name']."<br>";
}

// Single row
$dbRowsUserInfo = $objUser->getUserInfo(1);
echo "--->".$dbRowsUserInfo['fname']."<br>";
*/

// by default - show logged in user - otherwise show searched user
if(isset($search_user_id))
	$display_user_id=$search_user_id;
else
	$display_user_id=$userid;

/*----------------------------*/
// Create an object for categories
$objUser = new user();

// Get user info
$dbRow_UserInfo = $objUser->getUserInfo($display_user_id);

// Get user's skills with ratings
$dbRows_UserSkillsWithRank = $objUser->getUserSkillsWithRank($display_user_id);

/*----------------------------*/
$objProject = new project();

// Get approved projects
$dbRow_Projects = $objProject->getApprovedProjects($display_user_id);
/*----------------------------*/
?>

<script type="text/javascript">

    $(document).ready(function(){


        $('.morelessul').click(function(){ 
	        
	        //alert($(this).data("more"));
	        
	        if ($(this).text().substring(0, 8) == 'See more') {
                //window.alert("change to see less");
                $(this).text('See less');
            } else {
                //window.alert("change to see more");
                $(this).text('See more ('+ $(this).data("more") +'+)');
            }
            });
            
        /* -----------------------------
	        On modal show for skills
	       ----------------------------- */
        $('#makeViewEndorsementsModal').on('show.bs.modal', function (event) {
	        	
	        	//alert("heloo!"); // debug
	        	
                //var loadingContent = '<div class="modal-header"><h2>Processing...</h2></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div>';
                //var loadingContent = '<div id="ajax_loader" style="position: fixed; left: 50%; top: 50%;"><img src="https://www.drupal.org/files/issues/ajax-loader.gif"></img></div>'
                var loadingContent = '<div id="ajax_loader" style="position: fixed; left: 50%; top: 50%;"><img class="img-responsive center-block" src="../images/ajax-loader.gif"></img></div>'
                
                var button = $(event.relatedTarget);
                
                var skillname = button.data('skillname');
                var skillid = button.data('skillid');
                
                var displayusername = button.data('displayusername'); // Endorse To Name
                var displayuserid = button.data('displayuserid'); // Endorse To
                var loggedinuserid = button.data('loggedinuserid'); // Endorse By
                
                
                var dataString = 'skillid='+skillid+'&skillname='+skillname+'&displayuserid='+displayuserid+'&loggedinuserid='+loggedinuserid;
                var modal = $(this);
                
                // For Make an endorsement 
                $('#endorsefor').empty();
                $('#endorsefor').append("Endorse <span class=\"text-capitalize\">"+ displayusername +"</span> for "+ skillname +"!");

                // Clear the old content before making the call...
                $('#viewEndorsement').empty();

                // Showing loading icon
                $('#viewEndorsement').append(loadingContent);

					

                /* AJAX Call */
                $.ajax({
                    cache: false,
                    type: 'GET',
                    url: 'modal_viewendorsement.php',
                    data: dataString,
                    success: function(data)
                    {
	                    
                        $('#viewEndorsement').empty();
                        $('#viewEndorsement').append(data);
                    }
                });
                /* End of AJAX Call */


                modal.find('.modal-title').text('Endorsement - ' + skillname);
                //modal.find('.modal-body input').val(recipient);

                // set maximum height
                $('.modal .modal-body').css('overflow-y', 'auto');
                //$('.modal .modal-body').css('max-height', $(window).height() * 0.5);
                $('.modal .modal-body').css('max-height', '65%');
            });    

        }); // End of ready function
        
        
        
</script>	

<!-- Endorsement Modal -->
<div class="modal fade" id="makeViewEndorsementsModal" tabindex="-1" role="dialog" aria-labelledby="makeViewEndorsementsModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Endorsement</h4>
            </div>
            <div class="modal-body">

                <!-- body -->

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#viewEndorsement">View endorsements</a></li>
                    
                    <!-- hide when it is for the logged in user -->
                    <li <?php if ($display_user_id==$userid) echo 'style="display:none;"' ?>><a data-toggle="tab" href="#makeEndorsement">Make an endorsement</a></li>
                </ul>

                <div class="tab-content">

                    <div id="viewEndorsement" class="tab-pane fade in active">
                        <br/><br/><br/><br/>

                    </div>

                    <div id="makeEndorsement" class="tab-pane fade in">

                        <div class="modal-body" id="recform">
                            <form class="contact" id="contact" name="contact">
                            <h4 class="lead" id="endorsefor">Endorse Kamal Thakker for Java!</h4>

                            <label for="Recommendation" class="sr-only">Recommendation</label>
                            <textarea name = "recommendation" class="form-control input-xlarge"  style="min-width: 100%; min-height: 35%;" placeholder="Your recommendation meesage" required autofocus></textarea>

                            <br>

                            <input class="btn btn-primary pull-right"  value = "Endorse" type="submit" id="submitEndorsement">
                                <button type="button" class="btn btn-primary" id="submitEndorsement1">Save changes</button>
                            </form>
                        </div>

                    </div>


                </div>

                <!-- end of body -->



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<!-- End of endoresment modal -->


<!-- Begin page content -->
<div class="container-fluid">

    
 <!-- Page header can go here if needed... -->
    
    <div class="row"> <!-- Main page row that has left and right area -->

        <!-- Left Area -->
        <div class="col-md-9" role="main" style="background-color: #ffffff">
	        
	        <!-- Top row - Display picture, and person's info, skills -->
	        <div class="row">
		        
		        <!-- DP - Display Image -->
		        <div class="col-md-2" style="background-color: #ffffff">
			        <!-- images/default-user.png -->
			        <img src="<?php if ( isset($dbRow_UserInfo['userdp']) ) echo '../images/userdp/'. $dbRow_UserInfo['userdp']; else echo '../images/userdp/default-user.png';?>" class="img-responsive voffset3" alt="Cinque Terre" width="200" height="200">
		        </div>

				<!-- Detail - like name, title, etc. -->
				<div class="col-md-4" style="background-color: #ffffff">
					<h2 class="text-capitalize"><?php 
						$displayname=$dbRow_UserInfo['fname'] . ' ' . $dbRow_UserInfo['lname'];
						echo $displayname; 
						?></h2>


                    <addres>    
                        <span class="text-capitalize"><?php echo $dbRow_UserInfo['job_title']; ?></span> <br/>
						<strong><abbr title="Phone">P:</abbr> <?php echo $dbRow_UserInfo['phone']; ?></strong><br/>
						<a href="mailto:#"><?php echo $dbRow_UserInfo['email']; ?></a> <br/>
						<?php echo $dbRow_UserInfo['zip']; ?> | <?php echo $dbRow_UserInfo['city']; ?>, <?php echo $dbRow_UserInfo['state']; ?> <br/>
						Speciality: <?php echo $dbRow_UserInfo['speciality']; ?> <br/>
						2nd Speciality: <?php echo $dbRow_UserInfo['speciality2']; ?>
					</addres>
					
					
			</div>
				
			<!-- Skills-->
			<div class="col-md-6" style="background-color: #ffffff">
					
					<h2 class="text-capitalize">Skills</h2>
						
					<?php printSkills($dbRows_UserSkillsWithRank, 10, $userid, $displayname); ?>

					
				</div> <!-- End of Skills-->
	        </div> <!-- End of row -->
		     
		     
		     <hr class="divider">
		     
		     <!-- Projects -->
		     <div class="row">
			    
			    <!-- one column with 100% width -->
			    <div class="col-md-12" style="background-color: #ffffff"> 
				    
				      <div class="bs-example" data-example-id="list-group-custom-content"> 
	            <div class="list-group"> 
		            
		            <div  class="list-group-item active"> 
		            	<h4 class="list-group-item-heading">Projects</h4> 
		            </div> 
		            
		            <?php while ( isset($dbRow_Projects) && $dbRow = mysqli_fetch_array($dbRow_Projects)){ ?>
		            
		            <div  class="list-group-item"> 
			            
			          <div class="row">
				          
				          <!-- Project name, start/end date, manager -->
				          <div class="col-md-3" style="background-color: #ffffff"> 
					          <h4 class="list-group-item-heading"><?php echo $dbRow['project_name']; ?></h4> 
					          <p class="list-group-item-text">
						          	
								<?php
									// Start date
									$startDate = new DateTime($dbRow['start_date']);
									echo $startDate->format('M y') . ' - ';
								
									// End date
									if (isset($dbRow['end_date'])) {
										$endDate = new DateTime($dbRow['end_date']);
										echo $endDate->format('M y'); }
									else 
										echo 'Present'; 	
								?>
								
					          </p>
					          
					          <p class="list-group-item-text text-capitalize">Manager: 
						          <?php echo $dbRow['manager_fname'] . ' ' . $dbRow['manager_lname']; ?>
					          </p>
					          						      
				          </div>
				          
				          <!-- Project Desc -->
				          <div class="col-md-5" style="background-color: #ffffff"> 
					          <h4 class="list-group-item-heading">Project Description:</h4>
							  <p class="list-group-item-text">
								  <span class="more">
								  <?php echo $dbRow['project_desc']; ?>
								  </span></p>
				          </div>
				          
				          <!-- Skills used -->
				          <div class="col-md-4" style="background-color: #ffffff">
					          <h4 class="list-group-item-heading">Skills Used:</h4>
					          
					          <?php 
						          // Get project's skills
								  $dbRow_ProjectSkills = $objProject->getProjectSkills($dbRow['project_id']);

								  // Print skills		
								   printSkills($dbRow_ProjectSkills, 10, $userid, $displayname);
					          ?>
					          
					          <!--
					          <ul class="nav nav-pills" role="tablist"> 
						        <li role="presentation"><a href="#">Java <span class="badge">9</span></a></li>
					  <li role="presentation"><a href="#">C#<span class="badge">5</span></a></li>
					  <li role="presentation"><a href="#">AngularJS<span class="badge">2</span></a></li>
					  <li role="presentation"><a href="#">CSS<span class="badge">1</span></a></li>    
					          </ul>
					          -->
					          
				          </div>
				          
			          </div> <!-- End of list item row -->
				     
			        </div> <!-- end of list group item -->
				    
				    <?php } ?>
				            
				              
				</div> 
			</div>
				    
				    

				    
				    
			    </div> <!-- End of project column -->

		     </div> <!-- End of project row -->  
	        
	        
	        
        </div> <!-- End of Left Area -->

        <!-- Right Area -->
        <div class="col-md-3" role="complementary" style="background-color: #ffffff">

		<nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top">
            <div class="bs-example" data-example-id="list-group-custom-content"> 
	            <div class="list-group"> 
		            
		            <div  class="list-group-item active"> 
		            <h4 class="list-group-item-heading">Make an Endorsement</h4> 
		            <p class="list-group-item-text">You have 5 endorsements left for this time period, here's some people you are eligible to endorse:</p> </div> 
		            
		            <div  class="list-group-item"> 
			            <h4 class="list-group-item-heading">Jim Smith</h4> 
			            <p class="list-group-item-text">You worked together on project A, and can endorse him for skill1, skill2, skill3.</p> </div> 
				            
				            <div class="list-group-item"> 
					            <h4 class="list-group-item-heading">Kimberly Jones</h4> 
					            <p class="list-group-item-text">You worked together on project B, and can endorse him for skill1, skill2, skill3.</p> </div> 
					            
					        <div class="list-group-item"> 
					            <h4 class="list-group-item-heading">Sam Burns</h4> 
					            <p class="list-group-item-text">You worked together on project C, and can endorse him for skill1, skill2, skill3.</p> </div> 
					            
				</div> 
			</div>
		</nav>
        </div> <!-- end of right area-->
    </div> <!-- end of row-->
    
    
 

</div> 
<!-- End page content -->

<?php
include_once 'includes/footer.php';
?>