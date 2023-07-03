<?php
session_start();
error_reporting(0);
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['delid'])) {
        $roomID = $_GET['delid'];
        $query = Query::executeQuery("SELECT * FROM room WHERE id=:roomID", [[':roomID', $roomID]]);
        if ($query->rowCount() == 0) {
            echo '<script>alert("Room ' . $roomID . ' does not existed!")</script>';
        } else {
            Query::executeQuery("DELETE FROM room WHERE id= :roomID", [[':roomID', $roomID]]);
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href = 'manage-rooms.php'</script>";
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Manage Rooms</title>

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
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Manage Rooms</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#filterName">Filter room name </button>
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#filterUsability">Filter room's usability </button>
                            <p></p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Avaiable Time </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $bindParams = [];
                                    $sql = "SELECT * from room where id!='1'";
                                    if (isset($_GET['room'])) {
                                        $sql = $sql . " and id = :room";
                                        array_push($bindParams, [':room', $_GET['room']]);
                                    }
                                    if (isset($_GET['usability'])) {
                                        $sql = $sql . " and usability = :usability";
                                        array_push($bindParams, [':usability', $_GET['usability']]);
                                    }
                                    $query = Query::executeQuery($sql, $bindParams);
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->id); ?></td>
                                                <td><?php echo htmlentities($row->capacity); ?></td>
                                                <td><?php $roomUsability = $row->usability;
                                                    if ($roomUsability == 0) echo "Not Available";
                                                    else echo "Available"; ?></td>
                                                <td><?php echo htmlentities($row->description); ?></td>
                                                <td><?php echo htmlentities($row->avaiableTime); ?></td>
                                                <td>
                                                    <a href="edit-room.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-rooms.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
                                                </td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('../helper/footer.php'); ?>
        </div>
        <form method="get">
            <div id="filterName" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Filter Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-16">Room</h5>
                            <p><textarea class="form-control" placeholder="Room ID" required="true" name="room" required></textarea></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form method="get">
            <div id="filterUsability" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Filter Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-16">Usability</h5>
                            <select class="form-control" name="usability" required>
                                <option style="color: green;" value="1">Available</option>
                                <option style="color: red;" value="0">Not Available</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Filter</button>
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