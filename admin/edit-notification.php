<?php
session_start();
error_reporting(0);
include('../helper/dbconnection.php');
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['did'])) {
        if (isset($_POST['submit'])) {
            Query::executeQuery(
                $dbh,
                "UPDATE notification SET notiContent = :content,valid_til=:lastDay WHERE id = :id",
                [':content', $_POST['content']],
                [':lastDay', $_POST['date']],
                [':id', $_GET['did']]
            );
            echo "<script>alert('Notification updated successfully!');</script>";
            echo "<script>window.location.href = 'manage-notifications.php'</script>";
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Edit Notification</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Edit Notification</h4>
                            <?php
                            $results = Query::executeQuery($dbh, "SELECT * from notification where id = :room", [':room', $_GET['did']])->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) { ?>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Content</label>
                                        <div class="col-10">
                                            <textarea class="form-control" name="content" required="true"><?php echo htmlentities($row->notiContent); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Expired Date</label>
                                        <div class="col-10">
                                            <input value="<?php echo htmlentities($row->valid_til) ?>" class="form-control" type="date" id="date" name="date" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-10 offset-2">
                                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>

    </html><?php }  ?>