<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $equipment = $_POST['equipment'];
        $rowCount = Query::executeQuery("SELECT * FROM `equipment` WHERE id = :newID", [[':newID', $equipment]])->rowCount();
        if ($rowCount == 0) {
            $sql = "INSERT INTO equipment VALUES (:type, :id, :totalUsedTime,:producedYear , :description, :lastUserUsed, :currentRoom, :avaiableTimes, 1)";
            $query = Query::executeQuery(
                $sql,
                [
                    [':id', $equipment],
                    [':type', $_POST['type']],
                    [':totalUsedTime', $_POST['totalUsedTime']],
                    [':producedYear', $_POST['producedYear']],
                    [':description', $_POST['description']],
                    [':lastUserUsed', $_POST['lastUserUsed']],
                    [':currentRoom', $_POST['currentRoom']],
                    [':avaiableTimes', $_POST['avaiableTimes']]
                ]
            );
            if ($query->rowCount() > 0) {
                echo "<script>alert('Equipment added successfully');</script>";
                echo "<script>window.location.href = 'manage-equipments.php'</script>";
            } else {
                echo "<script>alert('Failed to add equipment');</script>";
            }
        } else {
            echo "<script>alert('Equipment " . $equipment . " existed! Cannot add equipment!');</script>";
            echo "<script>window.location.href = 'manage-equipments.php'</script>";
        }
    }
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Equipment</title>
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
                                        <select class="form-control" name="type" required>
                                            <option>Microphone</option>
                                            <option>Oscilloscope</option>
                                            <option>Biến áp</option>
                                            <option>Bảng mạch</option>
                                            <option>Đầu chuyển đổi</option>
                                        </select>
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
                                    <label class="col-2 col-form-label">Avaiable Time</label>
                                    <div class="col-10">
                                        <select class="form-control" name="avaiableTimes" multiple required>
                                            <option value="Morning">Morning</option>
                                            <option value="Afternoon">Afternoon</option>
                                            <option value="Evening">Evening</option>
                                        </select>
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
                </div>
            </div>
            <?php include_once('../helper/footer.php'); ?>
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

    </html>
<?php } ?>