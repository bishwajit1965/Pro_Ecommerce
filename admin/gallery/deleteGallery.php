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
                Delete photo to gallery
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
                    <div class="col-sm-8 col-sm-offset-2">
                    <!-- Code below -->
                        <?php
                        use Codecourse\Repositories\Gallery as Gallery;

                        $gallery = new Gallery();

                        $table = 'tbl_gallery';
                        if (isset($_GET['delete_id'])) {
                            $id = $_GET['delete_id'];
                            $result = $gallery->destroyView($id, $table);
                        }
                        // Will destroy data from gallery table
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['btn-delete'])) {
                                $id = $_GET['delete_id'];
                                $gallery->destroy($id, $table);
                            }
                        }
                        ?>
                        <!-- Confirmation alert to delete -->
                        <div class="alert alert-danger alert-dismissible " role="alert">
                            <span>Are you sure of deleting this data ? Once deleted it will be lost for ever !!!</span>
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <!-- Delete view of gallery data -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-7">
                                    <input type="hidden" name="id" class="form-control"
                                        value="<?php echo $result->id; ?>">

                                    <div class="form-group">
                                        <label for="name"> Name:</label>
                                        <input type="text" name="name" class="form-control" class="form-control"
                                            value="<?php echo $result->name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="photo"> Photo:</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Description:</label>
                                        <input type="text" name="description" class="form-control"
                                            value="<?php echo $result->description; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="name"> Photo</label>
                                        <?php
                                        if (empty($result->photo)) {
                                            ?>
                                        <img src="avatar/avatar.png" alt="Alternative Image"
                                            style="height:183px;width:100%;">
                                        <?php
                                        } else {
                                            ?>
                                        <img src="<?php echo $result->photo; ?>"
                                            class="img-fluid img-thumbnail" alt="Gallery photo"
                                            style="height:183px;width:100%;">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                ?>
                            <button type="submit" name="btn-delete" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Destroy</button>
                            <a href="galleryIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Gallery Index</a>
                            <?php
                            } else {
                                ?>
                            <a href="galleryIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Gallery Index</a>
                            <?php
                            }
                            ?>
                        </form>
                    <!-- Code above -->
                        </div>
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
