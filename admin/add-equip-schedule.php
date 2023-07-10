<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $equipment = $_POST['equipmentID'];
        $rowCount = EquipmentController::getEquipmentByID($equipment)->rowCount();
        if ($rowCount != 0) {
            $sql = "INSERT INTO equipschedule VALUES (NULL,?,?,?)";
            $query = Query::execute(
                $sql,
                [
                    $_POST['occupiedTime'],
                    $_POST['occupiedDate'],
                    $_POST['equipmentID'],
                ]
            );
            Notification::echoToScreen('Added successfully');
        } else {
            Notification::echoToScreen("Equipment " . $equipment . " existed! Cannot add equipment!");
        }
        echo "<script>window.location.href = 'manage-equips-schedule.php'</script>";
    }
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Equipment Schedule</title>
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
                            <h4 class="m-t-0 header-title">Add Equipment Schedule</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Occupied Time</label>
                                    <div class="col-10">
                                        <select class="form-control" name="occupiedTime" required>
                                            <option>Morning</option>
                                            <option>Afternoon</option>
                                            <option>Evening</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Occupied Day</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date" id="occupiedDate" name="occupiedDate" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Equipment ID</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="equipmentID" placeholder="Enter Equipment ID" required>
                                        <span id="equipment-availability-status"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit">Add Equipment Schedule</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script>
            const userCheckbox = document.getElementById('userCheckbox');
            const userTextbox = document.getElementById('userText');

            userCheckbox.addEventListener('change', function() {
                userTextbox.disabled = this.checked;
                if (this.checked) userTextbox.value = '';
            });

            const roomCheckbox = document.getElementById('roomCheckbox');
            const roomTextbox = document.getElementById('roomText');

            roomCheckbox.addEventListener('change', function() {
                roomTextbox.disabled = this.checked;
                if (this.checked) roomTextbox.value = '';
            });
        </script>
    </body>

    </html>
<?php } ?>