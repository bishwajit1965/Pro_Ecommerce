<?php include_once '../partials/_head.php'; ?>
<!-- Site wrapper -->
<div class="wrapper">
    <?php include_once '../partials/_header.php'; ?>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <?php include_once '../partials/_leftSidebar.php'; ?>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit users data
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Title</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"> <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->

                    <div class="col-sm-8 col-md-offset-2">
                        <?php
                        use Codecourse\Repositories\UserRole as UserRole;

$role = new UserRole();
                        // Fetch single data from database to display
                        if (isset($_GET['edit_id'])) {
                            $id = $_GET['edit_id'];
                            $result = $role->updateView($id);
                        }

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['btn-update'])) {
                                $id = $_POST['userID'];
                                $firstName = $_POST['firstName'];
                                $lastName = $_POST['lastName'];
                                $userEmail = $_POST['userEmail'];


                                $fields = [
                                    'firstName' => $firstName,
                                    'lastName' => $lastName,
                                    'userEmail' => $userEmail
                                ];

                                // Will update database
                                $role->update($fields, $id);
                            }
                        }
                        ?>

                        <form method="post">

                            <input type="hidden" name="userID" class="form-control"
                                value="<?php echo $result->userID; ?>">

                            <div class="form-group">
                                <label for="firstName"> First name:</label>
                                <input type="text" name="firstName" class="form-control" class="form-control"
                                    value="<?php echo $result->firstName; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName"> Last name:</label>
                                <input type="text" name="lastName" class="form-control"
                                    value="<?php echo $result->lastName; ?>">
                            </div>
                            <div class="form-group">
                                <label for="firstName"> Email:</label>
                                <input type="email" name="userEmail" class="form-control" class="form-control"
                                    value="<?php echo $result->userEmail; ?>">
                            </div>

                            <?php
                            if ($_SESSION['userEmail'] == $role->getEmail()) {
                                ?>
                            <button type="submit" name="btn-update" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i> Update</button>

                            <a href="userIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Profile Index</a>
                            <?php
                            } else {
                                ?>
                            <a href="userIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Profile Index</a>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                    <!-- Code above -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">Footer</div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once '../partials/_footer.php'; ?>
</div>
<!-- ./wr apper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>