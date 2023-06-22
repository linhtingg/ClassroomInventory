<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
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



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
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
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                            $totalroom = $query1->rowCount();
                            ?><i class="fa fa-desktop float-right"></i>

                            <h6 class="text-muted text-uppercase m-b-20">Total Rooms</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities($totalrooms); ?></h2>
                            <a href="manage-desks.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room where usability = 1";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                            $totalroomsavail = $query1->rowCount();
                            ?>
                            <i class="fa fa-roomtop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total room Available</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($totalroomsavail); ?></span></h2>
                            <a href="manage-rooms.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room where capacity > 80";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                            $isoccupied = $query1->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Lecture Hall</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($isoccupied); ?></span></h2>
                            <a href="manage-desks.php"><span class="badge badge-danger"> View Detail </span></a>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql11 = "SELECT * from  equipment ";
                            $query11 = $dbh->prepare($sql11);
                            $query11->execute();
                            $results11 = $query11->fetchAll(PDO::FETCH_OBJ);
                            $totalregstd = $query11->rowCount();
                            ?>
                            <i class="fa fa-users float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Registered Equipments</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($totalregstd); ?></span></h2>
                            <a href="manage-students.php"><span class="badge badge-danger"> View Detail </span></a>
                        </div>
                    </div>




                </div>
                <!-- end row -->




            </div> <!-- container -->

            <?php include_once('includes/footer.php'); ?>




        </div> <!-- End wrapper -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
        <script src="../plugins/morris/morris.min.js"></script>
        <script src="../plugins/raphael/raphael.min.js"></script>

        <!-- Counter Up  -->
        <script src="../plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html><?php } ?>