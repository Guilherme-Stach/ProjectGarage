<?php
require 'constants.php';//
require 'session.init.php';


$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>7,'response_message'=>'db I/O error');
  die(json_encode($responseArray));
}else{
  //echo 'connection successfull<br>';
}


$fetchUnitsQuery = "SELECT mechanic_id,name from mechanic";
$result = mysqli_query($con,$fetchUnitsQuery);

$TagStr  = "";
$TagStr  = "<select  class='form-control' id='select-mechanic' selected='1'><option value='-1'>Select Mechanic</option>";

if($result){
    while ($row=mysqli_fetch_array($result)) {
      $TagStr  = $TagStr."<option value=\"".$row['mechanic_id']."\">".$row['name']."</option>";   
    }
   
}else{
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 82');
  die(json_encode($responseArray));
}

$TagStr = $TagStr."</select>";

$responseArray = array('response_code'=>1,'response_message'=>'data fetched ok','data'=>$TagStr);
die(json_encode($responseArray));
?>
