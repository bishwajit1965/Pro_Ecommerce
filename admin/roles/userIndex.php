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
            <h1>Users role index page<small>it all starts here</small></h1>
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
                    <?php
                    if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                        ?>
                    <a href="addUser.php" class="btb btn-sm btn-primary"><i class="glyphicon glyphicon-user"></i> Create
                        New User </a>
                    <?php
                    }
                    ?>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <?php
                    if (isset($_GET['pupdated']) && isset($_GET['pupdated']) == 1) {
                        echo '<div class="alert alert-success alert-dismissible " role="alert">
                        <strong> WOW !</strong> Profile data updated successfully with new selected photo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    if (isset($_GET['updated']) && isset($_GET['updated']) == 1) {
                        echo '<div class="alert alert-success alert-dismissible " role="alert">
                        <strong> WOW !</strong> Profile data updated successfully with existing photo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    if (isset($_GET['deleted']) && isset($_GET['deleted']) == 1) {
                        echo '<div class="alert alert-warning alert-dismissible " role="alert">
                        <strong> DELETED !</strong> Profile data deleted successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    ?>

                    <div class="table-responsive">
                        <table id="example1" class="table table-responsive table-striped table-condensed table-primary">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User role</th>
                                    <th>User status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                use Codecourse\Repositories\UserRole as UserRole;
                                use Codecourse\Repositories\User as User;

                                $user_home = new User();
                                $role = new UserRole();
                                if (isset($_GET['delete_id'])) {
                                    $id = $_GET['delete_id'];
                                    $role->destroy($id);
                                }


                                $userData = $role->index();

                                if (!empty($userData)) {
                                    $id = 1;
                                    foreach ($userData as $user) {
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $id++; ?>
                                    </td>
                                    <td>
                                        <?php echo $user->firstName. ' ' .$user->lastName; ?>
                                    </td>
                                    <td>
                                        <?php echo $user->userEmail; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($user->userRole == null) {
                                            echo 'Not assigned';
                                        } else {
                                            if ($user->userRole == 0) {
                                                echo 'Admin ' . ' = ' . $user->userRole;
                                            } elseif ($user->userRole == 1) {
                                                echo 'Editor ' . ' = ' . $user->userRole;
                                            } elseif ($user->userRole == 2) {
                                                echo 'Author ' . ' = ' . $user->userRole;
                                            }
                                        } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($user->userStatus == 'Y') {
                                            echo 'Active';
                                        } else {
                                            if ($user->userStatus == 'N') {
                                                echo 'Inctive';
                                            }
                                        } ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                            ?>
                                        <a class="btn btn-xs btn-primary"
                                            href="editUser.php?edit_id=<?php echo $user->userID; ?>"><i
                                                class="fa fa-pencil"></i> Edit</a>

                                        <a class="btn btn-xs btn-danger"
                                            href="?delete_id=<?php echo $user->userID; ?>"
                                            onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');">
                                            <i class="fa fa-trash"></i> Delete</a>
                                        <a class="btn btn-xs btn-primary"
                                            href="assignRole.php?role_id=<?php echo $user->userID; ?>"
                                            onClick="return confirm('Do you really want to assign role to this user ? Then click OK !!!');">
                                            <i class="fa fa-trash"></i> Assign Role</a>
                                        <?php
                                        } else {
                                            ?>
                                        <a class="btn btn-xs btn-primary"
                                            href="editUser.php?edit_id=<?php echo $user->userID; ?>">
                                            <i class="fa fa-eye"></i> View</a>
                                        <?php
                                        } ?>
                                    </td>
                                </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User role</th>
                                    <th>User status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfooter>
                        </table>
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
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>