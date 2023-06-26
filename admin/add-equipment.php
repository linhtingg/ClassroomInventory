<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('./QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {
        $equipment = $_POST['equipment'];
        $type = $_POST['type'];
        $totalUsedTime = $_POST['totalUsedTime'];
        $producedYear = $_POST['producedYear'];
        $description = $_POST['description'];
        $lastUserUsed = $_POST['lastUserUsed'];
        $currentRoom = $_POST['currentRoom'];
        $availableTime = $_POST['availableTime'];

        $sql = "INSERT INTO equipment (equipment, type, totalUsedTime, producedYear, description, lastUserUsed, currentRoom, availableTime) VALUES (:equipment, :type, :totalUsedTime, :producedYear, :description, :lastUserUsed, :currentRoom, :availableTime)";
        $query = Query::executeQuery($dbh, $sql, [
            'equipment' => $equipment,
            'type' => $type,
            'totalUsedTime' => $totalUsedTime,
            'producedYear' => $producedYear,
            'description' => $description,
            'lastUserUsed' => $lastUserUsed,
            'currentRoom' => $currentRoom,
            'availableTime' => $availableTime
        ]);

        if ($query->rowCount() > 0) {
            echo "<script>alert('Equipment added successfully');</script>";
            echo "<script>window.location.href = 'manage-equipment.php'</script>";
        } else {
            echo "<script>alert('Failed to add equipment');</script>";
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>Student Study Center Mananagement System | Add Equipment</title>
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <script>
        function checkEquipmentAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'equipment=' + $("#equipment").val(),
                type: "POST",
                success: function(data) {
                    $("#equipment-availability-status").html(data);
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
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">Add Equipment</h4>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Equipment</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name" required>
                                    <span id="equipment-availability-status"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Type</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="type" placeholder="Enter Equipment Type" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Total Used Time</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="totalUsedTime" placeholder="Enter Total Used Time" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Produced Year</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="producedYear" placeholder="Enter Produced Year" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <textarea class="form-control" name="description" placeholder="Enter Equipment Description" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Last User Used</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="lastUserUsed" placeholder="Enter Last User Used" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Current Room</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="currentRoom" placeholder="Enter Current Room" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Available Time</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" name="availableTime" placeholder="Enter Equipment Available Time" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit">Add Equipment</button>
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
