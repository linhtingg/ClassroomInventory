<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['did'])) {
        if (isset($_POST['submit'])) {
            $rowCount = Query::executeQuery($dbh, "SELECT * FROM `equipment` WHERE id=:oldID", [[':oldID', $newID]])->rowCount();
            if ($rowCount == 0 || $newID == $_GET['did']) {
                Query::executeQuery(
                    $dbh,
                    "UPDATE equipment SET type=:equipmentType, id=:equipment, totalUsedTime=:totalUsedTime, producedYear=:producedYear, description=:description, lastUserUsed=:lastUserUsed, currentRoom=:currentRoom, avaiableTime=:availableTime WHERE id=:oldID",
                    [
                        [':equipmentType', $_POST['type']],
                        [':equipment', $_POST['equipmentID']],
                        [':totalUsedTime', $_POST['totalUsedTime']],
                        [':producedYear', $_POST['producedYear']],
                        [':description', $_POST['description']],
                        [':lastUserUsed', $_POST['lastUserUsed']],
                        [':currentRoom', $_POST['currentRoom']],
                        [':availableTime', $_POST['availableTime']],
                        [':oldID', $_GET['did']]
                    ]
                );
                echo "<script>alert('Equipment updated successfully!');</script>";
            } else {
                echo "<script>alert('Equipment " . $newID . " existed! Cannot update equipment!');</script>";
            }
            echo "<script>window.location.href = 'manage-equipments.php'</script>";
        }
    }

?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Edit Equipment</title>

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
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Edit Equipment</h4>
                            <?php
                            $results = Query::executeQuery($dbh, "SELECT * from equipment where id = :room", [[':room', $_GET['did']]])->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) { ?>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Equipment Name</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="equipmentID" value="<?php echo htmlentities($row->id); ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Equipment Type</label>
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
                                            <input type="text" class="form-control" name="totalUsedTime" value="<?php echo htmlentities($row->totalUsedTime); ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Produced Year</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="producedYear" value="<?php echo htmlentities($row->producedYear); ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Description</label>
                                        <div class="col-10">
                                            <textarea class="form-control" name="description" required="true"><?php echo htmlentities($row->description); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Last User Used</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="lastUserUsed" value="<?php echo htmlentities($row->lastUserUsed); ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Current Room</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="currentRoom" value="<?php echo htmlentities($row->currentRoom); ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Available Time</label>
                                        <div class="col-10">
                                            <select class="form-control" name="availableTime" required>
                                                <option>Morning</option>
                                                <option>Afternoon</option>
                                                <option>Evening</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-8 offset-2">
                                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('../helper/footer.php'); ?>
        </div> <!-- End wrapper -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>