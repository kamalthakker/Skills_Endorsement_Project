<?php 
	include_once 'classes/project.php'; 
	
	if(isset($_REQUEST['project_id'])) {
		$project_id=$_REQUEST['project_id'];
		$objProject = new project();
		
		$result = $objProject->deleteProject($project_id);
		header( "Location: manage_projects.php" );
		
		}
?>