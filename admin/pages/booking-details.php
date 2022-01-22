<?php
require '../endpoint/constants.php';
require 'session.init.php';
error_reporting(0);
$_CURRENT_PAGE="product-details";

if(!isset($_GET["booking_id"])){
 echo '<script type="text/javascript">location.href = "../bookings.php";</script>';
}



$booking_id=$_GET['booking_id'];

$con=mysqli_connect($db_server,$db_username,$db_password,$db_database);
if (mysqli_connect_errno()){
$responseArray = array('response_code'=>7,'response_message'=>'db I/O error');
die(json_encode($responseArray));
}else{
//echo 'connection successfull<br>';
}

$fetchDetailsQuery = "select bookings.booking_id,bookings.booking_type,
bookings.description,bookings.booking_date,
bookings.status,
bookings.mechanic_id,
mechanic.name,
mechanic.email,
mechanic.phone,
mechanic.address,
users.user_id,
users.name as user_name,
users.email as user_email,
users.phone as user_phone,
users.address as user_address,
vehicle.vehicle_id,
vehicle.type,
vehicle.make,
vehicle.licence_details,
vehicle.engine_type 
from bookings
inner join users on bookings.user_id = users.user_id 
inner join vehicle on bookings.vehicle_id = vehicle.vehicle_id 
left join mechanic on bookings.mechanic_id = mechanic.mechanic_id 
where bookings.booking_id=$booking_id";
 //die($fetchDetailsQuery);
 $result = mysqli_query($con,$fetchDetailsQuery);
 $detailPacket = "";
 if($result){
  while($row=mysqli_fetch_array($result)){
      $detailPacket = $row;
      //die($row);

  }
 }



