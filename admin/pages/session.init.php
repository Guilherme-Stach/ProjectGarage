<?php
require '../endpoint/constants.php';// 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if(!isset($_SESSION["stoken"])){
	header("Location: ../index.php");
	die;
}else{

	if($_SESSION["stoken"]!=$authtoken){
		header("Location: ../index.php");
	die;
	}
}

if($_SESSION['timeout'] + 30 * 60 < time()) {
    // session timed out
  	header("Location: ../index.php");
	die;
}else {
    // session ok
  	$_SESSION['timeout'] = time();
}

?>