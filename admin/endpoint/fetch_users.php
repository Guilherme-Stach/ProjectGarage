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



$fetchDetailsQuery = "select user_id,name,email,phone,address from users";

$result= mysqli_query($con,$fetchDetailsQuery);
mysqli_close($con);

if($result){

    $formattedData='<table class="table table-hover dataTable table-striped w-full dtr-inline" id="users-table" role="grid">
      <thead>
        <tr role="row">
          <th class="sorting_asc">S.No.</th>
          <th class="sorting">User Id</th>
          <th class="sorting">Name</th>
          <th class="sorting">Email</th>
          <th class="sorting">Mobile</th>
          <th class="sorting">Address</th>                 
        </tr>
      </thead>
      <tbody>';
  

  $counter=0;
  while($row=mysqli_fetch_array($result)){

    $counter=$counter+1;

    $formattedData=$formattedData
      .'<tr>
        <td>'.$counter.'</td>
        <td>'.$row['user_id'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['phone'].'</td>
        <td>'.$row['address'].'</td>                    
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