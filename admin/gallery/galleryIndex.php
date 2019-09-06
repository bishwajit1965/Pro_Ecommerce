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
                    <h3 class="box-title"><a class="btn btn-sm btn-primary" href="addGallery.php">
                            <i class="fa fa-plus"></i> Add data to Gallery</a> </h3>
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
                    if (isset($_GET['uploaded']) && isset($_GET['uploaded']) == 1) {
                        echo '<div class="alert alert-success alert-dismissible " role="alert">
                        <strong> WOW !</strong> Gallery data has been updated successfully !!!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    if (isset($_GET['updated']) && isset($_GET['updated']) == 1) {
                        echo '<div class="alert alert-success alert-dismissible " role="alert">
                        <strong> SUCCESSFUL !</strong>  Gallery data has been updated successfully!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    if (isset($_GET['deleted']) && isset($_GET['deleted']) == 1) {
                        echo '<div class="alert alert-warning alert-dismissible " role="alert">
                        <strong> SUCCESSFUL !</strong>  Gallery data has been deleted successfully!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    ?>
                    <?php
                    use Codecourse\Repositories\Gallery as Gallery;
                    use Codecourse\Repositories\Helpers as Helper;

                    $gallery = new Gallery();
                    $helper = new Helper;
                    $table = 'tbl_gallery';
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];
                        $gallery->destroy($id, $table);
                    }
                    ?>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $galleryRows = $gallery->index($table);
                            if (!empty($galleryRows)) {
                                $id = 1;
                                foreach ($galleryRows as $result) {
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
                                    <img src="avatar/avatar.png" alt="Alternative Image"
                                        style="width:130px;height:80px;">
                                    <?php
                                    } else {
                                        ?>
                                    <img src="<?php echo $result->photo; ?>"
                                        class="img-thumbnail" style="width:130px;height:80px;" alt="Gallery Photo">
                                    <?php
                                    } ?>
                                </td>
                                <td><?php echo $result->description; ?>
                                </td>
                                <td><?php echo $helper->dateFormat($result->created_at); ?>
                                </td>
                                <td>
                                    <?php
                                    if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                        ?>

                                    <a class="btn btn-xs btn-primary"
                                        href="editGallery.php?edit_id=<?php echo $result->id; ?>"><i
                                            class="fa fa-pencil"></i> Edit</a>

                                    <a class="btn btn-xs btn-danger"
                                        href="galleryIndex.php?delete_id=<?php echo $result->id; ?>"
                                        onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');">
                                        <i class="fa fa-trash"></i> Delete</a>
                                    <a class="btn btn-xs btn-danger"
                                        href="deleteGallery.php?delete_id=<?php echo $result->id; ?>">
                                        <i class="fa fa-trash"></i> View & Delete</a>
                                    <?php
                                    } else {
                                        ?>
                                    <a class="btn btn-xs btn-primary"
                                        href="editGallery.php?edit_id=<?php echo $result->id; ?>"><i
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
                                <th>Description</th>
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
