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
                Add header data
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

                    use Codecourse\Repositories\Header as Header;
                    use Codecourse\Repositories\Session as Session;

                    // Needed for inserting category id to products table
                    $header = new Header();

                    // Needed for fetching data from table
                    $tableHeader = 'tbl_header';
                    ?>
                    <div class="row">
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
                            <form action="processHeader.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control form-control-sm" placeholder="Insert title of web page....">
                                </div>
                                <div class="form-group">
                                    <label for="slogan">Slogan:</label>
                                    <input type="text" name="slogan" class="form-control form-control-sm" placeholder="Insert slogan of the web page....">
                                </div>
                                <div class="form-group">
                                    <label for="established">Established:</label>
                                    <input type="datetime-local" name="established" id="" class="form-control form-control-sm" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="photo"> Photo:</label>
                                    <input type="file" class="form-control form-control-sm" id="photo" name="photo">
                                </div>
                                <input type="hidden" name="action" value="verify">
                                <button type="submit" name="submit" value="insert" class="btn btn-sm btn-primary">
                                    <i class="fa fa-upload"></i> Insert Header</button>

                                <a href="headerIndex.php" class="btn btn-sm btn-warning">
                                    <i class="fa fa-fast-backward"></i> Header Index</a>
                            </form>
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
    <?php include_once '../partials/_footer.php '; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
