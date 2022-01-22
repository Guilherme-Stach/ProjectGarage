<?php
require 'session.init.php';
error_reporting(0);
$_CURRENT_PAGE="dashboard";
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head>
        <?php  include 'head_css.php' ?>
        <link rel="stylesheet" href="../global/vendor/timepicker/jquery-timepicker.css">
        <link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
        <link rel="stylesheet" href="../global/vendor/c3/c3.css">
    </head>
    <body class="animsition dashboard">
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
        include 'header.php';
        ?>
        
        <?php
        include 'left_menu.php';
        ?>
        
        
        <div class="page">
            <div class="page-content container-fluid">
                <div class="row" data-plugin="matchHeight" data-by-row="true">
                    <div class="col-xl-4 col-md-4">
                        <!-- Widget Linearea One-->
                        <div class="card card-shadow bg-indigo-500" id="widgetLineareaOne">
                            <div class="card-block p-20 pt-10">
                                <div class="clearfix">
                                    <div class="white float-left py-10">
                                        <i class="icon md-account white font-size-24 vertical-align-bottom mr-5"></i>Total Customers
                                    </div>
                                    <span id="total_users" class="float-right white font-size-30">...</span>
                                </div>
                                
                            </div>
                        </div>
                        <!-- End Widget Linearea One -->
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <!-- Widget Linearea Two -->
                        <div class="card card-shadow bg-indigo-500" id="widgetLineareaFour">
                            <div class="card-block p-20 pt-10">
                                <div class="clearfix">
                                    <div class="white float-left py-10">
                                        <i class="icon md-view-list white font-size-24 vertical-align-bottom mr-5"></i>Total Bookings
                                    </div>
                                    <span id="total_bookings" class="float-right white font-size-30">...</span>
                                </div>
                                
                            </div>
                        </div>
                        <!-- End Widget Linearea Two -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Page -->


    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    
    <script src="../js/dashboard.js"></script>
</body>
</html>