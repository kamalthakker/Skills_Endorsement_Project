<?php
session_start();

$_SESSION['role'] = null;
$_SESSION['uname'] = null;
$_SESSION['fname'] = null;
$_SESSION['lname'] = null;

header("Location: login.php");
?>