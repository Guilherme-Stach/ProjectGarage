<?php
require 'constants.php';//
require 'session.init.php';


if(!isset($_POST['booking_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing booking id');
  die(json_encode($responseArray));
}

if(!isset($_POST['mechanic_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing mechanic');
  die(json_encode($responseArray));
}

$booking_id=$_POST['booking_id'];
$mechanic_id=$_POST['mechanic_id'];


$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 29');
die(json_encode($responseArray));
}else{
  //echo 'connection successfull<br>';
}

$booking_id=mysqli_real_escape_string($con,$booking_id);
$mechanic_id=mysqli_real_escape_string($con,$mechanic_id);


$sql = "update bookings set mechanic_id='$mechanic_id',status='2' where booking_id='$booking_id'";
                               
$result=mysqli_query($con,$sql);


if($result){

  $responseArray = array('response_code'=>1,'response_message'=>'Mechanic Assigned successfully');
  die(json_encode($responseArray));     

}else{

  $responseArray = array('response_code'=>0,'response_message'=>'could not complete your request, please try again.');
  die(json_encode($responseArray));     

}

?>