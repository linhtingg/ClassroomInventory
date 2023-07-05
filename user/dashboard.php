<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
    <!doctype html>
    <html lang="en">
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
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $query = RoomController::getAllRooms();
                            $totalroom = $query->rowCount();
                            ?>
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Rooms</h6>
                            <h2 class="m-b-20"><?php echo htmlentities($totalroom); ?></h2>
                            <a href="view-rooms.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql1 = "SELECT * from  room where usability = 1";
                            $query1 = Query::executeQuery($sql1);
                            $totalroomsavail = $query1->rowCount();
                            ?>
                            <i class="fa fa-roomtop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total room Available</h6>
                            <h2 class="m-b-20"><span><?php echo htmlentities($totalroomsavail); ?></span></h2>
                            <a href="view-rooms.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $sql11 = "SELECT * from  `roomregisterform` where `userID` = :aid ";
                            $query11 = Query::executeQuery($sql11, [[':aid', $_SESSION['sscmsaid']]]);
                            $totalregstd = $query11->rowCount();
                            ?>
                            <i class="fa fa-users float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Sent Room Forms</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($totalregstd); ?></span></h2>
                            <a href="view-rooms-form.php"><span class="badge badge-secondary"> View Detail </span></a>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Registered Equipments</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(EquipmentController::getAllEquipments()->rowCount()); ?></span></h2>
                            <a href="view-equipments.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-roomtop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Available Equipments</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(EquipmentController::getAllAvailableEquipments()->rowCount()); ?></span></h2>
                            <a href="view-equipments.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <?php
                            $aid = $_SESSION['sscmsaid'];
                            $sql11 = "SELECT * from  `equipmentregisterform` where `userID` = :aid ";
                            $query11 = Query::executeQuery($sql11, [[':aid', $aid]]);
                            $totalregstd = $query11->rowCount();
                            ?>
                            <i class="fa fa-users float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Sent Equipment Forms</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities($totalregstd); ?></span></h2>
                            <a href="view-equipments-form.php"><span class="badge badge-secondary"> View Detail </span></a>
                        </div>
                    </div>
                </div>
            </div>
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

    </html>
<?php } ?>