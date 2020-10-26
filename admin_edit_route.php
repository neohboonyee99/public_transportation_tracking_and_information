<?php
    require "DB_Functions.php";
    $db = new DB_Functions();

    if (isset($_POST['submit_view_route_details'])){
        if (isset($_POST['routeNumber'])){
            $routeNumber = $_POST['routeNumber'];
            $routeDetails = $db->getRouteDetailsByRouteNumber($routeNumber);

        }
        if ($routeDetails){
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Bus Route</title>
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
                        <h4 class="page-title text-uppercase font-medium font-14">Edit Route Details</h4>
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
                                <form action="admin_add_route.php" class="form-horizontal form-material" method="post">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Bus Route Number</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="bus_route_number" type="text" placeholder="Example: 401E" class="form-control p-0 border-0" 
                                            <?php
                                                echo 'value="'.$routeDetails['route_number'].'"'
                                            ?>> 
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0 text-warning">Start Stop</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="start_stop"> 
                                            <?php echo '<option value="'.$routeDetails['start_stop'].'">'.$routeDetails['start_stop'].'</option>' ;
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">1st Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="1st_stop_start"> 
                                                <?php 
                                                    if ($routeDetails['startStop1st'] == NULL){
                                                        echo '<option value="0">Please Select 1st Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop1st'].'">'.$routeDetails['startStop1st'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">2nd Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="2nd_stop_start"> 
                                                <?php 
                                                    if ($routeDetails['startStop2nd'] == NULL){
                                                        echo '<option value="0">Please Select 2nd Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop2nd'].'">'.$routeDetails['startStop2nd'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">3rd Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="3rd_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop3rd'] == NULL){
                                                        echo '<option value="0">Please Select 3rd Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop3rd'].'">'.$routeDetails['startStop3rd'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">4th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="4th_stop_start"> 
                                                <?php
                                                     if ($routeDetails['startStop4th'] == NULL){
                                                        echo '<option value="0">Please Select 4th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop4th'].'">'.$routeDetails['startStop4th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">5th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="5th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop5th'] == NULL){
                                                        echo '<option value="0">Please Select 5th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop5th'].'">'.$routeDetails['startStop5th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">6th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="6th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop6th'] == NULL){
                                                        echo '<option value="0">Please Select 6th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop6th'].'">'.$routeDetails['startStop6th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">7th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="7th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop7th'] == NULL){
                                                        echo '<option value="0">Please Select 7th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop7th'].'">'.$routeDetails['startStop7th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">8th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="8th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop8th'] == NULL){
                                                        echo '<option value="0">Please Select 8th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop8th'].'">'.$routeDetails['startStop8th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">9th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="9th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop9th'] == NULL){
                                                        echo '<option value="0">Please Select 9th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop9th'].'">'.$routeDetails['startStop9th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">10th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="10th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop10th'] == NULL){
                                                        echo '<option value="0">Please Select 10th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop10th'].'">'.$routeDetails['startStop10th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">11th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="11th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop11th'] == NULL){
                                                        echo '<option value="0">Please Select 11th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop11th'].'">'.$routeDetails['startStop11th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">12th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="12th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop12th'] == NULL){
                                                        echo '<option value="0">Please Select 12th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop12th'].'">'.$routeDetails['startStop12th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">13th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="13th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop13th'] == NULL){
                                                        echo '<option value="0">Please Select 13th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop13th'].'">'.$routeDetails['startStop13th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">14th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="14th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop14th'] == NULL){
                                                        echo '<option value="0">Please Select 14th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop14th'].'">'.$routeDetails['startStop14th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">15th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="15th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop15th'] == NULL){
                                                        echo '<option value="0">Please Select 15th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop15th'].'">'.$routeDetails['startStop15th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">16th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="16th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop16th'] == NULL){
                                                        echo '<option value="0">Please Select 16th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop16th'].'">'.$routeDetails['startStop16th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">17th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="17th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop17th'] == NULL){
                                                        echo '<option value="0">Please Select 17th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop17th'].'">'.$routeDetails['startStop17th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">18th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="18th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop18th'] == NULL){
                                                        echo '<option value="0">Please Select 18th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop18th'].'">'.$routeDetails['startStop18th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">19th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="19th_stop_start"> 
                                                <?php 
                                                     if ($routeDetails['startStop19th'] == NULL){
                                                        echo '<option value="0">Please Select 19th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop19th'].'">'.$routeDetails['startStop19th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">20th Stop - Start</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="20th_stop_start"> 
                                                <?php 
                                                    if ($routeDetails['startStop20th'] == NULL){
                                                        echo '<option value="0">Please Select 20th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['startStop20th'].'">'.$routeDetails['startStop20th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                    <label class="col-md-12 p-0 text-warning">Back Stop</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <select class="form-control" name="back_stop"> 
                                                <?php 
                                                echo '<option value="'.$routeDetails['back_stop'].'">'.$routeDetails['back_stop'].'</option>';
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">1st Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="1st_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop1st'] == NULL){
                                                        echo '<option value="0">Please Select 1st Bus Stop</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$routeDetails['backStop1st'].'">'.$routeDetails['backStop1st'].'</option>';
                                                    }
                                                
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">2nd Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="2nd_stop_back"> 
                                                <?php
                                                    if ($routeDetails['backStop2nd'] == NULL){
                                                        echo '<option value="0">Please Select 2nd Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop2nd'].'">'.$routeDetails['backStop2nd'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">3rd Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="3rd_stop_back"> 
                                                <?php
                                                   if ($routeDetails['backStop3rd'] == NULL){
                                                        echo '<option value="0">Please Select 3rd Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop3rd'].'">'.$routeDetails['backStop3rd'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">4th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="4th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop4th'] == NULL){
                                                        echo '<option value="0">Please Select 4th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop4th'].'">'.$routeDetails['backStop4th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">5th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="5th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop5th'] == NULL){
                                                        echo '<option value="0">Please Select 5th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop5th'].'">'.$routeDetails['backStop5th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">6th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="6th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop6th'] == NULL){
                                                        echo '<option value="0">Please Select 6th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop6th'].'">'.$routeDetails['backStop6th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">7th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="7th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop7th'] == NULL){
                                                        echo '<option value="0">Please Select 7th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop7th'].'">'.$routeDetails['backStop7th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">8th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="8th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop8th'] == NULL){
                                                        echo '<option value="0">Please Select 8th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop8th'].'">'.$routeDetails['backStop8th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">9th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="9th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop9th'] == NULL){
                                                        echo '<option value="0">Please Select 9th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop9th'].'">'.$routeDetails['backStop9th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">10th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="10th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop10th'] == NULL){
                                                        echo '<option value="0">Please Select 10th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop10th'].'">'.$routeDetails['backStop10th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">11th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="11th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop11th'] == NULL){
                                                        echo '<option value="0">Please Select 11th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop11th'].'">'.$routeDetails['backStop11th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">12th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="12th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop12th'] == NULL){
                                                        echo '<option value="0">Please Select 12th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop12th'].'">'.$routeDetails['backStop12th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">13th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="13th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop13th'] == NULL){
                                                        echo '<option value="0">Please Select 13th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop13th'].'">'.$routeDetails['backStop13th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">14th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="14th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop14th'] == NULL){
                                                        echo '<option value="0">Please Select 14th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop14th'].'">'.$routeDetails['backStop14th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">15th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="15th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop15th'] == NULL){
                                                        echo '<option value="0">Please Select 15th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop15th'].'">'.$routeDetails['backStop15th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">16th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="16th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop16th'] == NULL){
                                                        echo '<option value="0">Please Select 16th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop16th'].'">'.$routeDetails['backStop16th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">17th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="17th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop17th'] == NULL){
                                                        echo '<option value="0">Please Select 17th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop17th'].'">'.$routeDetails['backStop17th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">18th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="18th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop18th'] == NULL){
                                                        echo '<option value="0">Please Select 18th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop18th'].'">'.$routeDetails['backStop18th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">19th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="19th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop19th'] == NULL){
                                                        echo '<option value="0">Please Select 19th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop19th'].'">'.$routeDetails['backStop19th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">20th Stop - Back</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <select class="form-control" name="20th_stop_back"> 
                                                <?php 
                                                   if ($routeDetails['backStop20th'] == NULL){
                                                        echo '<option value="0">Please Select 20th Bus Stop</option>';
                                                    }
                                                    else{ 
                                                        echo '<option value="'.$routeDetails['backStop20th'].'">'.$routeDetails['backStop20th'].'</option>';
                                                    }
                                                    $busStop= $db->getBusStops();
                                                    foreach ($busStop as $key =>$value){
                                                        echo'<option value= "'.$value['name'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" name="submit_add_route" class="btn btn-success">Add New Route</button>
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
        else if(isset($_POST['submit_add_route'])){
            if (isset($_POST['bus_route_number']) && isset($_POST['start_stop']) && isset($_POST['back_stop']) && isset($_POST['1st_stop_start']) && isset($_POST['2nd_stop_start'])&& isset($_POST['3rd_stop_start'])&& isset($_POST['4th_stop_start'])&& isset($_POST['5th_stop_start'])&& isset($_POST['6th_stop_start'])&& isset($_POST['7th_stop_start'])&& isset($_POST['8th_stop_start'])&& isset($_POST['9th_stop_start'])&& isset($_POST['10th_stop_start'])&& isset($_POST['11th_stop_start'])&& isset($_POST['12th_stop_start'])&& isset($_POST['13th_stop_start'])&& isset($_POST['14th_stop_start'])&& isset($_POST['15th_stop_start'])&& isset($_POST['16th_stop_start'])&& isset($_POST['17th_stop_start'])&& isset($_POST['18th_stop_start'])&& isset($_POST['19th_stop_start']) && isset($_POST['20th_stop_start']) && isset($_POST['1st_stop_back']) && isset($_POST['2nd_stop_back']) && isset($_POST['3rd_stop_back']) && isset($_POST['4th_stop_back']) && isset($_POST['5th_stop_back']) && isset($_POST['6th_stop_back']) && isset($_POST['7th_stop_back']) && isset($_POST['8th_stop_back']) && isset($_POST['9th_stop_back']) && isset($_POST['10th_stop_back']) && isset($_POST['11th_stop_back']) && isset($_POST['12th_stop_back']) && isset($_POST['13th_stop_back']) && isset($_POST['14th_stop_back']) && isset($_POST['15th_stop_back']) && isset($_POST['16th_stop_back']) && isset($_POST['17th_stop_back']) && isset($_POST['18th_stop_back']) && isset($_POST['19th_stop_back']) && isset($_POST['20th_stop_back'])){

                $routeNumber = $_POST['bus_route_number'];
                $startStop = $_POST['start_stop'];
                $backStop = $_POST['back_stop'];
                if($_POST['1st_stop_start'] !=0){
                    $startStop1st = $_POST['1st_stop_start'];
                }
                else{
                    $startStop1st = NULL;
                }
                if($_POST['2nd_stop_start'] !=0){
                    $startStop2nd = $_POST['2nd_stop_start'];
                }
                else{
                    $startStop2nd = NULL;
                }
                if($_POST['3rd_stop_start']!=0){
                    $startStop3rd = $_POST['3rd_stop_start'];
                }
                else{
                    $startStop3rd = NULL;
                }
                if($_POST['4th_stop_start']!=0){
                    $startStop4th = $_POST['4th_stop_start'];
                }
                else{
                    $startStop4th = NULL;
                }
                if($_POST['5th_stop_start']!=0){
                    $startStop5th = $_POST['5th_stop_start'];
                }
                else{
                    $startStop5th = NULL;
                }
                if($_POST['6th_stop_start']!=0){
                    $startStop6th = $_POST['6th_stop_start'];
                }
                else{
                    $startStop6th = NULL;
                }
                if($_POST['7th_stop_start']!=0){
                    $startStop7th = $_POST['7th_stop_start'];
                }
                else{
                    $startStop7th = NULL;
                }
                if($_POST['8th_stop_start']!=0){
                    $startStop8th = $_POST['8th_stop_start'];
                }
                else{
                    $startStop8th = NULL;
                }
                if($_POST['9th_stop_start']!=0){
                    $startStop9th = $_POST['9th_stop_start'];
                }
                else{
                    $startStop9th = NULL;
                }
                if($_POST['11th_stop_start']!=0){
                    $startStop11th = $_POST['11th_stop_start'];
                }
                else{
                    $startStop11th = NULL;
                }
                if($_POST['12th_stop_start']!=0){
                    $startStop12th = $_POST['12th_stop_start'];
                }
                else{
                    $startStop12th = NULL;
                }
                if($_POST['13th_stop_start']!=0){
                    $startStop13th = $_POST['13th_stop_start'];
                }
                else{
                    $startStop13th = NULL;
                }
                if($_POST['14th_stop_start']!=0){
                    $startStop14th = $_POST['14th_stop_start'];
                }
                else{
                    $startStop14th = NULL;
                }
                if($_POST['15th_stop_start']!=0){
                    $startStop15th = $_POST['15th_stop_start'];
                }
                else{
                    $startStop15th = NULL;
                }
                if($_POST['16th_stop_start']!=0){
                    $startStop16th = $_POST['16th_stop_start'];
                }
                else{
                    $startStop16th = NULL;
                }
                if($_POST['17th_stop_start']!=0){
                    $startStop17th = $_POST['17th_stop_start'];
                }
                else{
                    $startStop17th = NULL;
                }
                if($_POST['18th_stop_start']!=0){
                    $startStop18th = $_POST['18th_stop_start'];
                }
                else{
                    $startStop18th = NULL;
                }
                if($_POST['19th_stop_start']!=0){
                    $startStop19th = $_POST['19th_stop_start'];
                }
                else{
                    $startStop19th = NULL;
                }
                if($_POST['20th_stop_start']!=0){
                    $startStop20th = $_POST['20th_stop_start'];
                }
                else{
                    $startStop20th = NULL;
                }
                if($_POST['1st_stop_back']!=0){
                    $backStop1st = $_POST['1st_stop_back'];
                }
                else{
                    $backStop1st = NULL;
                }
                if($_POST['2nd_stop_back']!=0){
                    $backStop2nd = $_POST['2nd_stop_back'];
                }
                else{
                    $backStop2nd = NULL;
                }
                if($_POST['3rd_stop_back']!=0){
                    $backStop3rd = $_POST['3rd_stop_back'];
                }
                else{
                    $backStop3rd = NULL;
                }
                if($_POST['4th_stop_back']!=0){
                    $backStop4th = $_POST['4th_stop_back'];
                }
                else{
                    $backStop4th = NULL;
                }
                if($_POST['5th_stop_back']!=0){
                    $backStop5th = $_POST['5th_stop_back'];
                }
                else{
                    $backStop5th = NULL;
                }
                if($_POST['6th_stop_back']!=0){
                    $backStop6th = $_POST['6th_stop_back'];
                }
                else{
                    $backStop6th = NULL;
                }
                if($_POST['7th_stop_back']!=0){
                    $backStop7th = $_POST['7th_stop_back'];
                }
                else{
                    $backStop7th = NULL;
                }
                if($_POST['8th_stop_back']!=0){
                    $backStop8th = $_POST['8th_stop_back'];
                }
                else{
                    $backStop8th = NULL;
                }
                if($_POST['9th_stop_back']!=0){
                    $backStop9th = $_POST['9th_stop_back'];
                }
                else{
                    $backStop9th = NULL;
                }
                if($_POST['10th_stop_back']!=0){
                    $backStop10th = $_POST['10th_stop_back'];
                }
                else{
                    $backStop10th = NULL;
                }
                if($_POST['11th_stop_back']!=0){
                    $backStop11th = $_POST['11th_stop_back'];
                }
                else{
                    $backStop11th = NULL;
                }
                if($_POST['12th_stop_back']!=0){
                    $backStop12th = $_POST['12th_stop_back'];
                }
                else{
                    $backStop12th = NULL;
                }
                if($_POST['13th_stop_back']!=0){
                    $backStop13th = $_POST['13th_stop_back'];
                }
                else{
                    $backStop13th = NULL;
                }
                if($_POST['14th_stop_back']!=0){
                    $backStop14th = $_POST['14th_stop_back'];
                }
                else{
                    $backStop14th = NULL;
                }
                if($_POST['15th_stop_back']!=0){
                    $backStop15th = $_POST['15th_stop_back'];
                }
                else{
                    $backStop15th = NULL;
                }
                if($_POST['16th_stop_back']!=0){
                    $backStop16th = $_POST['16th_stop_back'];
                }
                else{
                    $backStop16th = NULL;
                }
                if($_POST['17th_stop_back']!=0){
                    $backStop17th = $_POST['17th_stop_back'];
                }
                else{
                    $backStop17th = NULL;
                }
                if($_POST['18th_stop_back']!=0){
                    $backStop18th = $_POST['18th_stop_back'];
                }
                else{
                    $backStop18th = NULL;
                }
                if($_POST['19th_stop_back']!=0){
                    $backStop19th = $_POST['19th_stop_back'];
                }
                else{
                    $backStop19th = NULL;
                }
                if($_POST['20th_stop_back']!=0){
                    $backStop20th = $_POST['20th_stop_back'];
                }
                else{
                    $backStop20th = NULL;
                }

                $stopUsedStart = array();
                $stopUsedBack = array();

                if (!empty($routeNumber) && !empty($startStop) && !empty($backStop)){
                    array_push($stopUsedStart,$startStop,$startStop1st,$startStop2nd,$startStop3rd,$startStop4th,$startStop5th,$startStop6th,$startStop7th,$startStop8th,$startStop9th,$startStop10th,$startStop11th,$startStop12th,$startStop13th,$startStop14th,$startStop15th,$startStop16th,$startStop17th,$startStop18th,$startStop19th,$startStop20th);
                    array_push($stopUsedBack,$backStop,$backStop1st,$backStop2nd,$backStop3rd,$backStop4th,$backStop5th,$backStop6th,$backStop7th,$backStop8th,$backStop9th,$backStop10th,$backStop11th,$backStop12th,$backStop13th,$backStop14th,$backStop15th,$backStop16th,$backStop17th,$backStop18th,$backStop19th,$backStop20th);
                    $filterStart = array_filter($stopUsedStart);
                    $filterBack = array_filter($stopUsedBack);
                    

                    if(count(array_unique($filterStart)) < count($filterStart)){
                        echo "<script>alert('Multiple duplicate stop selected! Please select different bus stops!'</script>"; 
                    }
                    else if(count(array_unique($filterBack)) < count($filterBack)){
                        echo "<script>alert('Multiple duplicate stop selected! Please select different bus stops!'</script>"; 
                    }

                    $temp = $db->isRouteExist($routeNumber);
                    if ($temp){
                        echo "<script>alert('Route already exist!')</script>"; 
                    }
    
                    else{
                        $route = $db->addNewRoute($routeNumber,$startStop,$backStop,$startStop1st,$startStop2nd,$startStop3rd,$startStop4th,$startStop5th,$startStop6th,$startStop7th,$startStop8th,$startStop9th,$startStop10th,$startStop11th,$startStop12th,$startStop13th,$startStop14th,$startStop15th,$startStop16th,$startStop17th,$startStop18th,$startStop19th,$startStop20th,$backStop1st,$backStop2nd,$backStop3rd,$backStop4th,$backStop5th,$backStop6th,$backStop7th,$backStop8th,$backStop9th,$backStop10th,$backStop11th,$backStop12th,$backStop13th,$backStop14th,$backStop15th,$backStop16th,$backStop17th,$backStop18th,$backStop19th,$backStop20th);
    
                        if ($route){
                            echo "<script>alert('Successfully added route.')</script>";
                            echo "<script type='text/javascript'>location.href = 'admin_view_route.php';</script>";
                            
                        }
                    
                        else 
                        {
                            echo "<script>alert('Unsuccessful to add route.')</script>"; 
                            
                        }
                    }
                    
                    
                }
                else{
                    echo "<script>alert('Unsuccessful to add route! Please fill in all the details!')</script>"; 
                    
                }
                
            }

            else{
                echo "<script>alert('Unsuccessful to add route.')</script>"; 
            
            }
        }
    }
?>