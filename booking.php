<?php
$page = "booking.php";
session_start();
include('db.php');

if (!strlen(isset($_SESSION['user']))) {
    header("location: login.php");
}

if(isset($_GET['book']))
{

	$isValid = true;
	 
	$booking_type= mysqli_real_escape_string($dbh,$_POST['booking_type']);
	$vehicle_type= mysqli_real_escape_string($dbh,$_POST['vehicle_type']);
	$vehicle_make= mysqli_real_escape_string($dbh,$_POST['vehicle_make']);
	$vehicle_other= mysqli_real_escape_string($dbh,$_POST['vehicle_other']);
	$licence_detail= mysqli_real_escape_string($dbh,$_POST['licence_detail']);
	$engine_type= mysqli_real_escape_string($dbh,$_POST['engine_type']);
	$date= mysqli_real_escape_string($dbh,$_POST['date']);
	$description= mysqli_real_escape_string($dbh,$_POST['description']);

	if ($booking_type == '-1') {
		echo "<script>
		alert('Please select booking type');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}
	if ($vehicle_type == '-1') {
		echo "<script>
		alert('Please select vehicle type');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}
	if ($vehicle_make == '-1') {
		echo "<script>
		alert('please select vehicle make');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}
	if ($vehicle_make == '0' && $vehicle_other == "") {
		echo "<script>
		alert('please enter vehicle details');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}
	if ($licence_detail == "") {
		echo "<script>
		alert('please enter licence details');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}
	if ($engine_type == '-1') {
		echo "<script>
		alert('please select engine_type type');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}
	if ($date == '') {
		echo "<script>
		alert('please select booking date');
		window.location.href='booking.php';
		</script>";
		$isValid = false;
	}

    $sql = "SELECT * FROM bookings WHERE booking_date = '$date'";
    $result = $dbh->query($sql);
    if ($result->num_rows > 12) {
        echo "<script>
            alert('Sorry, Online Booking is closed!');
            </script>";
        $isValid = false;
    }

	if ($isValid) {
		$user_id = $_SESSION['user_id'];

        if ($vehicle_make == '0') {
            $vehicle_make = $vehicle_other;
        }

        
        $created_date = date("Y-m-d H:i:s");
        $hash = hexdec(sha1($vehicle_make.$engine_type.rand(100,10000).$created_date));
        $trimmedhash = substr($hash, 0, 8);
        $vehicle_id=str_replace('.','',$trimmedhash);

		$sql="INSERT INTO vehicle(vehicle_id, user_id, type, make, licence_details ,engine_type) VALUES('$vehicle_id','$user_id','$vehicle_type','$vehicle_make','$licence_detail','$engine_type')";
        $result = $dbh->query($sql);
        if(!$result){
		
			echo "<script>
				alert('Something went wrong. Please try again!');
				window.location.href='booking.php';
				</script>";
		}else {

            $created_date = date("Y-m-d H:i:s");
            $hash = hexdec(sha1($booking_type.$description.rand(100,10000).$created_date));
            $trimmedhash = substr($hash, 0, 8);
            $booking_id=str_replace('.','',$trimmedhash);
            
            $sql="INSERT INTO bookings(booking_id, user_id, vehicle_id, booking_type, description , booking_date) VALUES('$booking_id','$user_id','$vehicle_id','$booking_type','$description','$date')";
            $result = $dbh->query($sql);
            if(!$result) {
                echo "<script>
                alert('Something went wrong. Please try again!');
                window.location.href='booking.php';
                </script>";
            }else {
                echo "<script>
                alert('You have successfully Booked your vehicle service');
                window.location.href='index.php';
                </script>";
                
            }
            
		}
	}

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
  	    <?php include('head.php');?>
    </head>

    <style>
        .custom_btn {
            font-size: 14px;
            padding: 6px 12px 6px 12px;
            background: #ff5521;
            color: #FFFFFF;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid #e87513;
            border-radius: 5px;
            width: 100px;
            font-size: 20px;
        }
    </style>
<body>
  
  <?php include('header.php');?>
  <?php include('navbar.php');?>

  <section id="service" class="faq_main clearfix">
   <div class="service_main">
    <div class="container">
    <div class="row">
	 <div class="service_main_top clearfix">
	   <div class="service_main_top_inner">
	    <p>Book FOR ANY Service/Repair</p>
	   </div>
	   <div class="center_1_top_inner_2">
	    <h2>Booking</h2>
	   </div>
	 </div>
	</div>
   </div>
   </div>
  </section>
           
    <section id="contact" class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 contact_top clearfix" style="border-bottom:0px">
                    <h2>Book Vehicle</h2>
                </div>
                <div class="col-sm-12 contact clearfix">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 contact_right clearfix" style="border-left:0px">
                        <div class="contact_right_1 clearfix">
                        <form action="booking.php?book" id="form1" style="text-align:right" name="booking" method="post">
                                <div class="control-group">
                                    <select id="booking_type" class="form-control" name="booking_type">
                                        <option value="-1" selected>Select Booking Type</option>
                                        <option value="1" >Annual Service</option>
                                        <option value="2" >Major Service</option>	
                                        <option value="3" >Repair / Fault</option>
                                        <option value="4" >Major Repair</option>
                                    </select>
                                </div>
                                <br>
                                <div class="control-group">
                                    <select id="vehicle_type" class="form-control" name="vehicle_type">
                                        <option value="-1" selected>Select Vehicle Type</option>
                                        <option value="MotorBike" >MotorBike</option>
                                        <option value="Car" >Car</option>	
                                        <option value="Small Van" >Small Van</option>
                                        <option value="Small Bus" >Small Bus</option>
                                    </select>
                                </div>
                                <br>
                                <div class="control-group">
                                    <select id="vehicle_make" class="form-control" onchange="checkMake()" name="vehicle_make">
                                        <option value="-1" selected>Select Vehicle Make</option>
                                        <option value="Acura">Acura</option> 
                                        <option value="Alfa Romeo">Alfa Romeo</option> 
                                        <option value="Allard">Allard</option> 
                                        <option value="Cadillac">Cadillac</option> 
                                        <option value="Chevrolet">Chevrolet</option> 
                                        <option value="Chrysler">Chrysler</option> 
                                        <option value="Citroen">Citroen</option> 
                                        <option value="Daewoo">Daewoo</option> 
                                        <option value="Duesenberg">Duesenberg</option> 
                                        <option value="Eagle">Eagle</option> 
                                        <option value="Edsel">Edsel</option> 
                                        <option value="Ferrari">Ferrari</option> 
                                        <option value="FIAT">FIAT</option> 
                                        <option value="Fisker">Fisker</option> 
                                        <option value="Ford">Ford</option> 
                                        <option value="Franklin">Franklin</option> 
                                        <option value="Graham">Graham</option> 
                                        <option value="Hillman">Hillman</option> 
                                        <option value="Honda">Honda</option> 
                                        <option value="Intermeccanica">Intermeccanica</option> 
                                        <option value="International Harvester">International Harvester</option> 
                                        <option value="Iso">Iso</option> 
                                        <option value="Isuzu">Isuzu</option> 
                                        <option value="Jaguar">Jaguar</option> 
                                        <option value="Mobility Ventures">Mobility Ventures</option> 
                                        <option value="Morris">Morris</option> 
                                        <option value="Moskvitch">Moskvitch</option> 
                                        <option value="Muntz">Muntz</option> 
                                        <option value="Nash">Nash</option> 
                                        <option value="Nissan">Nissan</option> 
                                        <option value="Oldsmobile">Oldsmobile</option> 
                                        <option value="Pininfarina">Pininfarina</option> 
                                        <option value="Plymouth">Plymouth</option> 
                                        <option value="Reliant">Reliant</option> 
                                        <option value="Riley">Riley</option> 
                                        <option value="Rolls-Royce">Rolls-Royce</option> 
                                        <option value="Shelby">Shelby</option> 
                                        <option value="smart">smart</option> 
                                        <option value="Tesla">Tesla</option> 
                                        <option value="Toyota">Toyota</option> 
                                        <option value="0" >Other</option>
                                    </select>
                                </div>
                                <br>
                                <div class="control-group" id="make_other" style="display:none">
                                    <input type="text" id="vehicle_other" class="form-control" name="vehicle_other" placeholder="Enter Vehicle Type and Make">
                                    <br>
                                </div>
                                <div class="control-group">
                                    <input type="text" id="licence_detail" class="form-control" name="licence_detail" placeholder="Enter Vehicle Licence details" required>
                                </div>
                                <br>
                                <div class="control-group">
                                    <select id="engine_type" class="form-control" name="engine_type">
                                        <option value="-1" selected>Select Engine Type</option>
                                        <option value="Diesel" >Diesel</option>
                                        <option value="Petrol" >Petrol</option>
                                        <option value="Hybrid" >Hybrid</option>
                                        <option value="Electric" >Electric</option>
                                    </select>
                                </div>
                                <br>
                                <div class="control-group">
                                    <input type="date" id="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" name="date" required>
                                </div>
                                <br>
                                <div class="control-group">
                                    <textarea id="description" class="form-control" placeholder="Description" name="description" rows="4"></textarea>
                                </div>
                                <br>
                                <div>
                                    <button class="custom_btn" name="booking" type="submit">Book</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php');?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        function checkMake() {
            if($('#vehicle_make').val() == '0') {
                $('#make_other').show();
            }else {
                $('#make_other').hide();
            }
        }

        const picker = document.getElementById('date');
        picker.addEventListener('input', function(e){
        var day = new Date(this.value).getUTCDay();
        if([0].includes(day)){
            e.preventDefault();
            this.value = '';
            alert('Sunday not allowed');
        }
        });

    </script>
    
</body>
</html>