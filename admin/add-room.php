<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $dno = $_POST['roomID'];
        $lcsocket = $_POST['laptopchargersocket'];
        $query = $dbh->prepare("SELECT id FROM room WHERE roomID=:dno");
        $query->bindParam(':dno', $dno, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            echo '<script>alert("Room ID already Created try with another room.")</script>';
        } else {

            $sql = "insert into room(roomID,laptopChargerScoket)values(:dno,:lcsocket)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':dno', $dno, PDO::PARAM_STR);
            $query->bindParam(':lcsocket', $lcsocket, PDO::PARAM_STR);
            $query->execute();

            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Room has been added.")</script>';
                echo "<script>window.location.href ='manage-rooms.php'</script>";
            } else {
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }
        }
    }

?>
    <!doctype html>
    <html lang="en">

    <head>

        <title>Student Study Center Mananagement System | Add Room</title>
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script>
            function checkRoomAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data: 'dno=' + $("#roomID").val(),
                    type: "POST",
                    success: function(data) {
                        $("#room-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>


    </head>


    <body>

        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">

                            <h4 class="page-title">Add Room</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">

                                    <h4 class="header-title m-t-0">Add Room</h4>

                                    <div class="p-20">
                                        <form action="#" method="post">

                                            <div class="form-group">
                                                <label for="userName">Room ID<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Room ID" required="true" name="roomID" id="roomID" onBlur="checkRoomAvailability()">
                                                <span id="room-availability-status"></span>

                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">Laptop / Charger Socket<span class="text-danger"></span></label>
                                                <input type="checkbox" value="Yes" name="laptopchargersocket">
                                            </div>

                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
                                                    Add
                                                </button>

                                            </div>

                                        </form>
                                    </div>

                                </div>

                            </div>
                            <!-- end row -->


                        </div>
                    </div><!-- end col-->

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

    </html><?php }  ?>
