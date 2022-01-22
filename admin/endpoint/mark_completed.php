<?php
require 'constants.php';//
require 'session.init.php';



$booking_id="";
if(!isset($_POST['booking_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing booking id');
  die(json_encode($responseArray));
}

$booking_id=$_POST["booking_id"];


if(!isset($_POST['type_cost'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing cost');
  die(json_encode($responseArray));
}
$type_cost=$_POST["type_cost"];


$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 24');
  die(json_encode($responseArray));
}else{
  //echo 'connection successfull<br>';
}

mysqli_set_charset($con,"utf8mb4");
$created_date = date("Y-m-d H:i:s");
  
$sql = "select ROUND(sum(cost),2) as part_cost from parts where booking_id='$booking_id'";
$result= mysqli_query($con,$sql);
if(!$result){
  mysqli_close($con);
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 37');
  die(json_encode($responseArray));
}

$row=mysqli_fetch_array($result);

$total_cost = $row['part_cost'] + floatval($type_cost);

$sql = "update bookings set cost='$total_cost',status='3' where booking_id='$booking_id'";
$result= mysqli_query($con,$sql);
if(!$result){
  mysqli_close($con);
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 37');
  die(json_encode($responseArray));
}

mysqli_close($con);  
$responseArray = array('response_code'=>1, 'response_message'=>'Booking Marked as Completed');
die(json_encode($responseArray));


?>