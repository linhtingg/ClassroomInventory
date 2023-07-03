<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $aid = $_POST['userID'];
        $roomID = $_POST['roomID'];
        $desribeCondition = $_POST['desribeCondition'];

        $sql = "INSERT INTO `reportform` ( `roomID`, `userReportID`, `desribeCondition`) VALUES ( :roomID, :aid, :desribeCondition)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aid', $aid, PDO::PARAM_STR);
        $query->bindParam(':roomID', $roomID, PDO::PARAM_STR);
        $query->bindParam(':desribeCondition', $desribeCondition, PDO::PARAM_STR);
        $query->execute();

        $LastInsertId = $query->rowCount();
        if ($LastInsertId > 0) {
            echo '<script>alert("Report successfully")</script>';
            echo "<script>window.location.href ='dashboard.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Report a problem </title>

        <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="../plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Switchery css -->
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />

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
                            <h3> Report a problem</h3>
                            <span> What have you encountered? Please elaborate, we will try to fix them as soon as possible! </span>
                            <div class="card-body card-block">
                                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">User ID <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input readonly type="text" class="form-control" required="true" name="userID" value="<?php echo $_SESSION['sscmsaid']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Report date <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input readonly type="text" class="form-control" required="true" name="reportDate" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                                                                        echo date('d-m-Y h:i:s'); ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Room <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" class="form-control" list="room_id" required="true" name="roomID" placeholder="In which room did the problem occur?">
                                            <datalist id="room_id">
                                                <?php
                                                $sql0 = "SELECT id FROM room where id != 1";
                                                $query0 = $dbh->prepare($sql0);
                                                $query0->execute();
                                                $results = $query0->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $result) {
                                                    echo "<option value= $result->id </option>";
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Descibe the problem<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" class="form-control" required="true" name="desribeCondition">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <p style="text-align: center;"><button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit
                                            </button></p>
                                    </div>
                                </form>
                            </div>
                            <?php include_once('../helper/footer.php'); ?>
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
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            });
        </script>

    </body>

    </html><?php }  ?>