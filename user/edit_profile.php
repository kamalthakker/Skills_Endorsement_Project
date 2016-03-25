<?php
$page_title = "Edit Profile";
$linkno = 3;
include_once 'includes/header.php';
include_once 'classes/user.php';
?>


<?php
// Create a user object
$objUser = new user();



if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['key'] == $_SESSION['key'] )
{
	
	$fname=$_POST['firstName'];
	$lname=$_POST['lastName'];
	$phone=$_POST['phoneNo'];
	$job_title=$_POST['jobTitle'];
	$speciality=$_POST['speciality'];
	$speciality2=$_POST['speciality2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	
	/*
	echo '<br/><br/><br/><br/><br/><br/><br/>';
	echo '--->' . $fname . '<br/>';
	echo '--->' . $lname . '<br/>';
	echo '--->' . $phone . '<br/>';
	echo '--->' . $job_title . '<br/>';
	echo '--->' . $speciality . '<br/>';
	echo '--->' . $speciality2 . '<br/>';
	echo '--->' . $city . '<br/>';
	echo '--->' . $state . '<br/>';
	echo '--->' . $zip . '<br/>';
	*/
	
	$result = $objUser->updateUser($userid, $fname, $lname, $phone, $job_title, $speciality, $speciality2, $city, $state, $zip);
	
	if($result==true){
		$outputMessage='
		<div style="text-align:center">
		<div class="alert alert-success alert-dismissible" role="alert" style="width:100%;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Profile is updated successfully.
</div></div>';
	}
	else {
		$outputMessage='
		<div style="text-align:center">
		<div class="alert alert-danger alert-dismissible" role="alert" style="width:100%;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Oh snap!</strong> Something went wrong!
</div></div>';
	}	
}
else 
{
	//echo '<br/><br/><br/><br/><br/>Page is refreshed. No need to post.';
	$outputMessage=null;
}


$dbRowsUser = $objUser->getUserInfo($userid);

// When page is refreshed, this will avoid multiple post
$_SESSION['key'] = mt_rand(1, 1000);

?>


<!-- Begin page content -->
<div class="container-fluid">
	
	<!-- page header -->
    <div class = "page-header">
        <h2>Edit Profile</h2>
    </div>


	<?php echo $outputMessage; ?>

	<form class="form-horizontal" method="post">
		
		<!-- User Name -->
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">User Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name" disabled="disabled"  value="<?php echo $dbRowsUser['uname']; ?>">
                </div>
            </div>
		
		
		<!-- First Name -->
            <div class="form-group">
                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" autofocus="true" required="true" maxlength="25" value="<?php echo $dbRowsUser['fname']; ?>">   
                </div>
            </div>
            
        <!-- Last Name -->
            <div class="form-group">
                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required="true" maxlength="25" value="<?php echo $dbRowsUser['lname']; ?>">   
                </div>
            </div> 
            
        <!-- Phone Name -->
            <div class="form-group">
                <label for="phoneNo" class="col-sm-2 control-label">Phone No</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="Phone No" required="true" maxlength="15" value="<?php echo $dbRowsUser['phone']; ?>">   
                </div>
            </div>
            
        <!-- Job Title -->
            <div class="form-group">
                <label for="jobTitle" class="col-sm-2 control-label">Job Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Job Title" required="true" maxlength="25" value="<?php echo $dbRowsUser['job_title']; ?>">   
                </div>
            </div>     
        
        <!-- Speciality -->
            <div class="form-group">
                <label for="speciality" class="col-sm-2 control-label">Speciality</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Speciality" required="true" maxlength="25" value="<?php echo $dbRowsUser['speciality']; ?>">   
                </div>
            </div> 
        
        <!-- Speciality2 -->
            <div class="form-group">
                <label for="speciality2" class="col-sm-2 control-label">Speciality2</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="speciality2" name="speciality2" placeholder="Speciality2" required="true" maxlength="25" value="<?php echo $dbRowsUser['speciality2']; ?>">   
                </div>
            </div>         
            
        <!-- Address -->
        <!--
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required="true" maxlength="25" value="<?php echo $dbRowsUser['address']; ?>">   
                </div>
            </div> 
        -->
            
        <!-- City -->
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required="true" maxlength="50" value="<?php echo $dbRowsUser['city']; ?>">   
                </div>
            </div>                
		
		<!-- State -->
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="state" name="state" placeholder="State" required="true" maxlength="2" value="<?php echo $dbRowsUser['state']; ?>">   
                </div>
            </div> 
         
         <!-- Zip -->
            <div class="form-group">
                <label for="zip" class="col-sm-2 control-label">Zip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" required="true" maxlength="10" value="<?php echo $dbRowsUser['zip']; ?>">   
                </div>
            </div>
            
        <!-- Submit -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	                <input type="hidden" name="key" value="<?php echo $_SESSION['key']; ?>" />
                    <button type="submit" name="submit"  class="btn btn-primary">
                    	Update
                    </button>
                </div>
            </div>
       
             
		
	</form>
	
</div>
<!-- End page content -->

<?php
include_once 'includes/footer.php';
?>