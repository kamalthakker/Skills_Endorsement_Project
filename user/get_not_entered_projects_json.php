<?php
include_once '../dbconnection.php';

$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");



$q = "/*List of projects yet not entered by the user*/
				SELECT distinct project_name FROM projects 
				WHERE project_name not in (
				select distinct project_name from projects where user_id=".$_REQUEST['userid'].")";


//echo $q;



//$r = mysqli_query($dbc,$q);
//mysqli_close($dbc); // close the connection


    // User is found in DB
    //$row = mysqli_fetch_array($r);
    //return 	$row;

    $return = array();

    //if($result = $mysqli->query($q)){
    if($result = mysqli_query($dbc,$q) ){

        // fetch object array
        while($obj = $result->fetch_object()) {
            //$return[] = $obj->name;
            //echo $obj->name;

            $return[] = array('name' => $obj->project_name, 'value' => $obj->project_name);
        }
        // free result set
        $result->close();
    }


// close connection
mysqli_close($dbc);

//$json = json_encode($return);

//echo json_encode($return);

//echo $return;

//print_r($json);
//print($json);
//echo $json;

//echo json_encode($return, JSON_PRETTY_PRINT);


$json = json_encode($return);
$File = 'projectssfile.json' ;

$fh = fopen($File, 'a') or die();
fwrite($fh,$json);
fclose($fh);

echo $json;

?>




