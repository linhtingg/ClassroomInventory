<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['did'])) {
        $oldRoomID = $_GET['did'];
        if (isset($_POST['submit'])) {
            // READ DATA
            $roomname = $_POST['roomname'];
            // TODO: CHECK ROOM HAVE ANY REPORT FORMS
            // CHECK ROOM USING ANY EQUIPMENT
            $query = Query::executeQuery($dbh, "SELECT * FROM `equipment` WHERE currentRoom = :oldRoomID", [':oldRoomID', $oldRoomID]);
            if ($query->rowCount() == 0) {
                //  CHECK NEW ROOM ID EXISTS
                $row = Query::executeQuery($dbh, "SELECT * FROM `room` WHERE id=:roomname", [':roomname', $roomname])->rowCount();
                if ($row == 0 || $oldRoomID == $roomname) {
                    // IF NOT, UPDATE
                    Query::executeQuery(
                        $dbh,
                        "UPDATE room SET id =:roomname, capacity=:capacity, usability=:usability, description=:description, avaiableTime=:availableTime WHERE id=:oldRoomID",
                        [':roomname', $roomname],
                        [':capacity', $_POST['capacity']],
                        [':usability', $_POST['usability']],
                        [':description', $_POST['description']],
                        [':availableTime', $_POST['times']],
                        [':oldRoomID', $oldRoomID]
                    );
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
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Edit Room</h4>
                            <?php
                            $results = Query::executeQuery($dbh, 'SELECT * from room where id = :room', [':room', $_GET['did']])->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) { ?>
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
                            <?php }
                            ?>
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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html><?php }  ?>