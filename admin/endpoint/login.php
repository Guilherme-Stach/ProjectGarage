<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'constants.php';

$email="";
$password="";
$email=$_POST['email'];
$password=$_POST['password']; 

// signs up the  retail user...
$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>7,'response_message'=>'db I/O error');
  die(json_encode($responseArray));
}else{
  //die('com-ok');
  //echo 'connection successfull<br>';
}


//logging in the user
$loginQuery="";
$loginQuery="select * from admin where email='$email' and password='$password'";
//die($loginQuery);
$result=mysqli_query($con,$loginQuery);
if($result){
	$isAuthenticated=false;
	while($row=mysqli_fetch_array($result)){
	    
    	$_SESSION["email"]=$row['email'];
    	$_SESSION["stoken"]=$authtoken;
    
		$isAuthenticated=true;
	    
	    $_SESSION['timeout'] = time();

	}
}

mysqli_close($con);
if($isAuthenticated==true){
	die("<script>window.location='../pages/index.php';</script>");
       //die("4458");
}else{
	header("Location: ../pages/authenticationerror.php");
	die();
}
?>