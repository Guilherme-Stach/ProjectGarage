<?php
require 'session.init.php';
error_reporting(0);
$_CURRENT_PAGE="vendors";
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
        
        
        <!-- Page -->
        
        <div class="page">
            <div class="page-header">
                <h1 class="page-title">Vendors</h1>
                <div class="page-header-actions">
                    <div class="btn-group btn-group-sm" id="withBtnGroup" aria-label="Page Header Actions" role="group">
                        <button class="btn btn-primary waves-effect waves-classic" data-target="#newVendoreModal" data-toggle="modal" type="button">Add New Vendor</button>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="panel">
                    <div class="panel-body">
                        <div id="data-contener"></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Modal -->
        <div class="modal fade" id="newVendoreModal" aria-hidden="false" aria-labelledby="exampleFormModalLabel"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <form class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="exampleFormModalLabel">Add New Vendor Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="cname" id="cname" placeholder="Company Name">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Phone Number">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="col-xl-12 form-group">
                                <label>Website</label>
                                
                                <input type="text" class="form-control" name="website" id="website" placeholder="Website Url">
                            </div>
                            <div class="col-xl-12 form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="4" id="address" placeholder="Address"></textarea>
                            </div>
                            <div class="col-xl-12 form-group">
                            
                                <label ><b>Profile Image</b></label>
                                <input type="file" id="profileImage" name="profileImage" accept="image/jpeg,image/png" required>
                                
                            </div>
                            
                            <div class="col-md-12 float-right">
                                <button class="btn btn-primary" type="button" onclick="addNewUser()" id="btn_add_details">Add Details</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal -->
        <!-- Modal -->
        <div class="modal fade" id="updateVendoreModal" aria-hidden="false" aria-labelledby="exampleFormModalLabel"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
                <form class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="exampleFormModalLabel">Update Vendor Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="u_name" id="u_name" placeholder="Name">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="u_cname" id="u_cname" placeholder="Company Name">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="u_mobile" id="u_mobile" placeholder="Phone Number">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="u_email" id="u_email" placeholder="Email">
                            </div>
                            <div class="col-xl-12 form-group">
                                <label>Website</label>
                                
                                <input type="text" class="form-control" name="u_website" id="u_website" placeholder="Website Url">
                            </div>
                            <div class="col-xl-12 form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="4" id="u_address" placeholder="Address"></textarea>
                            </div>
                            <div class="col-xl-6 form-group">
                            
                                <label ><b>Profile Image</b></label>
                                <input type="file" id="updateprofileImage" name="updateprofileImage" accept="image/jpeg,image/png" required>
                                
                            </div>
                            <div class="col-xl-6 form-group">
                            
                                <label ><b>Profile Image</b></label>
                                <div id="image-profile"></div>
                                
                            </div>
                            <div class="col-md-12 float-right">
                                <button class="btn btn-primary" type="button" onclick="updateUserDetsils()" id="btn_update_details">Update Details</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal -->
        
        <!-- End Page -->
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
        <script src="../global/js/Plugin/bootstrap-sweetalert.js"></script>
        <script src="../js/vendors.js"></script>
        
    </body>
</html>