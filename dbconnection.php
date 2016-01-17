<?php

if($_SERVER['SERVER_NAME']=='localhost')
{
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "Skills_Endorsement";
}
else if ($_SERVER['SERVER_NAME']=='skillsendorsement-monmouth.rhcloud.com')
{
	// Openshift Cloud
	$db_servername = "127.8.139.130";
	$db_username = "adminpHqBkNj";
	$db_password = "AcFMEZi_xNEw";
	$db_name = "skillsendorsement";	
}

// Local DB
/*

$db_servername = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "Skills_Endorsement";
 */



// Remote DB
/*
 $db_servername = "localhost";
 $db_username = "s0962803";
 $db_password = "ahn8Thoh";
 $db_name = "s0962803";
*/ 
?>