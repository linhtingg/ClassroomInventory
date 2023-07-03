<?php
session_start();
error_reporting(0);
include('../helper/QueryHandler.php');
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $sql = "update tbluser set phonenumber=:mobilenumber,email=:email where schoolID=:aid";
        Query::executeQuery($sql,[
            [':email', $_POST['email']],
            [':mobilenumber', $_POST['mobilenumber']],
            [':aid', $_SESSION['sscmsaid']]
        ]);
        echo '<script>alert("Your profile has been updated")</script>';
        echo "<script>window.location.href ='profile.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Profile</title>

        <!-- Switchery css -->
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title m-t-0">User Profile</h4>
                                    <div class="p-20">
                                        <form action="#" method="post">
                                            <?php
                                            $sql = "SELECT * from tbluser where schoolID = :id";
                                            $query = Query::executeQuery($sql, [[':id', $_SESSION['sscmsaid']]]);
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) { ?>
                                                    <div class="form-group">
                                                        <label for="emailAddress">User Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="username" value="<?php echo $row->fullName; ?>" class="form-control" readonly="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass1">Contact Number<span class="text-danger">*</span></label>
                                                        <input type="text" name="mobilenumber" value="<?php echo $row->phonenumber; ?>" class="form-control" maxlength='10' required='true' pattern="[0-9]+">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passWord2">Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" value="<?php echo $row->email; ?>" class="form-control" required='true'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passWord2">School ID <span class="text-danger"></span></label>
                                                        <input type="text" name="" value="<?php echo $row->schoolID; ?>" readonly="" class="form-control">
                                                    </div>
                                            <?php }
                                            } ?>
                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
                                                    Submit
                                                </button>
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