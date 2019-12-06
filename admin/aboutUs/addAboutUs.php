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
                Add about us data
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
                            title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"> <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <div class="col-sm-10 col-sm-offset-1">
                        <?php

                        use Codecourse\Repositories\Session as Session;
                        use Codecourse\Repositories\AboutUs as AboutUs;

                        // Will display all the messages vlidation/insert/update/delete
                        $aboutUs = new AboutUs;
                        $table = 'tbl_about_us';
                        Session::init();
                        $message = Session::get('message');
                        if (!empty($message)) {
                            echo $message;
                            Session::set('message', null);
                        }
                        ?>

                        <form action="processAboutUs.php" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="brand_name">Phone:</label>
                                        <input type="text" name="phone" class="form-control form-control-sm"
                                            placeholder="Insert phone number....">
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_name">Email:</label>
                                        <input type="email" name="email" class="form-control form-control-sm"
                                            placeholder="Insert email address....">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="brand_name">Address:</label>
                                        <input type="text" name="address" id="" class="form-control form-control-sm"
                                            placeholder="Insert address...."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="brand_name">Url:</label>
                                        <input type="text" name="url" class="form-control form-control-sm"
                                            placeholder="Insert url...."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Description:</label>
                                <textarea name="description" id="editor1" cols="50" rows="5"
                                    placeholder="Insert description...."></textarea>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="action" value="verify">
                            </div>

                            <button type="submit" name="submit" value="insert_about_us" class="btn btn-sm btn-primary">
                                <i class="fa fa-upload"></i> Upload about us data</button>

                            <a href="aboutUsIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> About Us Index</a>
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