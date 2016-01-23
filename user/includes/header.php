<?php

// User's header file
$userid = null;
$uname = null;
$fname = null;
$lname = null;
$role = null;

session_start();

if(isset($_SESSION['role']) && $_SESSION['role'] == 'user' ){
	$userid= $_SESSION['userid'];
	$uname= $_SESSION['uname'];
	$fname= $_SESSION['fname'];
	$lname= $_SESSION['lname'];
	$role = $_SESSION['role'];
}
else
{
	header("Location: ../login.php");
}

if(!isset($linkno)) $linkno=0;

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title?></title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap core CSS - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="includes/stylesmain.css" rel="stylesheet">
    <link href="includes/callout.css" rel="stylesheet">

	<!-- Custom common jscript -->
	<script src="includes/jqueryscripts.js"></script>
	
	<!-- http://www.iconarchive.com/show/beautiful-flat-icons-by-elegantthemes.1.html -->
	<link rel="shortcut icon" href="../images/website.ico">
	
</head>


<body>

<!-- Header -->
<nav  class="navbar navbar-default navbar-fixed-top">         
	
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
                    <li <?php if($linkno==1) echo 'class="active"'?>>
                        <a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>

                    <!-- drop down menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span> My Profile <span class="caret"></span></a>
                        <ul class="dropdown-menu">
	                        <li><a href="#">Edit Profile</a></li>
	                        <li class="divider"></li>
                            <li><a href="manage_projects.php">Manage Projects</a></li>
                            <li><a href="#">Manage Skills</a></li>
					<!--	<li><a href="#">Manage Endorsements</a></li> -->
							<li class="divider"></li>
							<li><a href="#">Approvals</a></li>
                        </ul>
                    </li>
                </ul>

                <!--Search Form-->
                <form class="navbar-form pull-left" role="search" method="post" action="searchresult.php">
	               
		                
					<input type="text" class="form-control" placeholder="Search people, skills, or projects..." id="searchInput" name="searchby">
					
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
	                
				</form>
				
				
				

                <!--Logout - right align -->
                <ul class="nav navbar-nav navbar-right">
	                
                    <li>
                        <a href="../logout.php"><span class="glyphicon glyphicon-off"></span> Hello 
	                        <span class="text-capitalize"><strong><?php echo $fname;?></strong></span> - Logout?</a>
                    </li>
                </ul>

            </div> <!-- end of logical div menu  -->
        </div> <!-- end of container-fluid -->

    </nav> <!-- end of menu -->
<!-- End of Header -->



    
    
