<?php
$page_title = "Manage Project";
$linkno = 0;
include_once 'includes/header.php';
//include_once 'classes/user.php';
?>

<?php
/*Add or Edit*/
$project_id=0;
if(isset($_REQUEST['project_id'])) $project_id=$_REQUEST['project_id'];

if($_SERVER['REQUEST_METHOD'] == 'GET' )
{
	echo '<br/><br/><br/><br/>posted';
	echo '<br/>'. $_POST['addskills_select2'][0] ;
	echo '<br/>'. $_POST['addskills_select2'][1] ;
}

?>

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

        <form class="form-horizontal" method="get">

            <!-- Project Name -->
            <div class="form-group">
                <label for="projectName" class="col-sm-2 control-label">Project Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="projectName" placeholder="Project Name">
                </div>
                <br/>

                <!-- to be deleted -->
                <div style="color: brown">
                    <strong>&nbsp; *HL: this should be a drop down box with all the projects in the DB, except already entered. It should behave something like auto complete.</strong>
                </div>
            </div>

            <!-- Project Desc -->
            <div class="form-group">
                <label for="projectDesc" class="col-sm-2 control-label">Project Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="projectDesc" placeholder="Project Description"></textarea>
                </div>
            </div>

            <!-- Skills Used -->
            <div class="form-group">
                <label for="skillsUsed" class="col-sm-2 control-label">
                	Skills Used</label>
                	
                <div class="col-sm-10">
                    
                    <!--
                    <input type="text" class="form-control" id="skillsUsed" placeholder="Skills"> -->

				<select id="addskills_select2" name="addskills_select2[]" class="js-example-basic-multiple" multiple="multiple" style="width: 100%">
					
				</select>
                    
                </div>
                <br/>
            </div>

            <!-- Start Date -->
            <div class="form-group">
                <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="startDate" placeholder="Start date">
                </div>
            </div>

            <!-- End Date -->
            <div class="form-group">
                <label for="endDate" class="col-sm-2 control-label">End Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="endDate" placeholder="Start date">
                </div>
            </div>

            <!-- Manager -->
            <div class="form-group">
                <label for="manager" class="col-sm-2 control-label">Manager</label>
                <div class="col-sm-3">
                    <select class="form-control" id="manager" placeholder="Manager">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                    </select>
                </div>
                <br/><br/>

                <!-- to be deleted -->
                <div style="color: brown">
                    <strong>&nbsp; *HL: list=select * from users where user_id<>$user_id -- not equal to logged in user id</strong>
                </div>
            </div>

            <!-- Submit -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">
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