<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if(!isset($_SESSION["stoken"])){
	$responseArray = array('response_code'=>2,'response_message'=>'Session expired, please logout and login again');
  	die(json_encode($responseArray));
}else{

	if($_SESSION["stoken"]!=$authtoken){
		$responseArray = array('response_code'=>2,'response_message'=>'Session expired, please logout and login again');
	  	die(json_encode($responseArray));
	}
}

if($_SESSION['timeout'] + 30 * 60 < time()) {
    // session timed out
  	$responseArray = array('response_code'=>2,'response_message'=>'Session expired, please logout and login again');
  	die(json_encode($responseArray));
}else {
    // session ok
  	//$responseArray = array('response_code'=>0,'response_message'=>'ok'.time().' -- '.$_SESSION['timeout']);
  	$_SESSION['timeout'] = time();
  	//die(json_encode($responseArray));
}

?>