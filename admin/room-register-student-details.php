<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // Assign Room Code   
    if (isset($_POST['submit'])) {
        $query = Query::executeQuery(
            $dbh,
            "UPDATE roomregisterform SET  reply = :roomID where formid=:id",
            [
                ['roomID', $_POST['roomID']],
                [':id', intval($_GET['stdid'])]
            ]
        );
        echo '<script>alert("Room has been assigned.")</script>';
        echo "<script>window.location.href ='manage-room-register-students.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Room Registered Form Details</title>
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
                            <?php
                            $sql = "SELECT * FROM roomregisterform INNER JOIN tbluser ON roomregisterform.userID=tbluser.schoolID WHERE formid=:formID;";
                            $query = Query::executeQuery($dbh, $sql, [[':formID', intval($_GET['stdid'])]]);
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) { ?>
                                    <h3 class="m-t-0 header-title"> Room Registered Form Details of #<?php echo htmlentities($row->formid); ?></h3>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <tr>
                                            <th>School ID</th>
                                            <td><?php echo htmlentities($row->userID); ?></td>
                                            <th>Name</th>
                                            <td><?php echo htmlentities($row->fullName); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact No</th>
                                            <td><?php echo htmlentities($row->phonenumber); ?></td>
                                            <th>Email Id</th>
                                            <td><?php echo htmlentities($row->email); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Number of room</th>
                                            <td><?php echo htmlentities($row->numberOfRoom); ?></td>
                                            <th>Number of people</th>
                                            <td><?php echo htmlentities($row->numberOfPeople); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Borrow time</th>
                                            <td><?php echo htmlentities($row->borrowTime); ?></td>
                                            <th>Borrow day</th>
                                            <td><?php echo htmlentities($row->borrowDay); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Purpose</th>
                                            <td><?php echo htmlentities($row->purpose); ?></td>
                                        </tr>
                                    </table>
                            <?php }
                            } ?>
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#assignRoom">Assign Room</button>
                            <a onclick="return confirm('Do you really want to reject?');" class="btn btn-danger" href="./manage-room-register-students.php?rejectForm=<?php echo ($row->formid); ?>">Reject</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('../helper/footer.php'); ?>
        </div>
        <form method="post">
            <div id="assignRoom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Assign Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-16">Room</h5>
                            <p><select class="form-control" name="roomID" required>
                                    <option value="">Select</option>
                                    <?php
                                    $sql = "SELECT * from room where usability=1 and capacity > :capacity";
                                    $query = Query::executeQuery($dbh, $sql, [[':capacity', $row->numberOfPeople]]);
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) { ?>
                                        <option value="<?php echo htmlentities($row->id); ?>"><?php echo htmlentities($row->id); ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                            <h5 class="font-16">Remark</h5>
                            <p><textarea class="form-control" placeholder="Remark" required="true" name="remark" required></textarea></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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