<?php
	$page = "bookings.php";
	session_start();
	error_reporting(0);
	include('db.php');

	//check if user is logged in
	if(strlen($_SESSION['user'])==0)
	{	
		header('location:index.php');
	}
	else{							

		$user_id = $_SESSION['user_id'];

		//query to get user details
		$sql = "select bookings.booking_id,bookings.booking_type,
		bookings.description,bookings.booking_date,
		vehicle.vehicle_id,
		vehicle.type,
		vehicle.make,
		vehicle.licence_details,
		vehicle.engine_type 
		from bookings 
		inner join vehicle on bookings.vehicle_id = vehicle.vehicle_id  
		where bookings.user_id='$user_id' order by bookings.timestamp desc";
		
		// execute query
		$query = mysqli_query($dbh, $sql);
		
		//check if rows>0
		if (mysqli_num_rows($query)==0) {
			header('location:index.php');
		}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include('head.php');?>
  </head>
<body>
  
  <?php include('header.php');?>
  <?php include('navbar.php');?>
  
  <section id="service" class="faq_main clearfix">
   <div class="service_main">
    <div class="container">
    <div class="row">
	 <div class="service_main_top clearfix">
	   <div class="center_1_top_inner_2">
	    <h2>Bookings</h2>
	   </div>
	 </div>
	</div>
   </div>
   </div>
  </section>
  
  
<section id="contact" class="clearfix">
 	<div class="container">
  		<div class="row">
   			<div class="col-sm-12 contact clearfix">
			   	<table class="table">
                    <thead>
                        <tr>
                            <th>Booking Id</th>
                            <th>Booking Type</th>
                            <th>Vehicle</th>
                            <th>Licence Details</th>
                            <th>Engine Type</th>
                            <th>Booking Date</th>
                            <th>Description</th>
                        </tr>
                        
                    </thead>
                    <tbody>
					<?php
						while ($row = mysqli_fetch_array($query))
						{
							echo "<tr>";

							$type= $row['booking_type'];
							$booking_type = "";
							if ($type == '1') {
								$booking_type = "Annual Service";
							} else if ($type == '2') {
								$booking_type = "Major Service";
							} else if ($type == '3') {
								$booking_type = "Repair / Fault";
							} else {
								$booking_type = "Major Repair";
							}
							
							echo "<td>".$row['booking_id']."</td>";
							echo "<td>".$booking_type."</td>";
							echo "<td>".$row['type'].' '.$row['make']."</td>";
							echo "<td>".$row['licence_details']."</td>";
							echo "<td>".$row['engine_type']."</td>";
							echo "<td>".date('d-m-Y',strtotime($row['booking_date']))."</td>";
							echo "<td>".$row['description']."</td>";

							echo "</tr>";
						}

					?>
				</table>
			</div>
		</div>
   	</div>
</section>
  
  
	<?php include('footer.php');?> 	
  
</body>
 <script type="text/javascript">
$(document).ready(function(){

/*****Fixed Menu******/
var secondaryNav = $('.cd-secondary-nav'),
   secondaryNavTopPosition = secondaryNav.offset().top;
	$(window).on('scroll', function(){
		if($(window).scrollTop() > secondaryNavTopPosition ) {
			secondaryNav.addClass('is-fixed');	
		} else {
			secondaryNav.removeClass('is-fixed');
		}
	});	
	
});
</script>  
</html>

<?php } ?>