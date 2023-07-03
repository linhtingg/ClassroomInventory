<?php
session_start();
error_reporting(0);
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $aid = $_POST['userID'];

        $purpose = $_POST['purpose'];
        $n_room = $_POST['howmanyroom'];
        $n_people = $_POST['howmanypeople'];
        $borrow_time = $_POST['borrow_time'];
        $borrow_day = $_POST['borrow_day'];

        $sql = "insert into `roomregisterform` (`userID`, `purpose`, `numberOfRoom`, `numberOfPeople`, `borrowTime`, `borrowDay`) VALUES (:aid,:purpose,:n_room,:n_people,:borrow_time,:borrow_day)";
        $query = Query::executeQuery($sql, [
            [':aid', $aid],
            [':purpose', $purpose],
            [':n_room', $n_room],
            [':n_people', $n_people],
            [':borrow_time', $borrow_time],
            [':borrow_day', $borrow_day]
        ]);

        $LastInsertId = $query->rowCount();
        if ($LastInsertId > 0) {
            echo '<script>alert("Form submitted successfully")</script>';
            echo "<script>window.location.href ='view-rooms-form.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Write room request</title>
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Fill in room register form</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title m-t-0">Room register form</h4>
                                    <div class="p-20">
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <label for="userID">User ID <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                                <input readonly type="text" class="form-control" required="true" name="userID" value="<?php echo $_SESSION['sscmsaid']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Phone number <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                                <input readonly type="text" class="form-control" required="true" name="phone" value="<?php echo $_SESSION['sscmsphone']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Purpose <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="What are you planning to do with the room" required="true" name="purpose">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Number of room <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="How many room do you need" required="true" name="howmanyroom">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Number of people <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="How many people will there be" required="true" name="howmanypeople">
                                            </div>
                                            <div class="form-group">
                                                <label for="borrow_time">Borrow time <span class="text-danger">*</span></label>
                                                <input class="form-control" list="borrow_times" required="true" name="borrow_time">
                                                <datalist id="borrow_times">
                                                    <option value="Morning">
                                                    <option value="Afternoon">
                                                    <option value="Evening">
                                                </datalist>
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Borrow day <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" required="true" name="borrow_day">
                                            </div>
                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

    </html><?php }  ?>