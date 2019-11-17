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
                Add social media data
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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <?php
                    require_once '../app/start.php';

                    use Codecourse\Repositories\Session as Session;
                    ?>
                    <div class="col-sm-6 col-sm-offset-3">
                        <?php
                        // Will display all the messages vlidation/insert/update/delete
                        Session::init();
                        $message = Session::get('message');
                        if (!empty($message)) {
                            echo $message;
                            Session::set('message', null);
                        }
                        ?>
                        <form action="processSocialMedia.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="site_name"> Site Name:</label>
                                <input type="text" name="site_name" class="form-control form-control-sm" placeholder="Insert site name ....">
                            </div>

                            <input type="hidden" name="action" value="verify">

                            <button type="submit" name="submit" value="insert" class="btn btn-sm btn-primary">
                                <i class="fa fa-upload"></i> Insert social media data</button>

                            <a href="socialMediaIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Social media Index</a>
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
    <?php include_once '../partials/_footer.php '; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
