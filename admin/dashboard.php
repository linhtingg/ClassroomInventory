<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('./QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
    <!doctype html>
    <html lang="en">
    <!-- App title -->
    <title> Dashboard</title>
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- Switchery css -->
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- App CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Modernizr js -->
    <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Rooms -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room where capacity !=0";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $totalrooms = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Rooms</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities($totalrooms); ?></h2>
                            <a href="manage-rooms.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room where capacity !=0 and usability=1";

                            $query1 = Query::executeQuery($dbh, $sql1);
                            $totalroomssavail = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Rooms Available</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($totalroomssavail); ?></span></h2>
                            <a href="manage-rooms.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room where capacity !=0 and usability=0";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $isoccupied = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Room Occupied</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($isoccupied); ?></span></h2>
                            <a href="manage-rooms.php"><span class="badge badge-danger"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Equipments -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php

                            $sql1 = "SELECT * from equipment";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $totalequipments = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Equipments</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities($totalequipments); ?></h2>
                            <a href="manage-equipments.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from equipment where lastUserUsed is NULL";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $totalequipments = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Equipments Available</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities($totalequipments); ?></h2>
                            <a href="manage-equipments.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from equipment where lastUserUsed is not NULL";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $isoccupied = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Equipment Occupied</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($isoccupied); ?></span></h2>
                            <a href="manage-equipments.php"><span class="badge badge-danger"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Room Registered -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from roomregisterform where reply is null";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $totalequipmentsavail = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Room Registered Students</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($totalequipmentsavail); ?></span></h2>
                            <a href="manage-room-register-students.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Equipment Registered -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  equipmentregisterform where reply is null";
                            $query1 = Query::executeQuery($dbh, $sql1);
                            $isoccupied = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Equipment Registered Students</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($isoccupied); ?></span></h2>
                            <a href="manage-equipment-register-students.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
            <?php include_once('includes/footer.php'); ?>
        </div>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- Validation js (Parsleyjs) -->
        <script src="../plugins/parsleyjs/parsley.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>

    </body>

    </html><?php } ?>