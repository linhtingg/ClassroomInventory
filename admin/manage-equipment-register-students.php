<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('./QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
   header('location:logout.php');
} else {
   // Code for deleting student details
   if (isset($_GET['rejectForm'])) {
      $formID = intval($_GET['rejectForm']);
      $sql = "UPDATE equipmentregisterform SET reply='1' where formid=:id;";
      $query = Query::executeQuery($dbh, $sql, [':id', $formID]);
      echo "<script>alert('Form rejected');</script>";
      echo "<script>window.location.href = 'manage-equipment-register-students.php'</script>";
   }
?>
   <!doctype html>
   <html lang="en">

   <head>
      <title>CIMS | Manage Equipments Registered Student Details</title>
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
                     <h4 class="m-t-0 header-title">Manage Equipments Registered Student Details</h4>
                     <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>User ID</th>
                              <th>Purpose</th>
                              <th>Equip Type</th>
                              <th>Number Of Each</th>
                              <th>Borrow Time</th>
                              <th>Borrow Day</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * from equipmentregisterform where reply is null";
                           $query = Query::executeQuery($dbh, $sql);
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           if ($query->rowCount() > 0) {
                              foreach ($results as $row) { ?>
                                 <tr>
                                    <td><?php echo htmlentities($row->formid); ?></td>
                                    <td><?php echo htmlentities($row->userID); ?></td>
                                    <td><?php echo htmlentities($row->purpose); ?></td>
                                    <td><?php echo htmlentities($row->equipType); ?></td>
                                    <td><?php echo htmlentities($row->numberOfEach); ?></td>
                                    <td><?php echo htmlentities($row->borrowTime); ?></td>
                                    <td><?php echo htmlentities($row->borrowDay); ?></td>
                                    <td><a href="equipment-register-student-details.php?formID=<?php echo htmlentities($row->formid); ?>" class="btn btn-primary">Assign / Unassign Equipment</a></td>
                                 </tr>
                           <?php }
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