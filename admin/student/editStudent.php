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
                Edit student data
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
                    <div class="col-sm-8 col-sm-offset-2">
                        <?php
                        /**
                         * Classes are called
                         */
                        use Codecourse\Repositories\Core as Core;
                        use Codecourse\Repositories\Session as Session;

                        $core = new Core();
                        $table = 'tbl_student';

                        // Fetch single data from database to display
                        if (isset($_GET['edit_id'])) {
                            $id = $_GET['edit_id'];
                            $result = $core->updateView($id, $table);
                        }
                        /**
                         * Will display all the messages vlidation/insert/update/delete
                         */
                        Session::init();
                        $message = Session::get('message');
                        if (!empty($message)) {
                            echo $message;
                            Session::set('message', null);
                        }

                        ?>

                        <form action="ProcessStudent.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-7">
                                    <input type="hidden" name="id" class="form-control"
                                        value="<?php echo $result->id; ?>">

                                    <div class="form-group">
                                        <label for="name"> Name:</label>
                                        <input type="text" name="name" class="form-control" class="form-control"
                                            value="<?php echo isset($result->name) ? $result->name : '' ; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email"> Email:</label>
                                        <input type="text" name="email" class="form-control"
                                            value="<?php echo $result->email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="address"> Address:</label>
                                        <input type="text" name="address" class="form-control"
                                            value="<?php echo $result->address; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone"> Phone:</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="<?php echo $result->phone; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="name"> Photo</label>
                                        <?php
                                        if (isset($result->photo)) {
                                            ?>
                                        <img src="<?php echo $result->photo; ?>"
                                            class="img-fluid img-thumbnail" alt="Gallery photo"
                                            style="height:183px;width:100%;">
                                        <?php
                                        } else {
                                            ?>
                                        <img src="../gallery/avatar/avatar.png" alt="Alternative Image"
                                            style="height:183px;width:100%;">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo"> Select Photo:</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                ?>
                            <button type="submit" name="submit" value="update" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i> Update</button>

                            <input type="hidden" name="id"
                                value="<?php echo $result->id; ?>">

                            <input type="hidden" name="action" value="update">

                            <a href="studentIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Gallery Index</a>
                            <?php
                            } else {
                                ?>
                            <a href="studentIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Gallery Index</a>
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
