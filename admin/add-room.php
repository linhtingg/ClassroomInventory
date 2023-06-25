<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $dno = $_POST['roomID'];
        $lcsocket = isset($_POST['laptopchargersocket']) ? $_POST['laptopchargersocket'] : '';

        $query = $dbh->prepare("SELECT id FROM room WHERE roomID=:dno");
        $query->bindParam(':dno', $dno, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            echo '<script>alert("Room ID already exists. Please try with another room ID.")</script>';
        } else {
            $sql = "INSERT INTO room (roomID, laptopChargerSocket) VALUES (:dno, :lcsocket)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':dno', $dno, PDO::PARAM_STR);
            $query->bindParam(':lcsocket', $lcsocket, PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId > 0) {
                echo '<script>alert("Room has been added.")</script>';
                echo "<script>window.location.href ='manage-rooms.php'</script>";
            } else {
                echo '<script>alert("Something went wrong. Please try again.")</script>';
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Student Study Center Management System | Add Room</title>
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function checkRoomAvailability() {
            $("#loaderIcon").show();
            $.ajax({
                url: "check_availability.php",
                data: 'dno=' + $("#roomID").val(),
                type: "POST",
                success: function(data) {
                    $("#room-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <div class="wrapper">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add Room</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="header-title m-t-0">Add Room</h4>
                                <div class="p-20">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label for="userName">Room ID<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Room ID" required="true" name="roomID" id="roomID" onBlur="checkRoomAvailability()">
                                            <span id="room-availability-status"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Laptop / Charger Socket<span class="text-danger"></span></label>
                                            <input type="checkbox" value="Yes" name="laptopchargersocket">
                                        </div>
                                        <div class="form-group text-left m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container -->
        <?php include_once('includes/footer.php'); ?>
    </div> <!-- End wrapper -->
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

</html><?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // Code for deleting product from cart
    if (isset($_GET['delid'])) {
        $roomID = intval($_GET['delid']);

        $query = $dbh->prepare("SELECT id FROM room WHERE id=:roomID and isOccupied is not null");
        $query->bindParam(':roomID', $roomID, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            echo '<script>alert("Room occupied cannot  deleted")</script>';
        } else {

            $sql = "delete from room where id=:roomID";
            $query = $dbh->prepare($sql);
            $query->bindParam(':roomID', $roomID, PDO::PARAM_STR);
            $query->execute();
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href = 'manage-rooms.php'</script>";
        }
    }

?>
    <!doctype html>
    <html lang="en">

    <head>

        <title>Student Study Center Mananagement System | Manage Rooms</title>

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
                            <h4 class="m-t-0 header-title">Manage Rooms</h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room ID</th>
                                        <th>Laptop / Charger Socket</th>
                                        <th>Satus</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php

                                    $sql = "SELECT * from room ";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {               ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->roomID); ?></td>
                                                <td><?php $lapchargerscoket = $row->laptopChargerScoket;
                                                    if ($lapchargerscoket == '') : echo "Not Available";
                                                    else : echo "Available";
                                                    endif; ?></td>

                                                <td><?php $occupiedstatus = $row->isOccupied;
                                                    if ($occupiedstatus == '') : echo "Available";
                                                    else : echo "Occupied";
                                                    endif; ?></td>
                                                <td><?php echo htmlentities($row->postingDate); ?></td>
                                                <td><a href="edit-room.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-rooms.php?delid=<?php echo $row->id; ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>

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