?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head>
        <?php  include 'head_css.php' ?>
        <link rel="stylesheet" href="../global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
        <link rel="stylesheet" href="../global/vendor/bootstrap-sweetalert/sweetalert.css">

        <!-- multiselect dropdown -->
        <link rel="stylesheet" href="../global/css/bootstrap-multiselect.css" type="text/css"/>
        <link rel="stylesheet" href="../global/css/jquery.dropdown.css" type="text/css"/>
    </head>
    <body class="animsition dashboard">
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
        include 'header.php';
        ?>
        
        <div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category"></li>
                
                <li <?php if($_CURRENT_PAGE=="products"){echo 'class="site-menu-item active"';}else{ echo 'class="site-menu-item"'; }    ?> >
                
                    <a class="animsition-link" href="bookings.php">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">BACK</span>
                    </a>
                </li>
              
              
            </ul>
                
        </div>
        </div>
      </div>
    
      </div> 

        
        
        <!-- Page -->
        <input type="hidden" id="booking_id" value="<?php echo $booking_id; ?>">
        <input type="hidden" id="booking_status" value="<?php echo $detailPacket['status']; ?>">
        <div class="page">
            <div class="page-header">
                <h1 class="page-title">Booking Details</h1>
                
            </div>
            <div class="page-content">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>Booking Detail</h4>                 
                                <table class="table table-bordered">
                            
                                    <tbody>

                                    <?php 
                                        $booking_type = "";
                                        $type_cost = 0;
                                        if ($detailPacket['booking_type'] == '1') {
                                            $booking_type = "Annual Service";
                                            $type_cost = 350;
                                        } else if ($detailPacket['booking_type'] == '2') {
                                            $booking_type = "Major Service";
                                            $type_cost = 550;
                                        } else if ($detailPacket['booking_type'] == '3') {
                                            $booking_type = "Repair / Fault";
                                            $type_cost = 150;
                                        } else if($detailPacket['booking_type'] == '4') {
                                            $booking_type = "Major Repair";
                                            $type_cost = 250;
                                        }
                                    
                                        $booking_date = date('d-m-Y',strtotime($detailPacket['booking_date']));
                                    
                                        $status = "Unrepairable";
                                        if ($detailPacket['status'] == '1') {
                                            $status = "Booked";
                                        }else if ($detailPacket['status'] == '2') {
                                            $status = "In Service";
                                        }else if ($detailPacket['status'] == '3') {
                                            $status = "Completed";
                                        }

                                    ?>


                                        <tr>
                                            <td><b>Booking ID:</b></td><td>
                                                <?php echo $detailPacket['booking_id']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Booking Type:</b></td><td>
                                                <?php echo $booking_type; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Booking Date:</b></td><td>
                                                <?php echo $booking_date; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Booking Status:</b></td><td>
                                                <?php echo $status; ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <h4>Vehicle Detail</h4>                 
                                <table class="table table-bordered">
                            
                                    <tbody>

                                        <tr>
                                            <td><b>Vehicle ID:</b></td><td>
                                                <?php echo $detailPacket['vehicle_id']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Type:</b></td><td>
                                                <?php echo $detailPacket['type']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Make:</b></td><td>
                                                <?php echo $detailPacket['make']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Licence Details:</b></td><td>
                                                <?php echo $detailPacket['licence_details']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Engine Type:</b></td><td>
                                                <?php echo $detailPacket['engine_type']; ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <h4>Customer Detail</h4>                 
                                <table class="table table-bordered">
                            
                                    <tbody>

                                        <tr>
                                            <td><b>Customer ID:</b></td><td>
                                                <?php echo $detailPacket['user_id']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Name:</b></td><td>
                                                <?php echo $detailPacket['user_name']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Email:</b></td><td>
                                                <?php echo $detailPacket['user_email']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Phone:</b></td><td>
                                                <?php echo $detailPacket['user_phone']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Address:</b></td><td>
                                                <?php echo $detailPacket['user_address']; ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <?php
                                if ($detailPacket['status'] == '1') {
                            ?>
                                    <div class="col-lg-4">
                                        <button class="btn btn-md btn-info btn-sm mt-2" onclick="assignMechanic('<?php echo $booking_id; ?>')">Assign Mechanic</button>
                                    </div>
                            <?php    
                                }else {
                            ?>
                            <div class="col-lg-4">
                                <h4>Mechanic Detail</h4>                 
                                <table class="table table-bordered">
                            
                                    <tbody>

                                        <tr>
                                            <td><b>Mechanic ID:</b></td><td>
                                                <?php echo $detailPacket['mechanic_id']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Name:</b></td><td>
                                                <?php echo $detailPacket['name']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Email:</b></td><td>
                                                <?php echo $detailPacket['email']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Phone:</b></td><td>
                                                <?php echo $detailPacket['phone']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Address:</b></td><td>
                                                <?php echo $detailPacket['address']; ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>
                    </div>
                </div>



                <div class="card">
                    <div class="" style="padding: 30px;">
                        <h4>Cuatomer Note</h4>
                        <div> <?php  echo $detailPacket['description'];?></div>
                    </div>
                </div>


                <?php

                    if ($detailPacket['status'] == '2') {
                ?>

                <div class="card">
                        
                    <div class="" style="padding: 30px;">
                        <div class="row">
                            <!-- page content goes here -->
                            <div class="col-sm-8"><h4>Parts Added While Repairing</h4></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">
                            <button type="button" onclick="showAddPartModel()" class="btn btn-block btn-primary waves-effect waves-classic" >Add Part</button>
                            </div>
                        </div>
                        <br>
                        <div id="parts_table" class="dataTables_wrapper dt-bootstrap4">
                        </div>
                        <br>
                        <div class="row">
                            <!-- page content goes here -->
                            <div class="col-sm-8"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">
                                <button class="btn btn-md btn-info btn-sm mt-2" id="mark_completed" onclick="markCompleted('<?php echo $type_cost; ?>')">Mark Completed</button>
                            </div>
                        </div>
                    </div>
                </div>


                <?php }else if ($detailPacket['status'] == '3') { ?>

                    <div class="card">
                        <div class=""  style="padding: 30px;padding-left:60px">
                            <h4>Invoice</h4>
                            <div id="invoice"></div>
                        </div>
                    </div>

                <?php } ?>

              


            </div>
        </div>
        
    </div>


    <!-- ADD Mechanic Model -->
        <div class="modal fade" id="addMechanicModal" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-simple modal-center">
            <form class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="examplePositionCenter">Assign Mechanic</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <div id="mechanic-list"></div>
                    </div>
                    <div class="col-md-12 float-right">
                    <button class="btn btn-primary waves-effect waves-classic" id="btn_addmechanic" data-dismiss="modal" onclick="addMechanic()" type="button">Assign</button>
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- ADD Part Model -->
    <div class="modal fade" id="addPartsModal" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-simple modal-center">
            <form class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="examplePositionCenter">Add Part</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 form-group">
                        <select  id="select-part" class="form-control">
                            <option value="BALL JOINT@2.99">BALL JOINT (2.99)</option>
                            <option value="BATTERY@32.99">BATTERY (32.99)</option>
                            <option value="BATTERY CABLE@1.99">BATTERY CABLE (1.99)</option>
                            <option value="BATTERY HOLD DOWN@1.99">BATTERY HOLD DOWN (1.99)</option>
                            <option value="BATTERY TERMINAL (PAIR)@2.99">BATTERY TERMINAL (PAIR) (2.99)</option>
                            <option value="BATTERY TRAY@1.99">BATTERY TRAY (1.99)</option>
                            <option value="BED LINER@43.99">BED LINER (43.99)</option>
                            <option value="BED MAT@21.99">BED MAT (21.99)</option>
                            <option value="BELL HOUSING-CLUTCH@19.99">BELL HOUSING-CLUTCH (19.99)</option>
                            <option value="BELT TENSIONER W/BRACKET@13.99">BELT TENSIONER W/BRACKET (13.99)</option>
                            <option value="BELT TENSIONER W/O BRACKET@10.99">BELT TENSIONER W/O BRACKET (10.99)</option>
                            <option value="BLEND DOOR MOTOR/ACTUATOR@8.99">BLEND DOOR MOTOR/ACTUATOR (8.99)</option>
                            <option value="BLOWER MOTOR RESISTOR@8.99">BLOWER MOTOR RESISTOR (8.99)</option>
                            <option value="BOAT LOWER UNIT@125.00">BOAT LOWER UNIT (125.00)</option>
                            <option value="BOAT TRIM SHOCK@21.99">BOAT TRIM SHOCK (21.99)</option>
                            <option value="BRACKET (ENGINE)@6.99">BRACKET (ENGINE) (6.99)</option>
                            <option value="BRAKE BOOSTER@16.99">BRAKE BOOSTER (16.99)</option>
                            <option value="BRAKE BOOSTER HYDRAULIC@32.99">BRAKE BOOSTER HYDRAULIC (32.99)</option>
                            <option value="BRAKE CALIPER (DUAL PISTON)@12.99">BRAKE CALIPER (DUAL PISTON) (12.99)</option>
                            <option value="BRAKE CALIPER (SINGLE PISTON)@11.99">BRAKE CALIPER (SINGLE PISTON) (11.99)</option>
                            <option value="BRAKE CALIPER BRACKET@7.99">BRAKE CALIPER BRACKET (7.99)</option>
                            <option value="BRAKE DRUM@10.99">BRAKE DRUM (10.99)</option>
                            <option value="BRAKE DRUM (WITH HUB)@18.99">BRAKE DRUM (WITH HUB) (18.99)</option>
                            <option value="BRAKE FLUID RESERVOIR@5.99">BRAKE FLUID RESERVOIR (5.99)</option>
                            <option value="CLUTCH BEARING@4.99">CLUTCH BEARING (4.99)</option>
                            <option value="CLUTCH DISC@9.99">CLUTCH DISC (9.99)</option>
                            <option value="CLUTCH FORK@6.99">CLUTCH FORK (6.99)</option>
                            <option value="CLUTCH MASTER CYLINDER@11.99">CLUTCH MASTER CYLINDER (11.99)</option>
                            <option value="CLUTCH PRESSURE PLATE@11.99">CLUTCH PRESSURE PLATE (11.99)</option>
                            <option value="CLUTCH SLAVE CYLINDER@7.99">CLUTCH SLAVE CYLINDER (7.99)</option>
                            <option value="COIL - SINGLE FROM PACK@9.99">COIL - SINGLE FROM PACK (9.99)</option>
                            <option value="COIL PACK ELECTRONIC@27.99">COIL PACK ELECTRONIC (27.99)</option>
                            <option value="COIL STANDARD@9.99">COIL STANDARD (9.99)</option>
                            <option value="COIL WITH IGNITER@9.99">COIL WITH IGNITER (9.99)</option>
                            <option value="COILOVER AFTERMARKET@45.99">COILOVER AFTERMARKET (45.99)</option>
                            <option value="COILOVER SLEEVE@9.99">COILOVER SLEEVE (9.99)</option>
                            <option value="COLD AIR INTAKE@14.99">COLD AIR INTAKE (14.99)</option>
                            <option value="COMPUTER-ECM@32.99">COMPUTER-ECM (32.99)</option>
                            <option value="CONNECTOR/BULB SOCKET UP TO 10@1.99">CONNECTOR/BULB SOCKET UP TO 10 (1.99)</option>
                            <option value="CONSOLE@13.99">CONSOLE (13.99)</option>
                            <option value="CONSOLE COVER@5.99">CONSOLE COVER (5.99)</option>
                            <option value="CONSOLE UPPER@12.99">CONSOLE UPPER (12.99)</option>
                            <option value="CONTROL ARM (ALUMINIUM)@26.99">CONTROL ARM (ALUMINIUM) (26.99)</option>
                            <option value="CONTROL ARM (STEEL)@18.99">CONTROL ARM (STEEL) (18.99)</option>
                            <option value="CONTROL MODULE - SMALL@18.99">CONTROL MODULE - SMALL (18.99)</option>
                            <option value="CONVERTIBLE TOP@81.99">CONVERTIBLE TOP (81.99)</option>
                            <option value="DASH COMP@48.99">DASH COMP (48.99)</option>
                            <option value="DASH PAD@12.99">DASH PAD (12.99)</option>
                            <option value="DIPSTICK@2.99">DIPSTICK (2.99)</option>
                            <option value="DIPSTICK W/TUBE@4.99">DIPSTICK W/TUBE (4.99)</option>
                            <option value="DISTRIBUTOR (POINT TYPE)@15.99">DISTRIBUTOR (POINT TYPE) (15.99)</option>
                            <option value="DISTRIBUTOR CAP@4.99">DISTRIBUTOR CAP (4.99)</option>
                            <option value="DISTRIBUTOR CAP ELEC.@13.99">DISTRIBUTOR CAP ELEC. (13.99)</option>
                            <option value="DISTRIBUTOR ELECTRONIC@26.99">DISTRIBUTOR ELECTRONIC (26.99)</option>
                            <option value="DISTRIBUTOR ELECTRONIC w/MODULE@32.99">DISTRIBUTOR ELECTRONIC w/MODULE (32.99)</option>
                            <option value="DISTRIBUTOR MODULE@14.99">DISTRIBUTOR MODULE (14.99)</option>
                            <option value="DIVIDER (VAN)@34.99">DIVIDER (VAN) (34.99)</option>
                            <option value="DOMELIGHT@6.99">DOMELIGHT (6.99)</option>
                            <option value="DOOR HANDLE INSIDE@4.99">DOOR HANDLE INSIDE (4.99)</option>
                            <option value="DOOR HANDLE OUTSIDE@4.99">DOOR HANDLE OUTSIDE (4.99)</option>
                            <option value="DOOR HINGE (EACH)@5.99">DOOR HINGE (EACH) (5.99)</option>
                            <option value="DOOR LATCH@8.99">DOOR LATCH (8.99)</option>
                            <option value="DOOR LATCH W/POWER LOCK@15.99">DOOR LATCH W/POWER LOCK (15.99)</option>
                            <option value="DOOR LOCK CYLINDER@1.99">DOOR LOCK CYLINDER (1.99)</option>
                            <option value="DOOR- Powered/Automatic side@65.99">DOOR- Powered/Automatic side (65.99)</option>
                            <option value="DOOR SHELL {no glass@motors">DOOR SHELL {no glass (motors)</option>
                            <option value="EXHAUST PIPE@5.99">EXHAUST PIPE (5.99)</option>
                            <option value="FAN BELT - SERPENTINE@5.99">FAN BELT - SERPENTINE (5.99)</option>
                            <option value="FAN BELT - V TYPE@1.99">FAN BELT - V TYPE (1.99)</option>
                            <option value="FAN BLADE@5.99">FAN BLADE (5.99)</option>
                            <option value="FAN CLUTCH@10.99">FAN CLUTCH (10.99)</option>
                            <option value="FENDER (W/O ACCESSORIES)@29.99">FENDER (W/O ACCESSORIES) (29.99)</option>
                            <option value="FENDER EXTENSION@7.99">FENDER EXTENSION (7.99)</option>
                            <option value="FENDER INNER@10.99">FENDER INNER (10.99)</option>
                            <option value="FLOOR MATS@1.99">FLOOR MATS (1.99)</option>
                            <option value="FLYWHEEL AUTOMATIC@15.99">FLYWHEEL AUTOMATIC (15.99)</option>
                            <option value="FLYWHEEL COVER@5.99">FLYWHEEL COVER (5.99)</option>
                            <option value="FLYWHEEL STANDARD@18.99">FLYWHEEL STANDARD (18.99)</option>
                            <option value="FOG LAMP@10.99">FOG LAMP (10.99)</option>
                            <option value="FRAME ASSEMBLY@219.99">FRAME ASSEMBLY (219.99)</option>
                            <option value="FRONT END (W/O COOLERS)@328.99">FRONT END (W/O COOLERS) (328.99)</option>
                            <option value="FUEL CAP@2.99">FUEL CAP (2.99)</option>
                            <option value="FUEL DISTRIBUTOR@26.99">FUEL DISTRIBUTOR (26.99)</option>
                            <option value="FUEL FILLER DOOR@5.99">FUEL FILLER DOOR (5.99)</option>
                            <option value="FUEL FILLER NECK@7.99">FUEL FILLER NECK (7.99)</option>
                            <option value="FUEL PUMP ELECTRIC@15.99">FUEL PUMP ELECTRIC (15.99)</option>
                            <option value="FUEL PUMP REGULAR@8.99">FUEL PUMP REGULAR (8.99)</option>
                            <option value="FUEL SENDING UNIT@8.99">FUEL SENDING UNIT (8.99)</option>
                            <option value="FUEL TANK (UNPROCESSED)@37.99">FUEL TANK (UNPROCESSED) (37.99)</option>
                            <option value="FUEL TANK SWITCHING UNIT@21.99">FUEL TANK SWITCHING UNIT (21.99)</option>
                            <option value="FUSE BOX@11.99">FUSE BOX (11.99)</option>
                            <option value="FUSE BOX COVER@2.99">FUSE BOX COVER (2.99)</option>
                            <option value="GAUGES (EACH)@4.99">GAUGES (EACH) (4.99)</option>
                            <option value="GLASS VENT W/O FRAME@10.99">GLASS VENT W/O FRAME (10.99)</option>
                            <option value="GLASS-DOOR@21.99">GLASS-DOOR (21.99)</option>
                            <option value="GLASS-REAR SLIDER@26.99">GLASS-REAR SLIDER (26.99)</option>
                            <option value="GLASS-REAR STATIONARY@21.99">GLASS-REAR STATIONARY (21.99)</option>
                            <option value="GLASS-SIDE (VAN)@21.99">GLASS-SIDE (VAN) (21.99)</option>
                            <option value="GLASS-VENT W/FRAME@15.99">GLASS-VENT W/FRAME (15.99)</option>
                            <option value="GLOVE BOX ASSEMBLY@15.99">GLOVE BOX ASSEMBLY (15.99)</option>
                            <option value="GLOVE BOX DOOR@4.99">GLOVE BOX DOOR (4.99)</option>
                            <option value="GRILLE (W/O ACCESSORIES)@28.99">GRILLE (W/O ACCESSORIES) (28.99)</option>
                            <option value="GRILLE INSERT@7.99">GRILLE INSERT (7.99)</option>
                            <option value="GRILLE SHELL@34.99">GRILLE SHELL (34.99)</option>
                            <option value="GRILLE W/PARK LAMPS@32.99">GRILLE W/PARK LAMPS (32.99)</option>
                            <option value="HANDICAP HAND CONTROLS@54.99">HANDICAP HAND CONTROLS (54.99)</option>
                            <option value="HARMONIC BALANCER@14.99">HARMONIC BALANCER (14.99)</option>
                            <option value="HATCH SHOCK (EACH)@5.99">HATCH SHOCK (EACH) (5.99)</option>
                            <option value="HEAD LAMP COMPOSITE@9.99">HEAD LAMP COMPOSITE (9.99)</option>
                            <option value="HEAD LAMP COVER (W/O PARK)@8.99">HEAD LAMP COVER (W/O PARK) (8.99)</option>
                            <option value="HEAD LAMP COVER W/PARK@13.99">HEAD LAMP COVER W/PARK (13.99)</option>
                            <option value="HEAD LAMP HALOGEN@2.99">HEAD LAMP HALOGEN (2.99)</option>
                            <option value="HEAD LAMP HID (BULB)@32.99">HEAD LAMP HID (BULB) (32.99)</option>
                            <option value="HEAD LAMP HID ASSEMBLY@54.99">HEAD LAMP HID ASSEMBLY (54.99)</option>
                            <option value="HEAD LAMP HID BALLAST@9.99">HEAD LAMP HID BALLAST (9.99)</option>
                            <option value="HEAD LAMP MOUNT BRACKET@6.99">HEAD LAMP MOUNT BRACKET (6.99)</option>
                            <option value="HEAD LAMP REGULAR@1.99">HEAD LAMP REGULAR (1.99)</option>
                            <option value="HEAD LAMP SWITCH@8.99">HEAD LAMP SWITCH (8.99)</option>
                            <option value="HEADER PANEL (NO ACCESS.)@39.99">HEADER PANEL (NO ACCESS.) (39.99)</option>
                            <option value="HEATER VENT@1.99">HEATER VENT (1.99)</option>
                            <option value="HOOD (NO ACCESSORIES)@43.99">HOOD (NO ACCESSORIES) (43.99)</option>
                            <option value="HOOD HINGE (EACH)@7.99">HOOD HINGE (EACH) (7.99)</option>
                            <option value="HOOD INSULATION@4.99">HOOD INSULATION (4.99)</option>
                            <option value="HOOD LATCH@8.99">HOOD LATCH (8.99)</option>
                            <option value="HOOD ORNAMENT@3.99">HOOD ORNAMENT (3.99)</option>
                            <option value="HOOD PROP@5.99">HOOD PROP (5.99)</option>
                            <option value="IGNITION SWITCH@10.99">IGNITION SWITCH (10.99)</option>
                            <option value="INFO CENTER@11.99">INFO CENTER (11.99)</option>
                            <option value="LADDER RACK@43.99">LADDER RACK (43.99)</option>
                            <option value="LICENSE PLATE BRACKET@2.99">LICENSE PLATE BRACKET (2.99)</option>
                            <option value="LIFT GATE (BOX TRUCK)@0.00">LIFT GATE (BOX TRUCK) (0.00)</option>
                            <option value="LIGHT BAR@34.99">LIGHT BAR (34.99)</option>
                            <option value="LUG WRENCH@2.99">LUG WRENCH (2.99)</option>
                            <option value="LUG WRENCH - 4 WAY@5.99">LUG WRENCH - 4 WAY (5.99)</option>
                            <option value="LUGGAGE RACK@11.99">LUGGAGE RACK (11.99)</option>
                            <option value="MAP SENSOR@14.99">MAP SENSOR (14.99)</option>
                            <option value="MARKER LIGHT@7.99">MARKER LIGHT (7.99)</option>
                            <option value="MASS AIR FLOW SENSOR@32.99">MASS AIR FLOW SENSOR (32.99)</option>
                            <option value="MIRROR BACK@4.99">MIRROR BACK (4.99)</option>
                            <option value="MIRROR-INSIDE@5.99">MIRROR-INSIDE (5.99)</option>
                            <option value="MIRROR-INSIDE ELECTRIC@9.99">MIRROR-INSIDE ELECTRIC (9.99)</option>
                            <option value="MUDGAURD (EACH)@3.99">MUDGAURD (EACH) (3.99)</option>
                            <option value="MUFFLER@13.99">MUFFLER (13.99)</option>
                            <option value="NEUTRAL SAFTEY SWITCH@8.99">NEUTRAL SAFTEY SWITCH (8.99)</option>
                            <option value="OIL CAP@2.99">OIL CAP (2.99)</option>
                            <option value="OIL COOLER@10.99">OIL COOLER (10.99)</option>
                            <option value="OIL PAN-ALUMINUM@18.99">OIL PAN-ALUMINUM (18.99)</option>
                            <option value="POWER STEER. PRESSURE HOSE@6.99">POWER STEER. PRESSURE HOSE (6.99)</option>
                            <option value="POWER STEERING PUMP@16.99">POWER STEERING PUMP (16.99)</option>
                            <option value="POWER STEERING RESERVOIR@5.99">POWER STEERING RESERVOIR (5.99)</option>
                            <option value="POWER WINDOW SWITCH - DRIVER@10.99">POWER WINDOW SWITCH - DRIVER (10.99)</option>
                            <option value="POWER WINDOW SWITCH - SINGLE@5.99">POWER WINDOW SWITCH - SINGLE (5.99)</option>
                            <option value="POWER WINDOW SWITCH W/MIRROR@13.99">POWER WINDOW SWITCH W/MIRROR (13.99)</option>
                            <option value="PROJECTOR LAMP/BULB@13.99">PROJECTOR LAMP/BULB (13.99)</option>
                            <option value="PULLEY@6.99">PULLEY (6.99)</option>
                            <option value="QUARTER PANEL CENER CUT@76.99">QUARTER PANEL CENER CUT (76.99)</option>
                            <option value="RADIATOR (ALUMINUM)@39.99">RADIATOR (ALUMINUM) (39.99)</option>
                            <option value="RADIATOR (BRASS)@54.99">RADIATOR (BRASS) (54.99)</option>
                            <option value="RADIATOR DUAL FAN W/ SHROUD@32.99">RADIATOR DUAL FAN W/ SHROUD (32.99)</option>
                            <option value="RADIATOR FAN MOTOR@16.99">RADIATOR FAN MOTOR (16.99)</option>
                            <option value="RADIATOR FAN MOTOR W/SHROUD@26.99">RADIATOR FAN MOTOR W/SHROUD (26.99)</option>
                            <option value="RADIATOR FAN SHROUD@6.99">RADIATOR FAN SHROUD (6.99)</option>
                            <option value="RADIATOR HOSE@1.99">RADIATOR HOSE (1.99)</option>
                            <option value="RADIATOR OVERFLOW TANK@6.99">RADIATOR OVERFLOW TANK (6.99)</option>
                            <option value="RADIATOR SUPPORT@21.99">RADIATOR SUPPORT (21.99)</option>
                            <option value="RADIATOR SUPPORT CAP METAL@13.99">RADIATOR SUPPORT CAP METAL (13.99)</option>
                            <option value="RADIATOR SUPPORT CAP PLASTIC@6.99">RADIATOR SUPPORT CAP PLASTIC (6.99)</option>
                            <option value="RAINGAURD (EACH)@4.99">RAINGAURD (EACH) (4.99)</option>
                            <option value="REAR DECK COVER@7.99">REAR DECK COVER (7.99)</option>
                            <option value="REAR END CLIP@274.99">REAR END CLIP (274.99)</option>
                            <option value="RELAY / SENSOR ELECTRICAL@2.99">RELAY / SENSOR ELECTRICAL (2.99)</option>
                            <option value="RELAY ASSEMBLY@9.99">RELAY ASSEMBLY (9.99)</option>
                            <option value="RING GEAR@19.99">RING GEAR (19.99)</option>
                            <option value="ROCKER ARM@0.99">ROCKER ARM (0.99)</option>
                            <option value="ROCKER SHAFT ASSEMBLY@14.99">ROCKER SHAFT ASSEMBLY (14.99)</option>
                            <option value="RUNNING BOARDS@15.99">RUNNING BOARDS (15.99)</option>
                            <option value="SCOOTER ENGINE/TRANS. COMBO@54.99">SCOOTER ENGINE/TRANS. COMBO (54.99)</option>
                            <option value="SEAT - BENCH@13.99">SEAT - BENCH (13.99)</option>
                            <option value="SEAT - BUCKET (EACH)@15.99">SEAT - BUCKET (EACH) (15.99)</option>
                            <option value="SEAT - CAPTAIN CHAIR@29.99">SEAT - CAPTAIN CHAIR (29.99)</option>
                            <option value="SEAT - CAPTAINS CHAIR@29.99">SEAT - CAPTAINS CHAIR (29.99)</option>
                            <option value="SEAT - COVER@2.99">SEAT - COVER (2.99)</option>
                            <option value="SEAT - POWER@23.99">SEAT - POWER (23.99)</option>
                            <option value="SEAT - TRACK W/MOTOR@21.99">SEAT - TRACK W/MOTOR (21.99)</option>
                            <option value="SEAT - TRACK W/O MOTOR@10.99">SEAT - TRACK W/O MOTOR (10.99)</option>
                            <option value="SEAT - WITH AIRBAG@54.99">SEAT - WITH AIRBAG (54.99)</option>
                            <option value="SEAT BASE/BACK@12.99">SEAT BASE/BACK (12.99)</option>
                            <option value="SEAT BELT (PER PERSON)@10.99">SEAT BELT (PER PERSON) (10.99)</option>
                            <option value="SHIFT BOOT@2.99">SHIFT BOOT (2.99)</option>
                            <option value="SHIFT COLLAR@11.99">SHIFT COLLAR (11.99)</option>
                            <option value="SHIFT KNOB@2.99">SHIFT KNOB (2.99)</option>
                            <option value="SHIFT LEVER HANDLE@3.99">SHIFT LEVER HANDLE (3.99)</option>
                            <option value="SHIFT LINKAGE@12.99">SHIFT LINKAGE (12.99)</option>
                            <option value="SHIFTER ASSEMBLY (FLOOR)@21.99">SHIFTER ASSEMBLY (FLOOR) (21.99)</option>
                            <option value="SHOCK ABSORBER@6.99">SHOCK ABSORBER (6.99)</option>
                            <option value="SHOCK ABSORBER-AIR@21.99">SHOCK ABSORBER-AIR (21.99)</option>
                            <option value="SMOG PUMP@14.99">SMOG PUMP (14.99)</option>
                            <option value="SMOG PUMP VALVE@6.99">SMOG PUMP VALVE (6.99)</option>
                            <option value="SPARE TIRE CARRIER@13.99">SPARE TIRE CARRIER (13.99)</option>
                            <option value="SPOILER/AIR DAM@13.99">SPOILER/AIR DAM (13.99)</option>
                            <option value="STEERING COLUMN-REGULAR@21.99">STEERING COLUMN-REGULAR (21.99)</option>
                            <option value="STEERING COLUMN-TILT@32.99">STEERING COLUMN-TILT (32.99)</option>
                            <option value="STEERING GEAR - ELECTRIC@39.99">STEERING GEAR - ELECTRIC (39.99)</option>
                            <option value="STEERING GEAR - POWER@32.99">STEERING GEAR - POWER (32.99)</option>
                            <option value="STEERING GEAR-MANUAL@21.99">STEERING GEAR-MANUAL (21.99)</option>
                            <option value="STEERING RACK - ELECTRIC@54.99">STEERING RACK - ELECTRIC (54.99)</option>
                            <option value="STEERING RACK - MANUAL@21.99">STEERING RACK - MANUAL (21.99)</option>
                            <option value="STEERING RACK - POWER@32.99">STEERING RACK - POWER (32.99)</option>
                            <option value="STEERING SHAFT- INTERMEDIATE@11.99">STEERING SHAFT- INTERMEDIATE (11.99)</option>
                            <option value="STEERING WHEEL@12.99">STEERING WHEEL (12.99)</option>
                            <option value="STEERING WHEEL COVER@2.99">STEERING WHEEL COVER (2.99)</option>
                            <option value="STRUT - AIR RIDE TYPE@43.99">STRUT - AIR RIDE TYPE (43.99)</option>
                            <option value="STRUT - W/COIL SPRING@37.99">STRUT - W/COIL SPRING (37.99)</option>
                            <option value="STRUT - W/OUT COIL SPRING@26.99">STRUT - W/OUT COIL SPRING (26.99)</option>
                            <option value="STRUT - W/SPINDLE@37.99">STRUT - W/SPINDLE (37.99)</option>
                            <option value="WIPER ARM@5.99">WIPER ARM (5.99)</option>
                            <option value="WIPER BLADE@1.99">WIPER BLADE (1.99)</option>
                            <option value="WIPER SWITCH ONLY@6.99">WIPER SWITCH ONLY (6.99)</option>
                            <option value="WIPER TRANS LINK@1.99">WIPER TRANS LINK (1.99)</option>
                            <option value="WIRING HARNESS@21.99">WIRING HARNESS (21.99)</option>
                            <option value="YOKE@13.99">YOKE (13.99)</option>
                        </select>
                    </div>
                    <div class="col-md-12 float-right">
                    <button class="btn btn-primary waves-effect waves-classic" id="btn_addpart" data-dismiss="modal" onclick="addPart()" type="button">Add</button>
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    
    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- Core  -->
    <script src="../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="../global/vendor/jquery/jquery.js"></script>
    <script src="../global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="../global/vendor/bootstrap/bootstrap.js"></script>
    <script src="../global/vendor/animsition/animsition.js"></script>
    <script src="../global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="../global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="../global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    <script src="../global/vendor/waves/waves.js"></script>
    
    <!-- Plugins -->
    <script src="../global/vendor/datatables.net/jquery.dataTables.js"></script>
    <script src="../global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js"></script>
    <script src="../global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js"></script>
    <script src="../global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js"></script>
    <script src="../global/vendor/datatables.net-scroller/dataTables.scroller.js"></script>
    <script src="../global/vendor/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="../global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    <script src="../global/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
    <script src="../global/vendor/datatables.net-buttons/buttons.html5.js"></script>
    <script src="../global/vendor/datatables.net-buttons/buttons.flash.js"></script>
    <script src="../global/vendor/datatables.net-buttons/buttons.print.js"></script>
    <script src="../global/vendor/datatables.net-buttons/buttons.colVis.js"></script>
    <script src="../global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>
    <script src="../global/vendor/bootstrap-sweetalert/sweetalert.js"></script>
    
    
    <!-- Scripts -->
    <script src="../global/js/Component.js"></script>
    <script src="../global/js/Plugin.js"></script>
    <script src="../global/js/Base.js"></script>
    <script src="../global/js/Config.js"></script>
    
    <script src="../assets/js/Section/Menubar.js"></script>
    <script src="../assets/js/Section/GridMenu.js"></script>
    <script src="../assets/js/Section/Sidebar.js"></script>
    <script src="../assets/js/Section/PageAside.js"></script>
    <script src="../assets/js/Plugin/menu.js"></script>

         <!-- multiselect dropdown -->
    <script src="../assets/js/searchable-multiselect/jquery.dropdown.js"></script>
  
    
    <script src="../global/js/config/colors.js"></script>
    <script src="../assets/js/config/tour.js"></script>
    <script>Config.set('assets', '../assets');</script>
    
    <!-- Page -->
    <script src="../assets/js/Site.js"></script>
    <script src="../global/js/Plugin/asscrollable.js"></script>
    <script src="../global/js/Plugin/slidepanel.js"></script>
    <script src="../global/js/Plugin/switchery.js"></script>
    <script src="../global/js/Plugin/matchheight.js"></script>
    <script src="../global/js/Plugin/jvectormap.js"></script>
    <script src="../global/js/Plugin/peity.js"></script>
    
    <script src="../global/js/Plugin/datatables.js"></script>
    
    <script src="../assets/examples/js/dashboard/v1.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  
    
    <script src="../js/booking_details.js"></script>
    <script src="../js/BsMultiSelect.js?v=3"></script>
    
</body>
</html>