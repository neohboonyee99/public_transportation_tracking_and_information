<?php
    require "DB_Functions.php";
    $db = new DB_Functions();
    if (isset($_POST['submit_view_driver_details'])){
        if (isset($_POST['driverName'])){
            $driverName = $_POST['driverName'];
            $driverDetails = $db->getDriverDetailsByName($driverName);

        }
        if ($driverDetails){

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Bus Driver</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
   
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- toggle and nav items -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/blank.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Admin</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="admin_view_driver.php" aria-expanded="false"><i class="fas fa-user"
                                    aria-hidden="true"></i><span class="hide-menu">Driver</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="admin_view_route.php" aria-expanded="false">
                                <i class="fa fa-road" aria-hidden="true"></i><span class="hide-menu">Route</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="admin_view_stops.php" aria-expanded="false">
                                <i class="fa fa-bus" aria-hidden="true"></i><span class="hide-menu">Stops</span></a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Edit Driver Details</h4>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="admin_edit_driver.php" class="form-horizontal form-material" method="post">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_name" type="text" placeholder="Example: Fahir Ridzuan" 
                                            <?php 
                                                echo 'value="'.$driverDetails['driver_name'].'"';
                                            ?> required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver IC Number</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_ic" type="text" placeholder="Example: 123456789012" <?php 
                                                echo 'value="'.$driverDetails['driver_ic'].'"';
                                            ?>  required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver Bus Route</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_bus_route" type="text" placeholder="Example: 401E" 
                                            <?php 
                                                echo 'value="'.$driverDetails['driver_bus_route'].'"';
                                            ?>required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" name="submit_edit_driver" class="btn btn-success">Edit Driver Details</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2020 © Public Transportation Tracking and Information System
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>

    
</body>

</html>
<?php
        }
        else if(isset($_POST['submit_edit_driver'])){
            if (isset($_POST['driver_name']) && isset($_POST['driver_ic']) && isset($_POST['driver_bus_route'])){
                $driverName = $_POST['driver_name'];
                $driverIC = (int)$_POST['driver_ic'];
                $driverBusRoute = $_POST['driver_bus_route'];

                $icPattern = "/^[0-9]{12}$/";

                if (!empty($driverName) && !empty($driverIC) && !empty($driverBusRoute)){
                    if(!preg_match($icPattern, $driverIC)){
                        echo "<script>alert('Please enter IC Number in correct format! Please try again')</script>"; 
                    }


                    else{
                        $driver = $db->editBusDriver($driverName,$driverIC,$driverBusRoute);

                        if ($driver){
                            echo "<script>alert('Successfully edit driver details')</script>";
                            echo "<script type='text/javascript'>location.href = 'admin_view_driver.php';</script>";
                            
                        }
                    
                        else 
                        {
                            echo "<script>alert('Unsuccessful to edit driver details')</script>"; 
                            
                        }
                        
                    }
                    
                }
                else{
                    echo "<script>alert('Unsuccessful to edit driver details! Please fill in all the details!')</script>"; 
                    
                }
                
            }
            else{
                echo "<script>alert('Unsuccessful to edit driver details')</script>"; 
            
            }
        }
    }
?>

