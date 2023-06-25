<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // Assign Room Code   
    if (isset($_POST['submit'])) {
        $formID = intval($_GET['stdid']);
        $roomID = $_POST['roomID'];
        // echo "<script>alert('$sid')</script>";
        // echo "<script>alert('$roomID')</script>";
        $sql = "UPDATE roomregisterform SET  reply = :roomID where formid=:id;";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $formID, PDO::PARAM_STR);
        $query->bindParam(':roomID', $roomID, PDO::PARAM_STR);
        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        echo '<script>alert("Room has been assigned.")</script>';
        echo "<script>window.location.href ='manage-room-register-students.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Student Study Center Mananagement System | Room Registered Form Details</title>
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
                            <?php $sid = intval($_GET['formID']);
                            $sql = "SELECT * FROM equipmentregisterform INNER JOIN tbluser ON equipmentregisterform.userID=tbluser.schoolID WHERE formid='$sid';";
                            $query = $dbh->prepare($sql);
                            $runResult = $query->execute();
                            // if($runResult){
                            //     echo "<script>alert('".$query->rowCount()."')</script>";
                            // }else{
                            //     echo "<script>alert('FAIL')</script>";
                            // }
                            // PASS
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            // echo "<script>alert('".$query->rowCount()."')</script>";
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                            ?>
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
                                            <th>Equipment type</th>
                                            <td><?php echo htmlentities($row->equipType); ?></td>
                                            <th>Number of each</th>
                                            <td><?php echo htmlentities($row->numberOfEach); ?></td>
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
                                <?php }
                            } ?>
                                    </table>
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#assignEquipment">Assign Equipment</button>
                                    <a onclick="return confirm('Do you really want to reject?');" class="btn btn-danger" href="./manage-equipment-register-students.php?rejectForm=<?php echo ($row->formid); ?>">Reject</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
        <form method="post">
            <div id="assignEquipment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Assign Equipment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-16">Equipment</h5>
                            <p><select class="form-control" name="roomID" required>
                                    <option value="">Select</option>
                                    <?php
                                    $sql = "SELECT * from equipment where lastUserUsed is NULL and id!='1'";
                                    $query = $dbh->prepare($sql);
                                    $runResult = $query->execute();
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
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
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