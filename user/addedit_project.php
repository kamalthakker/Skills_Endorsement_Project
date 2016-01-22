<?php

// to be deleted - after setting up db connection...

//session_start();

// set session var
$_SESSION['userid']= 1;
$_SESSION['uname']= 'mbush@mitre.org';
$_SESSION['fname']= 'mike';
$_SESSION['lname']= 'bush';
$_SESSION['role']= 'user';
?>


<?php
$page_title = "Home";
$linkno = 1;
include_once 'includes/header.php';
//include_once 'classes/user.php';
?>

    <!-- Begin page content -->
    <div class="container-fluid">

        <!-- page header -->
        <div class = "page-header">
            <h2>Add/Edit Project</h2>
        </div>

        <!-- use this to show validation errors or success messages -->
        <div class="alert alert-success" role="alert">success</div>
        <div class="alert alert-info" role="alert">info</div>
        <div class="alert alert-warning" role="alert">warning</div>
        <div class="alert alert-danger" role="alert">danger</div>

        <form class="form-horizontal">

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
                <label for="skillsUsed" class="col-sm-2 control-label">Skills Used</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="skillsUsed" placeholder="Skills">
                </div>
                <br/>

                <!-- to be deleted -->
                <div style="color: brown">
                    <strong>&nbsp; *HL: this should be a drop down box for all the skills in the DB, table:skills + user can add new skill which is not in the table. It should allow to add multiple tags as we show in the class last time.</strong>
                </div>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>







    </div>
    <!-- End page content -->

<?php
include_once 'includes/footer.php';
?>