<?php
require 'constants.php';//
require 'session.init.php';



$booking_id="";
if(!isset($_POST['booking_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing booking id');
  die(json_encode($responseArray));
}

$part_id="";
if(!isset($_POST['part_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing part');
  die(json_encode($responseArray));
}

$booking_id=$_POST["booking_id"];
$part_id=$_POST["part_id"];

$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 24');
  die(json_encode($responseArray));
}else{
  //echo 'connection successfull<br>';
}

mysqli_set_charset($con,"utf8mb4");
$created_date = date("Y-m-d H:i:s");
  
$deleteQuery = "delete from parts where booking_id= '$booking_id' and part_id='$part_id'";
$result= mysqli_query($con,$deleteQuery);
if(!$result){
  mysqli_close($con);
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 37');
  die(json_encode($responseArray));
}

mysqli_close($con);  
$responseArray = array('response_code'=>1, 'response_message'=>'Deleted successfully');
die(json_encode($responseArray));


?>