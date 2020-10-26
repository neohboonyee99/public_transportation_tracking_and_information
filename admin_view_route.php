<?php
    require "DB_Functions.php";
    $db = new DB_Functions();

    if (isset($_POST['btn_delete_route'])){
        if (isset($_POST['route_number'])){
            $routeNumber = $_POST['route_number'];


            $delete = $db->deleteBusRoute($routeNumber);

            if($delete){
                header('Location: '.$_SERVER['PHP_SELF']);  
                
            }
            else{
                echo "<script>alert('Unsuccessful to delete bus route!')";
                header('Location: '.$_SERVER['PHP_SELF']);  
                
            }
        }
        else{
            echo "<script>alert('Unsuccessful to delete bus route!')";
            header('Location: '.$_SERVER['PHP_SELF']);  
        }
        
        
    }
    else {
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bus Route</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
                        <!-- ============================================================== -->
                        <!-- User profile-->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/blank.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Admin</span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile-->
                        <!-- ============================================================== -->
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
            
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Bus Route</h3>
                            <div class="table-responsive">
                                <button type="button" class="btn btn-link"><a href="admin_add_route.php">Add New Route</a></button> 
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Route Number</th>
                                            <th class="border-top-0">Bus Stop (Start)</th>
                                            <th class="border-top-0">Bus Stop (End)</th>
                                            <th class="border-top-0">Details</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        echo '<tbody>';
                                        $busRoute = $db->getBusRoute();

                                        if($busRoute == NULL ){
                                            
                                            echo "<td><p>No data can be found.</p></td>";
                                        }
                                        else {
                                            foreach ($busRoute as $key => $value){
                                                echo '
                                                <td>'.$value['route_number']. '</td>
                                                <td>'.$value['start_stop'].'</td>
                                                <td>'.$value['back_stop'].'</td>
                                                <form action ="admin_edit_route.php" method="post">
                                                    <input type="hidden" name="routeNumber" value="'.$value['route_number'].'"</input>
                                                    <td><input name ="submit_view_route_details" type="submit" class="btn btn-success" value="Edit"></input></td>
                                                </form>
                                                <td><button type="button" class="btn btn-danger" name="delete_route" data-toggle="modal" data-target="#deleteModal">Delete</button></td>
                                                <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <form action ="admin_view_route.php" method="post">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Bus Route</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this bus route?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="route_number" value="'.$value['route_number'].'"</input>
                                                                <input name="btn_delete_route" type="submit" class="btn btn-danger" value="Delete"></button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    </form>
                                                </div>
                                                </tbody>
                                                    ';}
                                        }
                                       
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
            <footer class="footer text-center"> 2020 @ Public Transportation Tracking and Information System 
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