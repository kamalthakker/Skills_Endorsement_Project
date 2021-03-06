<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Project</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Bootstrap core CSS - Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<!-- Custom styles for this template -->
		<link href="user/includes/stylesmain.css" rel="stylesheet">

		<!-- Custom jscript -->
		<script src="user/includes/jqueryscripts.js"></script>


		<script>
		$(function(){
			$('#makeViewEndorsementsModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var recipient = button.data('whatever');
				var modal = $(this);
				modal.find('.modal-title').text('Endorsement - ' + recipient);
				//modal.find('.modal-body input').val(recipient);
				
				// set maximum height
				$('.modal .modal-body').css('overflow-y', 'auto'); 
			$('.modal .modal-body').css('max-height', $(window).height() * 0.7);
			});
		});
		</script>

	</head>


<body>

<!-- http://bradhussey.ca/course/bootstrap/ -->
<!-- https://www.youtube.com/watch?v=JzCmx24xDS4&list=PLUoqTnNH-2Xz_BUrjcahKWDhPcUj-FTOt&index=2 -->

<!-- Header -->
 <nav  class="navbar navbar-default navbar-fixed-top"> <!--navbar navbar-default navbar-fixed-top-->
        <div class="container-fluid">

            <!-- Logo -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">MITRE Skills Endorsement</a>
            </div>

            <!-- Menu Items -->
            <div  id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav ">
                    <li class="active">
                        <a href="#"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>

                    <!-- drop down menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span> My Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
	                        <li><a href="#">Edit Profile</a></li>
	                        <li class="divider"></li>
                            <li><a href="#">Manage Projects</a></li>
                            <li><a href="#">Manage Skills</a></li>
							<li><a href="#">Manage Endorsements</a></li>
							<li class="divider"></li>
							<li><a href="#">Approvals</a></li>
                        </ul>
                    </li>
                </ul>

                <!--Search Form-->
                <form class="navbar-form pull-left">
					<input type="text" class="form-control" placeholder="Search people..." id="searchInput">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				</form>

                <!--Logout - right align -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-off"></span> Logout</a>
                    </li>
                </ul>

            </div> <!-- end of logical div menu  -->
        </div> <!-- end of container-fluid -->

    </nav> <!-- end of menu -->
<!-- End of Header -->

<!-- http://tutsme-webdesign.info/bootstrap-3-1-and-modals-with-remote-content/ -->
<!-- http://stackoverflow.com/questions/29831077/call-a-php-function-on-a-bootstrap-modal-using-ajax -->
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
		  <li class="active"><a data-toggle="tab" href="#makeEndorsement">Make an endorsement</a></li>
		  <li><a data-toggle="tab" href="#viewEndorsement">View endorsements</a></li>
		</ul>

