<?php
$page_title = "Manage Project";
$linkno = 0;
include_once 'includes/header.php';
include_once 'classes/user.php';
include_once 'classes/project.php';
?>

<?php
// Create an object for users to get manager's list
$objUser = new user();

// Get manager's list
$dbRow_Managers = $objUser->getManagers($userid);

// Create an object for projects
$objProject = new project();
	
/*Add or Edit*/
$project_id=0;
if(isset($_REQUEST['project_id'])) $project_id=$_REQUEST['project_id'];

$outputMessage=null;

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['key'] == $_SESSION['key'] )
{
	/*
	echo '<br/><br/><br/><br/>Posted';
	
	echo '<br/>ProjectName:'. $_POST['projectName'] ;
	echo '<br/>ProjectDesc:'. $_POST['projectDesc'] ;
	
	foreach($_POST['addskills_select2'] as $skillid) {echo '<br/>'. $skillid;}
	
	//echo '<br/>Skills:'. $_POST['addskills_select2'][0] ;
	echo '<br/>Start Date:'. $_POST['startDate'];
	echo '<br/>End Date:'. $_POST['endDate'];
	echo '<br/>Manager_Id:'. $_POST['manager_select2'];
	*/
	
	//echo '<br/><br/><br/><br/><br/><br/>';
	
	$user_id=$userid; 
	$project_name=$_POST['projectName'];
	$project_desc=$_POST['projectDesc']; 
	$skills=$_POST['addskills_select2'];
	$start_date=$_POST['startDate']; 
	if (isset($_POST['endDate']) && $_POST['endDate'] <> '0000-00-00' ) $end_date=$_POST['endDate'];  else $end_date=null;
	$manager_user_id=$_POST['manager_select2'];

	$result=$objProject->addProject($user_id, $project_name, $project_desc, $start_date, $end_date, $manager_user_id, $skills);
	
	//echo '<br/><br/><br/><br/><br/><br/>Result:'. $result;
	if($result==true){
		//echo '<br/><br/><br/><br/><br/><br/>Success';
		$outputMessage='
		<div style="text-align:center">
		<div class="alert alert-success alert-dismissible" role="alert" style="width:100%;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Project is added successfully.
</div></div>';
	}
		
	else{
		//echo '<br/><br/><br/><br/><br/><br/>Failure';
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

// When page is refreshed, this will avoid multiple post
$_SESSION['key'] = mt_rand(1, 1000);


?>

<!-- Typehead -->
<script src="includes/typeahead.bundle.js"></script>
<!-- End of Typehead ref. -->

 <!-- Select 2 -->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<link rel="stylesheet" href="includes/select2-bootstrap.min.css">
<link rel="stylesheet" href="includes/select2-bootstrap.css">
<!-- End of Select 2 ref. -->    

<script type="text/javascript">

function formatRepo (repo) {
    //if (repo.loading) return repo.text;

/*
    var markup = '<div class="clearfix">' +
    '<div class="col-sm-1">' +
    '<img src="' + repo.name + '" style="max-width: 100%" />' +
    '</div>' +
    '<div clas="col-sm-10">' +
    '<div class="clearfix">' +
    '<div class="col-sm-6">' + repo.full_name + '</div>' +
    '<div class="col-sm-3"><i class="fa fa-code-fork"></i> ' + repo.forks_count + '</div>' +
    '<div class="col-sm-2"><i class="fa fa-star"></i> ' + repo.stargazers_count + '</div>' +
    '</div>';
    */
    var markup = '<div class="clearfix">' + repo.text + "</div>";

/*
    if (repo.description) {
      markup += '<div>' + repo.description + '</div>';
    }

    markup += '</div></div>';
*/
    return markup;
  }

  function formatRepoSelection (repo) {
    //return repo.full_name || repo.text;
    return repo.text;
  }


$(document).ready(function(){
/*--------------------------*/

/*Do not delete the commented code - this one also works, but keeping the other method, which is below*/
/*
	$("#addskills_select2").select2({
            theme: "bootstrap",
            placeholder: "Add Skills",
            quietMillis: 100,
            tags: true,
            multiple: true,
            //tokenSeparators: [','],
            minimumInputLength: 2,
            //minimumResultsForSearch: 10,
            ajax: {
                //url: 'http://twitter.github.io/typeahead.js/data/films/post_1960.json',
                url: 'get_skills_json.php',
                delay: 50,
                dataType: "json",
                type: "GET",
                data: function (params) {

                    var queryParameters = {
                        //query: 'a' //params.term
                        query: params.term,
                        page: params.page
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id:  item.id
                            }
                        })
                    };
                }
            },
            //cache: true
            escapeMarkup: function (markup) { return markup; } // let our custom formatter work
            //minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
*/  


	// Select 2 - skills - version # 2	
	 $("#addskills_select2").select2({
      ajax: {
        url: "get_skills_json.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            query: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id:  item.id
                            }
                        })
                    };
                
        },
        cache: true
      },
      theme: "bootstrap",
	  placeholder: "Add Skills",
	  quietMillis: 100,
	  tags: true,
	  multiple: true,
	  tokenSeparators: [','],
	  minimumInputLength: 2,
      escapeMarkup: function (markup) { return markup; }, 
      templateResult: formatRepo, 
      templateSelection: formatRepoSelection 
        
    });
    
    
    // Select 2 - Managers
   
    $("#manager_select2").select2({
		theme: "bootstrap",
	  placeholder: "Select Manager"
	
	}); 
	
    
    
    // Typehead for project names
    var projectNames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: "get_not_entered_projects_json.php?userid='<?php echo $userid;?>'"
        });


        //$('#remote .typeahead').typeahead(null, {
	      $('#projectName').typeahead(null, {  
            name: 'projects',
            display: 'value',
            source: projectNames
        });
        
        
        
		
  
