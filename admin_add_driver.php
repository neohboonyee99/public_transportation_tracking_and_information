<?php
    require "DB_Functions.php";
    $db = new DB_Functions();

    if( isset($_POST['submit_add_driver']) ){
        
        $driverName = $_POST['driver_name'];
        $driverIC = (int)$_POST['driver_ic'];
        $driverBusRoute = $_POST['route_number'];
        $driverLoginId = $_POST['driver_login_id'];
        $driverLoginPassword = $_POST['driver_login_password'];
        $confirmPassword = $_POST['confirm_password'];
        $busPlateNumber = $_POST['bus_plate_number'];

        $usernamePattern = "/^[0-9a-zA-Z]{8,24}$/";
        $passwordPattern = "/^.{8,255}$/";
        $icPattern = "/^[0-9]{12}$/";

        if (!empty($driverName) && !empty($driverIC) && !empty($driverBusRoute) && !empty($driverLoginId) && !empty($driverLoginPassword) && !empty($confirmPassword) && !empty($busPlateNumber)){
            if(!preg_match($icPattern, $driverIC)){
                echo "<script>alert('Please enter IC Number in correct format! Please try again')</script>"; 
                echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
            }

            else if(!preg_match($usernamePattern, $driverLoginId)){
                echo "<script>alert('Please enter Login ID in correct format! Please try again')</script>"; 
                echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
            }

            else if(!preg_match($passwordPattern, $driverLoginPassword)){
                echo "<script>alert('Please enter Login Password in correct format! Please try again')</script>"; 
                echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
            }

    
            else if ($driverLoginPassword != $confirmPassword){
                echo "<script>alert('Password is different! Please try again')</script>"; 
                echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
            
            }

            else{
                $temp = $db->isDriverExist($driverName,$driverIC,$driverBusRoute,$driverLoginId);

                if ($temp){
                    echo "<script>alert('Driver already exist')</script>"; 
                    echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
                }
                else{
                    $passwordHash = password_hash($driverLoginPassword, PASSWORD_DEFAULT);
                    $driver = $db->addNewDriver($driverName,$driverIC,$driverBusRoute,$driverLoginId,$passwordHash,$busPlateNumber);

                    if ($driver){
                        echo "<script>alert('Successfully added driver')</script>";
                        echo "<script type='text/javascript'>location.href = 'admin_view_driver.php';</script>";
                        
                    }
                
                    else 
                    {
                        echo "<script>alert('Unsuccessful to add driver')</script>"; 
                        echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
                    
                    }
                }
            }
            
        }
        else{
            echo "<script>alert('Unsuccessful to add driver! Please fill in all the details!')</script>"; 
            echo "<script type='text/javascript'>location.href = 'admin_add_driver.php';</script>";
            
        }
            
    }
    else{    
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
                    <h1 style="background-color: #2f323e;
                            margin : 0px;
                            color: #ffff;
                            padding-left: 20px;">Track-IT</h1>
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
                        <h4 class="page-title text-uppercase font-medium font-14">Add New Driver</h4>
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
                                <form action="admin_add_driver.php" class="form-horizontal form-material" method="post">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_name" type="text" placeholder="Example: Fahir Ridzuan" required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver IC Number</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_ic" type="text" placeholder="Example: 123456789012"  required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver Login ID</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_login_id" type="text" placeholder="Example: fahir123 (Minumum 8 Character)" required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver Login Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="driver_login_password" type="password" placeholder="Example: ******** (Minumum 8 character)" required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Confirm Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="confirm_password" type="password" placeholder="Example: ******** (Minumum 8 character)" required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Driver Bus Route</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select class="form-control" name="route_number"> 
                                                <option value="0">Please Select Bus Route</option>
                                                <?php
                                                    $busRoute= $db->getBusRoute();
                                                    foreach ($busRoute as $key =>$value){
                                                        echo'<option value= "'.$value['route_number'].'">'.$value['route_number'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Bus Plate Number</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="bus_plate_number" type="text" placeholder="Example: PMP 1122" required class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" name="submit_add_driver" class="btn btn-success">Add New Driver</button>
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
?>
