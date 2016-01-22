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
            <h2>Manage Projects</h2>
        </div>

        <div class="pull-right">
            <a  role="button" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Add Project</span>
            </a>
        </div>



        <br/><br/><br/>

        <!-- Projects Table -->
        <div class="table-responsive">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="display: none;">Project Id</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Manager</th>
                        <th>Approved</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td  style="display: none;">1</td>
                        <td>Android - PC Chatting & Image Sharing System</td>
                        <td>Oct 15</td>
                        <td>Present</td>
                        <td>Kamal Thakker</td>
                        <td>Yes</td>

                        <!-- Edit Button -->
                        <td>
                            <a role="button" class="btn btn-default" aria-label="Left Align">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <a role="button" class="btn btn-default" aria-label="Left Align">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td  style="display: none;">2</td>
                        <td>Railway Tracking and Arrival Time Prediction</td>
                        <td>Feb 13</td>
                        <td>Sep 15</td>
                        <td>Mike Bush</td>
                        <td>Yes</td>

                        <!-- Edit Button -->
                        <td>
                            <a role="button" class="btn btn-default" aria-label="Left Align">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <a role="button" class="btn btn-default" aria-label="Left Align">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
    <!-- End page content -->

<?php
include_once 'includes/footer.php';
?>