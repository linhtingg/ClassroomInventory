<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // Code for deleting request from list
    if (isset($_GET['delid'])) {
        $formid = intval($_GET['delid']);
<<<<<<< Updated upstream

        $query = $dbh->prepare("SELECT formid FROM roomregisterform WHERE formid=:formid and approved != 1");
        $query->bindParam(':formid', $formid, PDO::PARAM_STR);
        $query->execute();
=======
        $query = Query::execute("SELECT formid FROM roomregisterform WHERE formid=? and approved =1", [$formid]);
>>>>>>> Stashed changes
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            echo '<script>alert("Can not delete! The request has already been approve!")</script>';
        } else {
            $sql = "delete from roomregisterform where formid=:formid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':formid', $formid, PDO::PARAM_STR);
            $query->execute();
            echo "<script>alert('Request deleted');</script>";
            echo "<script>window.location.href = 'view-rooms-form.php'</script>";
        }
    }

?>
    <!doctype html>
    <html lang="en">

    <head>

        <title>View list of rooms</title>

        <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="../plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">List of rooms</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Purpose</th>
                                        <th>How many room</th>
                                        <th>How many people</th>
                                        <th>Borrow Day</th>
                                        <th>Borrow Time</th>
                                        <th>Approved</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $aid = $_SESSION['sscmsaid'];
                                    $sql = "SELECT * from `roomregisterform` where `userID` = :aid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {               ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->userID); ?></td>
                                                <td><?php echo htmlentities($row->purpose); ?></td>
                                                <td><?php echo htmlentities($row->numberOfRoom); ?></td>
                                                <td><?php echo htmlentities($row->numberOfPeople); ?></td>
                                                <td><?php echo htmlentities($row->borrowDay); ?></td>
                                                <td><?php echo htmlentities($row->borrowTime); ?></td>
                                                <td><?php $approved = $row->approved;
<<<<<<< Updated upstream
                                                    if ($approved === false) { echo "<span style='color:red'>Decline</span>";}
                                                    elseif ($approved === true ) { echo "<span style='color: green'>Approve</span>";}
                                                    else { echo "<span style='color:gray'>In process</span>";}
=======
                                                    if ($approved == null) {
                                                        echo "<span style='color:gray'>In process</span>";
                                                    } elseif ($approved == 1) {
                                                        echo "<span style='color:green'>Approve</span>";
                                                    } else {
                                                        echo "<span style='color:red'>Decline</span>";
                                                    }
>>>>>>> Stashed changes
                                                    ?></td>
                                                <td><?php $reply = $row->reply;
                                                    if ($reply == 1) { echo "<span style='color:red'>Decline</span>";}
                                                    elseif ($reply === null) { echo "<span style='color: gray'>In process</span>";}
                                                    else { echo htmlentities($row->reply);}
                                                    ?></td>
                                                <td> <a href="view-rooms-form.php? delid= <?php echo ($row->formid);?>" onclick="return confirm('Do you really want to delete ?');" class="btn btn-danger"/>Delete</a>
                                                </td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>

                                </tbody>
                            </table>

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
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- Required datatable js -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="../plugins/datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="../plugins/datatables/dataTables.select.min.js"></script>

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