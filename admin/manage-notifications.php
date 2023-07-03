<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
   header('location:logout.php');
} else {
   if (isset($_GET['delid'])) {
      $id = $_GET['delid'];
      $query = Query::executeQuery($dbh, "SELECT * FROM notification WHERE id= :id", [[':id', $id]]);
      if ($query->rowCount() == 0) {
         echo '<script>alert("Notification ID ' . $id . ' does not existed!")</script>';
      } else {
         Query::executeQuery($dbh, "DELETE FROM notification WHERE id= :id", [[':id', $id]]);
         echo "<script>alert('Notification deleted');</script>";
         echo "<script>window.location.href = 'manage-notifications.php'</script>";
      }
   }
?>
   <!doctype html>
   <html lang="en">

   <head>
      <title>CIMS | Manage Notifications</title>
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
                     <h4 class="m-t-0 header-title">Manage Notifications</h4>
                     <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Content</th>
                              <th>Expired</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $query = Query::executeQuery($dbh, "SELECT * from notification");
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           if ($query->rowCount() > 0) {
                              foreach ($results as $row) { ?>
                                 <tr>
                                    <td><?php echo htmlentities($row->id); ?></td>
                                    <td><?php echo htmlentities($row->notiContent); ?></td>
                                    <td><?php echo htmlentities($row->valid_til); ?></td>
                                    <td>
                                       <a href="edit-notification.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-notifications.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
                                    </td>
                                 </tr>
                           <?php }
                           } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <?php include_once('../helper/footer.php'); ?>
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