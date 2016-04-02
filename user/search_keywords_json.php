<?php
include_once '../dbconnection.php';

$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");



$q = "select s.skeyword from (
		select u1.fname as skeyword from users u1
		union all
		select u2.lname as skeyword from users u2
		union all
		select distinct p.project_name as skeyword from projects p
		union all
		select s.name as skeyword from skills s
	) s
		where s.skeyword like '".$_REQUEST['query']."%'";


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

            $return[] = array('name' => $obj->skeyword, 'value' => $obj->skeyword);
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
$File = 'skeywords.json' ;

$fh = fopen($File, 'a') or die();
fwrite($fh,$json);
fclose($fh);

echo $json;

?>




