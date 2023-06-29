<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('./QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['did'])) {
        $deskid = intval($_GET['did']);

        if (isset($_POST['submit'])) {
            $equipmentType = $_POST['equipmentType'];
            $equipment = $_POST['equipment'];
            $totalUsedTime = $_POST['totalUsedTime'];
            $producedYear = $_POST['producedYear'];
            $description = $_POST['description'];
            $lastUserUsed = $_POST['lastUserUsed'];
            $currentRoom = $_POST['currentRoom'];
            $availableTime = $_POST['availableTime'];

            $sql = "UPDATE equipment SET type=:equipmentType, id=:equipment, totalUsedTime=:totalUsedTime, producedYear=:producedYear, description=:description, lastUserUsed=:lastUserUsed, currentRoom=:currentRoom, avaiableTime=:availableTime WHERE id=:deskid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':equipmentType', $equipmentType, PDO::PARAM_STR);
            $query->bindParam(':equipment', $equipment, PDO::PARAM_STR);
            $query->bindParam(':totalUsedTime', $totalUsedTime, PDO::PARAM_STR);
            $query->bindParam(':producedYear', $producedYear, PDO::PARAM_STR);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->bindParam(':lastUserUsed', $lastUserUsed, PDO::PARAM_STR);
            $query->bindParam(':currentRoom', $currentRoom, PDO::PARAM_STR);
            $query->bindParam(':availableTime', $availableTime, PDO::PARAM_STR);
            $query->bindParam(':deskid', $deskid, PDO::PARAM_STR);
            $query->execute();

            echo "<script>alert('Data updated successfully');</script>";
            echo "<script>window.location.href = 'manage-equipments.php'</script>";
        }

        $sql = "SELECT * FROM equipment WHERE id=:deskid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':deskid', $deskid, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
    }

?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Student Study Center Mananagement System | Edit Equipment</title>

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
                <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">Edit Equipment</h4>
                        <form action="" method="post">
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Equipment Type</label>
                            <div class="col-10">
                                <input type="text" class="form-control" name="equipmentType" value="<?php echo htmlentities($result->type); ?>" required="true">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Equipment</label>
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
                                <input type="text" class="form-control" name="totalUsedTime" value="<?php echo htmlentities($result->totalUsedTime); ?>" required="true">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Produced Year</label>
                            <div class="col-10">
                                <input type="text" class="form-control" name="producedYear" value="<?php echo htmlentities($result->producedYear); ?>" required="true">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <textarea class="form-control" name="description" required="true"><?php echo htmlentities($result->description); ?></textarea>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Last User Used</label>
                            <div class="col-10">
                                <input type="text" class="form-control" name="lastUserUsed" value="<?php echo htmlentities($result->lastUserUsed); ?>" required="true">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Current Room</label>
                            <div class="col-10">
                                <input type="text" class="form-control" name="currentRoom" value="<?php echo htmlentities($result->currentRoom); ?>" required="true">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-2 col-form-label">Available Time</label>
                            <div class="col-10">
                                    <select class="form-control" name="type" required>
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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
    <?php } ?>
