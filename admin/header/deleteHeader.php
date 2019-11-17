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
                Edit header data
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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <?php
                    // Classes are called
                    use Codecourse\Repositories\Header as Header;
                    use Codecourse\Repositories\Session as Session;

                    $header = new Header();
                    $tableHeader = 'tbl_header';
                    // Fetch single data from database to display
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];
                        $result = $header->destroyView($id, $tableHeader);
                    }
                    //Will display all the messages vlidation/insert/update/delete
                    Session::init();
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="processHeader.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control form-control-sm" value="<?= isset($result->title) ? $result->title : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="slogan">Slogan:</label>
                                    <input type="text" name="slogan" class="form-control form-control-sm" value="<?= isset($result->slogan) ? $result->slogan : ''; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="established">Established:</label>
                                            <input disabled class="form-control form-control-sm" value="<?= $helpers->dateFormat(isset($result->established) ? $result->established : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="established">Change Established Date:</label>
                                            <input type="datetime-local" name="established" id="" class="form-control form-control-sm" aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="photo"> Photo:</label>
                                    <input type="file" class="form-control form-control-sm" id="photo" name="photo">
                                </div>

                                <?php
                                if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                    ?>
                                    <input type="hidden" name="id" value="<?php echo $result->id; ?>">

                                    <input type="hidden" name="action" value="delete">

                                    <button type="submit" onclick="return confirm('Are you sure of deleting this data ?');" name="submit" value="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>

                                    <a href="headerIndex.php" class="btn btn-sm btn-warning"><i class="fa fa-fast-backward"></i>
                                        Header Index</a>
                                <?php
                                } else {
                                    ?>
                                    <a href="headerIndex.php" class="btn btn-sm btn-warning">
                                        <i class="fa fa-fast-backward"></i>Header Index</a>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <label for="photo">Photo:</label><br>
                            <?php if (empty($result->photo)) { ?>
                                <img src="../gallery/avatar/avatar.png" alt="Alternative Image" style="width:100%;height:250px;">
                            <?php } else { ?>
                                <img src="<?php echo $result->photo; ?>" class="img-thumbnail" style="width:100%;height:258px;" alt="Product Photo">
                            <?php } ?>
                        </div>
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
