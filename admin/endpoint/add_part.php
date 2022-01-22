<?php
require 'constants.php';//
require 'session.init.php';


if(!isset($_POST['booking_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing booking id');
  die(json_encode($responseArray));
}

if(!isset($_POST['part_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing part');
  die(json_encode($responseArray));
}

$booking_id=$_POST['booking_id'];
$part=$_POST['part_id'];

$name = explode('@',$part)[0];
$cost = explode('@',$part)[1];


$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 29');
die(json_encode($responseArray));
}else{
  //echo 'connection successfull<br>';
}

$booking_id=mysqli_real_escape_string($con,$booking_id);
$name=mysqli_real_escape_string($con,$name);
$cost=mysqli_real_escape_string($con,$cost);

$created_date = date("Y-m-d H:i:s");
$hash = hexdec(sha1($authtoken.$name.rand(100,10000).$created_date));
$trimmedhash = substr($hash, 0, 8);
$trimmedhash=str_replace('.','',$trimmedhash);


$sql = "insert into parts (part_id, booking_id, name, cost) values ('$trimmedhash', '$booking_id', '$name', '$cost')";
                               
$result=mysqli_query($con,$sql);


if($result){

  $responseArray = array('response_code'=>1,'response_message'=>'Part Assigned successfully');
  die(json_encode($responseArray));     

}else{

  $responseArray = array('response_code'=>0,'response_message'=>'could not complete your request, please try again.');
  die(json_encode($responseArray));     

}

?>