<?php

//define an array of error
$error = array();

include_once 'dbconnection.php';

function getUserInfo($uname, $role)
{
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	$q = "select * from users where uname='". $uname ."' and role='". $role ."'";
		
	$r = mysqli_query($dbc,$q);
	mysqli_close($dbc); // close the connection

	if (mysqli_num_rows($r) == 1)
	{
		// User is found in DB
		$row = mysqli_fetch_array($r);
		return 	$row;
	}
	else
	{
		// User is not found in DB
		return null;
	}

} // End of getUserInfo

function isValidPassword($password, $dbpassword)
{
	if($password == $dbpassword) return true; else return false;
}

function updateFailedLoginAttempt($uname,$loginAttempt)
{
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	$q = "update users set login_attempt=$loginAttempt, blocked_time=now() where uname='". $uname ."'";
		
	$r = mysqli_query($dbc,$q);
	mysqli_close($dbc); // close the connection
}

function updateSuccessfulLogin($uname)
{
	$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	$q = "update users set last_login=now(), login_attempt=0, blocked_time=null where uname='". $uname ."'";
		
	$r = mysqli_query($dbc,$q);
	mysqli_close($dbc); // close the connection
}

if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
	// 1st Form
	if(isset($_POST['login'])) {

		// --- Log in form ---
		$uname  = $_POST['uname'];
		$psword = $_POST['psword'];
		//$role =   $_POST['role'];
		$role = "user";

		if( empty($uname))  $error[] = "Please input your username!";
		if( empty($psword)) $error[] = "Please input your password!";
			
		// Get user info
		$dbRow = getUserInfo($uname, $role);

		// Is it a valid user?
		if( empty($error) && empty($dbRow)) $error[] = "Unknown username. Please try again!";

		if(empty($error))
		{
			// When a valid user has entered user name and password
			$loginAttempt = 0;
			//$blocked_time =  new DateTime(); // Default date and time
			$blocked_time =  new DateTime(null, new DateTimeZone('America/New_York')); // Default date and time
			$now = new DateTime(null, new DateTimeZone('America/New_York'));
			$minutes_to_wait = 5;
			$Number_of_attempt_allowed = 3;
			$remaining_minutes = 0;
			
			//$role = $dbRow['role'];
			$fname = $dbRow['fname'];
			$lname = $dbRow['lname'];
			$approved = $dbRow['approved_by_admin'];
				
			if(!empty($dbRow['login_attempt'])) $loginAttempt=$dbRow['login_attempt'];
				
			// If blocked time is found in DB and user has already tried maximum allowed attempt
			// then check to make sure user has waited for 5 minutes before logic is reproceesed
			// if $remaining_minutes = 0 then user is not blocked else user is blocked
			if(!empty($dbRow['blocked_time']) && $loginAttempt >= $Number_of_attempt_allowed){

				// A time at which user had tried the 3rd attempt
				$blocked_time = new DateTime($dbRow['blocked_time'], new DateTimeZone('America/New_York'));
				//echo '$blocked_time---->' . $blocked_time->format("Y-m-d H:i:s") . '<br>';

				// Add wait minutes, example: 5 minutes
				$blocked_time->add(new DateInterval('PT' . $minutes_to_wait . 'M'));
				//echo 'blocked_time---->' . $blocked_time->format("Y-m-d H:i:s") . '<br>';

				// Has user waited for 5 minutes?
				if($blocked_time->format('Y-m-d H:i:s') > $now->format('Y-m-d H:i:s'))
				{
					// yes, user needs to wait
					// How many minutes + seconds need to wait?
					$remaining_minutes = ($now->diff($blocked_time)->i) + (($now->diff($blocked_time)->s)/60);
				}
				else
				{
					// User does NOT need to wait
					// User has waited 5 minutes...
					// User is not blocked
					$remaining_minutes=0;
						
					// Reset log in attempt
					$loginAttempt = 0;
				}
			}
			else
			{
				// User does not need to wait... user can try login
				$remaining_minutes = 0;

			}
				
			if($remaining_minutes > 0)
			{
				$error[] = "You are blocked for login! <br> You need to wait for ". ceil($remaining_minutes) . " minutes.";
			}
			else if(isValidPassword($psword, $dbRow['psword'])) // Validate user
			{
				// Log in was sucessful
				updateSuccessfulLogin($uname);

				// start session varibale
				session_start();
					
				// set session var
				$_SESSION['uname']= $uname;
				$_SESSION['fname']= $fname;
				$_SESSION['lname']= $lname;
				$_SESSION['role']= $role;
				
			
				// redriect to the home page
				//header("Location: home.php");
				if($role == 'admin')
					header("Location: admin/index.php");
				else if ($role == 'user')
					header("Location: user/index.php");
			}
			else if($loginAttempt < $Number_of_attempt_allowed)
			{
				$loginAttempt = $loginAttempt + 1;
				updateFailedLoginAttempt($uname,$loginAttempt);

				if ($loginAttempt >= $Number_of_attempt_allowed)
					$error[] = "You have exceeded the login attempt limit! <br>
					You will be blocked for $minutes_to_wait minutes!";
				else
					$error[] = "Wrong password! You have tried $loginAttempt times";

			}
				
		} // End of if(empty($error))

	} // End of Login form check - if(isset($_POST['login']))

	
} // End of if($_SERVER['REQUEST_METHOD'] == 'POST')


?>

<title>Login Page</title>
<link href="user/includes/styles.css" rel="stylesheet" type="text/css" />

</head>
<body>
<!-- begin #container -->
<div id="container">
	<!-- begin #header -->
    <div id="header">
    	<div class="logo">
    	
    	<h1 style="color:#89bdd3;">Skills Endorsement</h1>
    	</div>
    	 
    	
    	
    	
           
    <!-- end #header -->
    
    <div style = "color: red; padding: 20px">
		<?php foreach($error as $msg) {echo "$msg <br>";} ?>	
	</div>
	
			<table style = "padding: 10px 350px 10px; " >
			<tr>
				<td><h3>Sign In</h3></td>
			</tr>
			</table>
	
	
		<form action = "" method = "POST">
		<center>
			<table style = "padding: 30px 350px 10px; " >
				<tr>
					<td>Email Address:</td>
					<td><input type = "text" name = "uname" value="<?php if(isset($_POST['uname'])) echo  $_POST['uname']; ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type = "password" name = "psword" /></td>
				</tr>
				
				<!--
				<tr>
					
					<td>Role:</td>
					<td>
				    <input checked type = "radio" name = "role" value = "user" />User
				<br><input type = "radio" name = "role" value = "admin" />Administrator
					</td>
				</tr>
				-->
				
			</table>
			
			<input type = "submit" name = "login" value = "Login"  class="buttonBox" />	
		</center>
		</form>

		<p> 
		
		<!--
		<center> <br><br>
			If you don't have an account yet, please <a href="customer/register.php"> click here </a> to register!			
			
			
		</center>
		
		-->
		
		<br><br><br><br>
		
		
		</p>
    
    
    
    <!-- begin #footer -->
    <div id="footer">
	    <center>
		Copyright &copy; Skills Endorsement. Designed by Monmouth University
	    </center>
	</div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
</html>