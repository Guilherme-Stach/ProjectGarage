<?php
require 'constants.php';//
require 'session.init.php';


if(!isset($_POST['booking_id'])){
  $responseArray = array('response_code'=>0,'response_message'=>'missing product Id');
  die(json_encode($responseArray));
 }

 $booking_id = $_POST['booking_id'];

$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 8');
  die(json_encode($responseArray));
}else{
  //$formattedData .= 'connection successfull<br>';
}



$sql = "select users.name,users.email,users.phone,
vehicle.type,vehicle.make,vehicle.licence_details,vehicle.engine_type,
	bookings.booking_type,bookings.booking_date,bookings.cost    
	from bookings 
	inner join users on users.user_id = bookings.user_id 
	inner join vehicle on vehicle.vehicle_id = bookings.vehicle_id 
	where bookings.booking_id = '$booking_id' limit 1";

$result= mysqli_query($con,$sql);
if(!$result){
    mysqli_close($con);
    $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 37');
    die(json_encode($responseArray));
}
  
$row=mysqli_fetch_array($result);


$formattedData = '';

$formattedData .= '<div style = "text-align :center; height: auto; width:1000px;">';
$formattedData .= '<div id="parent_div_2">';
$formattedData .= '<table style="width: 500px; text-align:left;">';
$formattedData .= '<tr style="height:30px"><td style="width:100px">CUSTOMER: </td><td>'.$row['name'].'</td></tr>';
$formattedData .= '<tr><td>Email: </td><td>'.$row['email'].'</td></tr>';
$formattedData .= '<tr><td>Phone No: </td><td>'.$row['phone'].'</td></tr>';														
$formattedData .= '<tr><td>&nbsp;</td><td></td></tr>';

$formattedData .= '<tr style="height:30px"><td>Vehicle Type: </td><td>'.$row['type'].'</td></tr>';
$formattedData .= '<tr style="height:30px"><td>Vehicle Make: </td><td>'.$row['make'].'</td></tr>';
$formattedData .= '<tr><td>Licence Details: </td><td>'.$row['licence_details'].'</td></tr>';			
$formattedData .= '<tr style="height:30px"><td>Engine Type: </td><td>'.$row['engine_type'].'</td></tr>';											
$formattedData .= '<tr><td>&nbsp;</td><td></td></tr>';


$total_cost = $row['cost'];

$booking_type = "";
$booking_cost = 0;

//set booking type and cost for each booking type
if ($row['booking_type'] == '1') {
    $booking_type = 'Annual Service';
    $booking_cost = 350;
}else if ($row['booking_type'] == '2') {
    $booking_type = 'Major Service';
    $booking_cost = 550;
}else if ($row['booking_type'] == '3') {
    $booking_type = 'Repair / Fault';
    $booking_cost = 150;
}else if ($row['booking_type'] == '4') {
    $booking_type = 'Major Repair';
    $booking_cost = 250;
}

$formattedData .= '</table><table style="width: 500px; text-align:left;">';
$formattedData .= '<tr style="height:25px"><td style="width:150px">'.$booking_type.' </td><td>€'.$booking_cost.'</td></tr>';


$sql = "select name,cost from parts where booking_id='$booking_id'";

$result= mysqli_query($con,$sql);
if(!$result){
    mysqli_close($con);
    $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 38');
    die(json_encode($responseArray));
}
  
while($row = mysqli_fetch_array($result)) {
    $formattedData .= '<tr style="height:25px"><td>'.$row['name'].' </td><td>€'.$row['cost'].'</td></tr>';
}

$formattedData .= '<tr><td><b>TOTAL DUE </b></td><td><b style="border-top: 2px solid #000;padding-top: 2px;">€'.$total_cost.'</b></td></tr>';

$formattedData .= '</table></div></div>';



$responseArray = array('response_code'=>1, 'response_message'=>'data fetch ok', 'data'=>$formattedData);
die(json_encode($responseArray));

?>