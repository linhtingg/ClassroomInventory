<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('./QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['did'])) {
        $oldRoomID = $_GET['did'];
        if (isset($_POST['submit'])) {
            // READ DATA
            $roomname = $_POST['roomname'];
            $capacity = $_POST['capacity'];
            $usability = $_POST['usability'];
            $description = $_POST['description'];
            $availableTime = $_POST['times'];
            // CHECK ROOM USING ANY EQUIPMENT
            $sql = "SELECT * FROM `equipment` WHERE currentRoom = :oldRoomID";
            $query = $dbh->prepare($sql);
            $query->bindParam(':oldRoomID', $oldRoomID, PDO::PARAM_STR);
            $query->execute();
            $row = $query->rowCount();
            if ($row == 0) {
                //  CHECK NEW ROOM ID EXISTS
                $sql = "SELECT * FROM `room` WHERE id=:roomname;";
                $query = $dbh->prepare($sql);
                $query->bindParam(':roomname', $roomname, PDO::PARAM_STR);
                $query->execute();
                $row = $query->rowCount();
                if ($row == 0 || $oldRoomID == $roomname) {
                    // IF NOT, UPDATE
                    $sql = "UPDATE room SET id =:roomname, capacity=:capacity, usability=:usability, description=:description, avaiableTime=:availableTime WHERE id=:oldRoomID";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':roomname', $roomname, PDO::PARAM_STR);
                    $query->bindParam(':capacity', $capacity, PDO::PARAM_STR);
                    $query->bindParam(':usability', $usability, PDO::PARAM_STR);
                    $query->bindParam(':description', $description, PDO::PARAM_STR);
                    $query->bindParam(':availableTime', $availableTime, PDO::PARAM_STR);
                    $query->bindParam(':oldRoomID', $oldRoomID, PDO::PARAM_STR);
                    $query->execute();
                    echo "<script>alert('Room updated successfully!');</script>";
                } else {
                    echo "<script>alert('Room " . $roomname . " existed! Cannot update room!');</script>";
                }
            } else {
                echo "<script>alert('Cannot update room!');</script>";
            }
            echo "<script>window.location.href = 'manage-rooms.php'</script>";
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Edit Room</title>

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
                            <h4 class="m-t-0 header-title">Edit Room</h4>
                            <?php
                            $roomID = $_GET['did'];
                            $sql = "SELECT * from room where id = '$roomID'";
                            $query = Query::executeQuery($dbh, $sql);
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) { ?>
                                    <!--  -->
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Room Name</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="roomname" value="<?php echo htmlentities($row->id); ?>" required="true">
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
                                                <select class="form-control" name="usability" required="true">
                                                    <option value="0" <?php if ($row->usability == 0) echo 'selected="selected"'; ?>>Not Available</option>
                                                    <option value="1" <?php if ($row->usability == 1) echo 'selected="selected"'; ?>>Available</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Description</label>
                                            <div class="col-10">
                                                <textarea class="form-control" name="description" required="true"><?php echo htmlentities($row->description); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Available Time</label>
                                            <div class="col-10">
                                                <select class="form-control" name="times" required>
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
                                    <!--  -->
                            <?php }
                            } ?>
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

    </html><?php }  ?>