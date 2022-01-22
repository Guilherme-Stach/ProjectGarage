<?php
require 'session.init.php';
error_reporting(0);

$_CURRENT_PAGE="users";

?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
   <?php  include 'head_css.php' ?>
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
                <h2 style="margin:0px">Customers</h2>
                <!-- page content goes here -->
            </div>
        <div class="panel">
          <div class="panel-body">
            <div id="users_table" class="dataTables_wrapper dt-bootstrap4">
                
            </div>
          </div>
        </div>
                
        </div>
        <!-- End Page -->
  </div>

    <!-- Footer -->
    <?php
        include 'footer.php';
    ?>
    
    <script src="../js/users.js"></script>
    
  </body>
</html>