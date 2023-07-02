<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $roomname = $_POST['roomname'];
        $capacity = $_POST['capacity'];
        $usability = $_POST['usability'];
        $description = $_POST['description'];
        $availableTime = $_POST['availableTimes'];
        $sql = "SELECT * FROM `room` WHERE id=:roomname";
        $query = Query::executeQuery($dbh, $sql, [':roomname', $roomname]);
        $rowCount = $query->rowCount();
        if ($rowCount == 0) {
            $sql = "INSERT INTO room (id, capacity, usability, description, avaiableTime) VALUES (:roomname, :capacity, :usability, :description, :availableTime)";
            $query = Query::executeQuery($dbh, $sql, [':roomname', $roomname], [':capacity', $capacity], [':usability', $usability], [':description', $description], [':availableTime', $availableTime]);
            if ($query->rowCount() > 0) {
                echo "<script>alert('Room added successfully');</script>";
            } else {
                echo "<script>alert('Failed to add room');</script>";
            }
        } else {
            echo "<script>alert('Room " . $roomname . " existed! Cannot add room');</script>";
        }
        echo "<script>window.location.href = 'manage-rooms.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Room</title>
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Add Room</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Room Name</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="roomname" placeholder="Enter Room Name" required>
                                        <span id="room-availability-status"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Capacity</label>
                                    <div class="col-10">
                                        <select class="form-control" name="capacity" required>
                                            <option>50</option>
                                            <option>150</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Usability</label>
                                    <div class="col-10">
                                        <select class="form-control" name="usability" required>
                                            <option value="1">Available</option>
                                            <option value="0">Not Available</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Description</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="description" placeholder="Enter Room Description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Available Time</label>
                                    <div class="col-10">
                                        <select class="form-control" name="availableTimes" multiple required>
                                            <option value="Morning">Morning</option>
                                            <option value="Afternoon">Afternoon</option>
                                            <option value="Evening">Evening</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Add Room</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
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

    </html>
<?php } ?>