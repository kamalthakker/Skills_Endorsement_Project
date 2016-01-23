<?php
//include_once '../dbconnection.php';

$db_servername = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "Skills_Endorsement";


$dbc = mysqli_connect($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("Not connected..");


$q = "select * from skills";

if(isset($_POST['query'])){

    // Now set the WHERE clause with LIKE query
    $q .= ' WHERE title LIKE "%'.$_POST['query'].'%"';
}

if(isset($_REQUEST['query'])){

    // Now set the WHERE clause with LIKE query
    $q .= ' WHERE  NAME like "%'.$_REQUEST['query'].'%"';
}

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

            $return[] = array('id' => $obj->skill_id, 'name' => $obj->name);
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
$File = 'skillsfile.json' ;

$fh = fopen($File, 'a') or die();
fwrite($fh,$json);
fclose($fh);

echo $json;

?>




