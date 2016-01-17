<?php

include_once '../dbconnection.php';

class search{
	
	
public function getSearchResults($search_keyword){
$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");
	
		$search_keyword = trim($search_keyword);
	
		$q = "/*Search results*/
				select distinct user_id, fname, lname, job_title, speciality, speciality2, userdp 
				from users
				where fname like '%".$search_keyword."%'
				
				
				union 
				
				select distinct u.user_id, fname, lname, job_title, speciality, speciality2, userdp 
				from project_skills ps 
					inner join projects p on p.project_id=ps.project_id
					inner join skills s on s.skill_id=ps.skill_id
					inner join users u on u.user_id=p.user_id
				 	where upper(p.approved)='Y' and (s.name like '%".$search_keyword."%' or p.project_name like '%".$search_keyword."%')
				order by fname";
	
		//echo $q;
		
		$r = mysqli_query($dbc,$q);
		mysqli_close($dbc); // close the connection
	
		if (isset($r) && mysqli_num_rows($r) >= 1)
		{
			//found in DB
			//$row = mysqli_fetch_array($r);
			return 	$r; // send collection
		}
		else
		{
			// not found in DB
			return null;
		}	
	
} // End of getEndorsements
}