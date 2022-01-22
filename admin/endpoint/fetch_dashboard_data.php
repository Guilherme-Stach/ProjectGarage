<?php

require 'constants.php';//
//require 'session.init.php';



if(isset($_POST["mode"])){
}else{
  $responseArray = array('response_code'=>0,'response_message'=>'unauthorized access');
  die(json_encode($responseArray)); 
}

$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);

if (mysqli_connect_errno()){

  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 101');

  die(json_encode($responseArray));

}else{
  //echo 'connection successfull<br>';
}


//total vendors
$selectQuery ="select count(*) as total_users from users";                                   
$result=mysqli_query($con,$selectQuery);
     
if(!$result){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 31');
  die(json_encode($responseArray));     
}

$row=mysqli_fetch_array($result);
$total_users = $row['total_users'];


//total products
$selectQuery ="select count(*) as total_bookings from bookings";            
$result=mysqli_query($con,$selectQuery);
     
if(!$result){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 45');
  die(json_encode($responseArray));     
}

$row=mysqli_fetch_array($result);
$total_bookings = $row['total_bookings'];


$responseArray = array('response_code'=>1,'response_message'=>'ok',
  'total_users'=>$total_users,
  'total_bookings'=>$total_bookings
);

die(json_encode($responseArray));



?>