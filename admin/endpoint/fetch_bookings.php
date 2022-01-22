<?php
require 'constants.php';//
require 'session.init.php';


if(!isset($_POST['mode'])){
  $responseArray = array('response_code'=>0,'response_message'=>'Unauthorised access');
  die(json_encode($responseArray));
 }


$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 8');
  die(json_encode($responseArray));
}else{
  //echo 'connection successfull<br>';
}



$fetchDetailsQuery = "select bookings.booking_id,bookings.booking_type,bookings.description,bookings.booking_date,bookings.status,users.name as user_name from bookings
inner join users on bookings.user_id = users.user_id order by timestamp desc";

$result= mysqli_query($con,$fetchDetailsQuery);
mysqli_close($con);

if($result){

    $formattedData='<table class="table table-hover dataTable table-striped w-full dtr-inline" id="exampleTableTools" role="grid">
      <thead>
        <tr role="row">
          <th class="sorting_asc">S.No.</th>
          <th class="sorting">Booking Id</th>
          <th class="sorting">Customer</th>
          <th class="sorting">Booking Type</th>
          <th class="sorting">Booking Date</th>   
          <th class="sorting">Description</th>
          <th class="sorting">Status</th>    
          <th class="sorting">Action</th>                
        </tr>
      </thead>
      <tbody>';
  

  $counter=0;
  while($row=mysqli_fetch_array($result)){

    $counter=$counter+1;

    $booking_type = "";
    if ($row['booking_type'] == '1') {
        $booking_type = "Annual Service";
    } else if ($row['booking_type'] == '2') {
        $booking_type = "Major Service";
    } else if ($row['booking_type'] == '3') {
        $booking_type = "Repair / Fault";
    } else if($row['booking_type'] == '4') {
        $booking_type = "Major Repair";
    }

    $booking_date = date('d-m-Y',strtotime($row['booking_date']));

    $status = "Unrepairable";
    if ($row['status'] == '1') {
        $status = "Booked";
    }else if ($row['status'] == '2') {
        $status = "In Service";
    }else if ($row['status'] == '3') {
        $status = "Completed";
    }

    $detailsPacket = '<button class="btn btn-md btn-info btn-sm mt-2" onclick="window.location=\'booking-details.php?booking_id='.$row['booking_id'].'\'">Details</button>';

    $formattedData=$formattedData
      .'<tr>
        <td>'.$counter.'</td>
        <td>'.$row['booking_id'].'</td>
        <td>'.$row['user_name'].'</td>
        <td>'.$booking_type.'</td>
        <td>'.$booking_date.'</td>
        <td>'.$row['description'].'</td>
        <td>'.$status.'</td>
        <td>'.$detailsPacket.'</td>                  
    </tr>';
    
  }
  
  $formattedData=$formattedData.'</tbody></table>';
  $responseArray = array('response_code'=>1, 'response_message'=>'data fetch ok', 'data'=>$formattedData);
  die(json_encode($responseArray));

}else{
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 106');
  die(json_encode($responseArray));
}
?>