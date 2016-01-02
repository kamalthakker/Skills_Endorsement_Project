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
<div id="container11">
	<!-- begin #header -->
    <div id="header11">
    	<div class="logo">
    	
    	 <table width="100%">
    	 <tr>
    	 <td>
	    	 <h2>
	    	 MITRE - Skills Endorsement
	    	 </h2>
	    	  
	    	 <!--  <a href="index.php"><img src="../images/logo.png" alt="logo" /></a> -->
	    	 
    	  </td>
    	      	<td style="text-align: right; padding-right: 30px;">
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
    	
    	 
    	
        <div class="cssmenu">
            
                <ul>
                     
                    <li <?php if($linkno==1) echo 'id="active"'?>><a href="index.php">Home</a></li>
                    
                    <?php if(isset($uname) && isset($role) && $role == 'user') { ?>
                    	<li <?php if($linkno==2) echo 'id="active"'?>><a href="my_account.php">My Account</a></li>
                    <?php } else { ?>
                    	<li <?php if($linkno==2) echo 'id="active"'?>><a href="register.php">Create an Account</a></li>
                    <?php }?>
                    
                    <li <?php if($linkno==3) echo 'id="active"'?>><a href="cart.php">
                    
                    My Cart <?php //if($total_cart_item>0) echo ' (' . $total_cart_item. ')'?>
                    
                    </a></li>
                    <!-- 
                    	<li><a href="">About Us</a></li>
                    	<li><a href="">Contact Us</a></li>
                     -->
                </ul>
            
            
       
            
            <form>
            
               <input type="text" name="search"  class="search" placeholder="Search entire store..." required />
               
          
			</form>
            
           
            
        </div>
                
    </div>
    <!-- end #header -->
    
    
    <div id='cssmenu'>
<ul>
   <li class='active'><a href='#'>Home</a></li>
   <li><a href='#'>Products1111111111</a></li>
   <li><a href='#'>Company</a></li>
   <li><a href='#'>Contact</a></li>
</ul>
</div>