/*--------------------------*/
});

 </script>

    <!-- Begin page content -->
    <div class="container-fluid">

        <!-- page header -->
        <div class = "page-header">
            <h2><?php if($project_id==0) echo "Add "; else "Edit "; ?> Project</h2>
        </div>

        <!-- use this to show validation errors or success messages -->
        <!--
        <div class="alert alert-success" role="alert">success</div>
        <div class="alert alert-info" role="alert">info</div>
        <div class="alert alert-warning" role="alert">warning</div>
        <div class="alert alert-danger" role="alert">danger</div>
        -->
        
        <?php echo $outputMessage; ?>

        <form class="form-horizontal" method="post">

            <!-- Project Name -->
            <div class="form-group">
                <label for="projectName" class="col-sm-2 control-label">Project Name</label>
                <div class="col-sm-10">
	                <div id="remote">
                    <input type="text" class="typeahead form-control" id="projectName" name="projectName" placeholder="Project Name" autofocus="true" required="true" maxlength="50">
	                </div>    
                </div>
            </div>

            <!-- Project Desc -->
            <div class="form-group">
                <label for="projectDesc" class="col-sm-2 control-label">Project Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="projectDesc" name="projectDesc" placeholder="Project Description" required="true" maxlength="5000"></textarea>
                </div>
            </div>

            <!-- Skills Used -->
            <div class="form-group">
                <label for="skillsUsed" class="col-sm-2 control-label">
                	Skills Used</label>
                	
                <div class="col-sm-10">
                   
				<select id="addskills_select2" name="addskills_select2[]" class="js-example-basic-multiple form-control" multiple="multiple" required="true" style="width: 100%">
					
				</select>
                    
                </div>
                <br/>
            </div>

            <!-- Start Date -->
            <div class="form-group">
                <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start date" required="true">
                </div>
            </div>

            <!-- End Date -->
            <div class="form-group">
                <label for="endDate" class="col-sm-2 control-label">End Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="endDate"  name="endDate" placeholder="End date">
                </div>
            </div>

            <!-- Manager -->
            <div class="form-group">
                <label for="manager" class="col-sm-2 control-label">Manager</label>
                <div class="col-sm-3">
                    <select id="manager_select2" name="manager_select2" class="js-example-placeholder-single" required="true" placeholder="Select manager" style="width: 100%">

<option value="-1" selected disabled>Select Manager</option>

		<?php while ( isset($dbRow_Managers) && $dbRow = mysqli_fetch_array($dbRow_Managers))
		{ ?>

					<option value="<?php echo $dbRow['user_id'];?>"><?php echo $dbRow['fname']. ' ' . $dbRow['lname'];?></option>
						
		<?php } ?>		
						
						
					
				</select>
				
				
                </div>
                <br/><br/>

               
            </div>

            <!-- Submit -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	                <input type="hidden" name="key" value="<?php echo $_SESSION['key']; ?>" />
                    <button type="submit" name="submit"  class="btn btn-primary">
                    	<?php if($project_id==0) echo "Add"; else "Update"; ?>
                    </button>
                </div>
            </div>
        </form>







    </div>
    <!-- End page content -->

<?php
include_once 'includes/footer.php';
?>