<div class="tab-content">
  
  <div id="makeEndorsement" class="tab-pane fade in active">
    <h3>Make an endorsement</h3>
    <p>TBD <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> </p>
  </div>
  
  <div id="viewEndorsement" class="tab-pane fade">
    <h3>View endorsements</h3>
    <p>List of all endorsements ... TBD
	    <br/>
	    
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>blah<br/>
	    
    </p>
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
				<img src="images/default-user.png" class="img-responsive" alt="Cinque Terre" width="200" height="200">
				</div>

				<!-- Detail - like name, title, etc. -->
				<div class="col-md-4" style="background-color: #ffffff">
					<h2 class="text-capitalize">Mike Bush</h2>


					<addres>
						Group leader <br/>
						<strong><abbr title="Phone">P:</abbr> 410-272-5848</strong><br/>
						<a href="mailto:#">mbush@mitre.org</a> <br/>
						03-441 | Aberdeen, MD <br/>
						Speciality: Software Engineering <br/>
						2nd Speciality: Software Apps Development
					</addres>


				</div>

				<!-- Skills-->
				<div class="col-md-6" style="background-color: #ffffff">

					<h2 class="text-capitalize">Skills</h2>

					<ul class="nav nav-pills" role="tablist">

						<!--
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">SQL</a><a href="#"><span class="badge">12</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Java</a><a href="#"><span class="badge">12</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">C#</a><a href="#"><span class="badge">10</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">AngularJS</a><a href="#"><span class="badge">8</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">CSS</a><a href="#"><span class="badge">8</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Project Management</a><a href="#"><span class="badge">7</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">HTML</a><a href="#"><span class="badge">5</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Hadoop</a><a href="#"><span class="badge">4</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Web Services</a><a href="#"><span class="badge">3</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">JQuery</a><a href="#"><span class="badge">1</span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Rest</a><a href="#"><span class="badge"></span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">XML</a><a href="#"><span class="badge"></span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Software Design</a><a href="#"><span class="badge"></span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">PHP</a><a href="#"><span class="badge"></span></a></div></li>
                    <li role="presentation"><div class="text-center" role="group" ><a href="#">Message Broker</a><a href="#"><span class="badge"></span></a></div></li>
                    -->


						<!-- button style -->
						<!--
					  <li role="presentation"><button type="button" data-toggle="modal" data-target="#makeViewEndorsementsModal" data-whatever="SQL">SQL<span class="badge">12</span></button></li>
					  -->

						<li role="presentation"><a href="#" data-toggle="modal" data-target="#makeViewEndorsementsModal" data-whatever="SQL">SQL<span class="badge">12</span></a></li>
						<li role="presentation"><a href="#" data-toggle="modal" data-target="#makeViewEndorsementsModal" data-whatever="Java">Java<span class="badge">9</span></a></li>
						<li role="presentation"><a href="#">C#<span class="badge">5</span></a></li>
						<li role="presentation"><a href="#">AngularJS<span class="badge">2</span></a></li>
						<li role="presentation"><a href="#">CSS<span class="badge">1</span></a></li>
						<li role="presentation"><a href="#">Project Management<span class="badge">1</span></a></li>
						<li role="presentation"><a href="#">HTML<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">Hadoop<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">Web Services<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">JQuery<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">Rest<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">SOAP<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">XML<span class="badge"></span></a></li>
						<li role="presentation"><a href="#">Software Design<span class="badge"></span></a></li>

					</ul>

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
								
									<?php
										$dbc = @mysqli_connect('localhost', 'root', '', 'test') 
												or die ("cannot connect to DB".mysqli_connect_error());
												
										$q = "SELECT project_id, user_id, project_name, project_desc, start_date, end_date, 
											  manager_user_id, approved FROM projects";
										$r = mysqli_query($dbc, $q);
										while($row = mysqli_fetch_array($r)){
											echo('<div class="list-group-item">');
											echo('<div class="row">');
											echo('<div class="col-md-3" style="background-color: #ffffff"> ');
											echo('<h4 class="list-group-item-heading">'.$row['project_name'].'</h4>');
											echo('<p class="list-group-item-text">'.$row['start_date'].'-'.$row['end_date'].'</p>');
											echo('<p class="list-group-item-text"> Manager'.$row['manager_user_id'].'</p>');
											echo('<p class="list-group-item-text"><a href="/editProject.php">Edit</a>&nbsp&nbsp');
											echo('<a href="/deleteProject.php">Delete</a></p>');
											echo('</div>');
											echo('<div class="col-md-5" style="background-color: #ffffff">');
											echo('<h4 class="list-group-item-heading">Project Description:</h4>');
											echo('<p class="list-group-item-text">');
											echo('<span class="more">'.$row['project_desc'].'</span>');
											echo('</p>');
											echo('</h4>');
											echo('</div>');
											echo('<div class="col-md-4" style="background-color: #ffffff">');
											echo('<ul class="nav nav-pills" role="tablist">');
											echo('<li role="presentation"><a href="#">Java <span class="badge">9</span></a></li>');
											echo('<li role="presentation"><a href="#">C#<span class="badge">5</span></a></li>');
											echo('<li role="presentation"><a href="#">AngularJS<span class="badge">2</span></a></li>');
											echo('<li role="presentation"><a href="#">CSS<span class="badge">1</span></a></li> ');	
											echo('</ul>');
											echo('</div>');
											//echo('<td><a href="/add_class.php">Edit</a></td>');
											//echo('<td><a>Delete</a></td>');
											echo('</div>');
											echo('</div>');
										}										
									?>
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
    
    
 

</div> <!-- end of containter -->






<!-- footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h6>Copyright © 2015 MITRE / Monmouth University</h6>
            </div><!-- end col-sm-2 -->

            <div class="col-sm-4">
                <h6>About Us</h6>
                <p>MITRE - Skills Endorsement</p>
            </div><!-- end col-sm-4 -->

            <div class="col-sm-4">
                <h6>Navigation</h6>
                <ul class="unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div><!-- end col-sm-2 -->
        </div><!-- end row -->
    </div><!-- end container -->
</footer>

</body>
</html>
