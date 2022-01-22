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
  //echo 'connection successfull<br>';
}



$fetchDetailsQuery = "SELECT * from parts where booking_id='$booking_id'";
//die($fetchDetailsQuery);

$result= mysqli_query($con,$fetchDetailsQuery);


if($result){

    $formattedData='<table class="table table-hover dataTable table-striped w-full dtr-inline" id="parts-table"" role="grid">
      <thead>
        <tr role="row">
          <th class="sorting_asc">S.No.</th>
          <th class="sorting">Part Id</th>
          <th class="sorting">Name</th>
          <th class="sorting">Cost(In Euro)</th>
          <th class="sorting_disabled">Action</th>                 
        </tr>
      </thead>
      <tbody>';
  

  $counter=0;
  while($row=mysqli_fetch_array($result)){
    $counter=$counter+1;
    
    
    $deletePacket = '<a class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row waves-effect waves-classic" id="btn_delete_'.$row['booking_id'].$row['part_id'].'" onclick="deletePart(\''.$row['booking_id'].'\',
                                        \''.$row['part_id'].'\'
    )" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-close" aria-hidden="true"></i></a>';

    
        
        $formattedData=$formattedData
        .'<tr>
            <td>'.$counter.'</td>
            <td>'.$row['part_id'].'</td>
            <td>'.$row['name'].'</td>
            <td>€ '.$row['cost'].'</td>
            <td class="actions">'.$deletePacket.'<br></td>                    
        </tr>';
  }
  
  $formattedData=$formattedData.'</tbody></table>';
  $responseArray = array('response_code'=>1, 'response_message'=>'data fetch ok', 'data'=>$formattedData);
  die(json_encode($responseArray));

}else{
  $responseArray = array('response_code'=>0,'response_message'=>'db I/O error 92');
  die(json_encode($responseArray));
}
?>