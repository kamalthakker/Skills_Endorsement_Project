<?php

// User's header file

$uname = null;
$fname = null;
$lname = null;
$role = null;

session_start();

if(isset($_SESSION['role']) && $_SESSION['role'] == 'user' ){
	$uname= $_SESSION['uname'];
	$fname= $_SESSION['fname'];
	$lname= $_SESSION['lname'];
	$role = $_SESSION['role'];
}


if(!isset($linkno)) $linkno=0;

//echo basename($_SERVER['PHP_SELF']);
// header("Location: index.php?search=".$_GET['search']);

//if(!empty($_GET['search']) && basename($_SERVER['PHP_SELF']) != 'index.php')
//	header("Location: index.php?search=".$_GET['search']);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <link href="includes/styles.css" rel="stylesheet" type="text/css" />
   
	<title><?php echo $page_title?></title>
	
</head>

<body>
<!-- begin #container -->
<div id="container">
	<!-- begin #header -->
    <div id="header">
    	<div class="logo">
    	
    	 <table width="100%">
    	 <tr>
    	 <td>
	    	 <h2>
	    	 MITRE - Skills Endorsement
	    	 </h2>
	    	  
	    	 <!--  <a href="index.php"><img src="../images/logo.png" alt="logo" /></a> -->
	    	 
    	  </td>
    	      	<td style="text-align: right; padding-right: 10px;">
    	      	<div class="headerText3">
            		<?php 
            		if (isset($fname) && isset($lname)){
            			echo "Hello " . ucfirst($fname) . " " . ucfirst($lname) . "! " ;
            			echo '<a href="../logout.php">Logout</a>';
            		}	
            			else
            		echo '<a href="../login.php">Login</a>'		 
            		?>
            	</div>	
            	</td>
          </tr>  	
         </table>   
    	  
    	</div>
    	
    	<div id='cssmenu'>
		<ul>
		   <li <?php if($linkno==1) echo 'class="active"'?>><a href='#'>Home</a></li>
		   <li <?php if($linkno==2) echo 'class="active"'?>><a href='#'>Manage Project</a></li>
		   <li <?php if($linkno==3) echo 'class="active"'?>><a href='#'>Manage Skill</a></li>
		   <li <?php if($linkno==4) echo 'class="active"'?>><a href='#'>Manage Endorsement</a></li>
		   <li <?php if($linkno==5) echo 'class="active"'?>><a href='#'>Approvals</a></li>
		   
		   <li <?php if($linkno==6) echo 'class="active"'?>><a href='#'>Edit Profile</a></li>
		</ul>
		</div>
    	      
    </div>
    <!-- end #header -->
    
    
