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
        <?php
        // Class is instantiated
        use Codecourse\Repositories\Core as Core;
        use Codecourse\Repositories\Helpers as Helper;
        use Codecourse\Repositories\Session as Session;

        $core = new Core();
        $helper = new Helper;
        Session::init();
        $table = 'tbl_student';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Photo gallery index page<small>it all starts here</small></h1>
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
                    <h3 class="box-title"><a class="btn btn-sm btn-primary" href="addStudent.php">
                            <i class="fa fa-plus"></i> Add student data</a> <span class="label label-success">
                            Students </span><sup><span class="label label-danger"><?php echo $core->numberOfRows($table);?></sup>
                        </span>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <?php
                    // Will display all the messages vlidation/insert/update/delete
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    // Get the delete id
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];
                        $dataDestroyed = $core->destroy($id, $table);
                        if ($dataDestroyed) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                            <strong> WOW !</strong> Data has been removed from database !!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'studentIndex.php';
                            $core->redirect($home_url);
                        }
                    }

                    ?>

                    <table id="example1" class="table table-bordered table-striped table-small">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $studentData = $core->index($table);
                            if (!empty($studentData)) {
                                $id = 1;
                                foreach ($studentData as $result) {
                                    ?>
                            <tr>
                                <td><?php echo $id++; ?>
                                </td>
                                <td><?php echo $result->name; ?>
                                </td>
                                <td>
                                    <?php
                                    if (empty($result->photo)) {
                                        ?>
                                    <img src="../gallery/avatar/avatar.png" alt="Alternative Image"
                                        style="width:110px;height:80px;">
                                    <?php
                                    } else {
                                        ?>
                                    <img src="<?php echo $result->photo; ?>"
                                        class="img-thumbnail" style="width:110px;height:80px;" alt="Gallery Photo">
                                    <?php
                                    } ?>
                                </td>
                                <td><?php echo $result->email; ?>
                                <td><?php echo $result->address; ?>
                                <td><?php echo $result->phone; ?>
                                </td>
                                <td><?php echo $helper->dateFormat($result->created_at); ?>
                                </td>
                                <td>
                                    <?php
                                    if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                        ?>

                                    <a class="btn btn-xs btn-primary"
                                        href="editStudent.php?edit_id=<?php echo $result->id; ?>"><i
                                            class="fa fa-pencil"></i> Edit</a>

                                    <a class="btn btn-xs btn-danger"
                                        href="studentIndex.php?delete_id=<?php echo $result->id; ?>"
                                        onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');">
                                        <i class="fa fa-trash"></i> Delete</a>

                                    <a class="btn btn-xs btn-danger"
                                        href="deleteStudent.php?delete_id=<?php echo $result->id; ?>">
                                        <i class="fa fa-trash"></i> View & Delete</a>
                                    <?php
                                    } else {
                                        ?>
                                    <a class="btn btn-xs btn-primary"
                                        href="editStudent.php?edit_id=<?php echo $result->id; ?>"><i
                                            class="fa fa-eye"></i> View</a><?php
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
                                <th>Photo</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Created at</th>
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