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
        use Codecourse\Repositories\Brand as Brand;
        use Codecourse\Repositories\Helpers as Helper;
        use Codecourse\Repositories\Session as Session;
        use Codecourse\Repositories\Tester as Tester;

        $brand = new Brand();
        $helper = new Helper;
        $tester = new Tester();
        Session::init();
        $table = 'tbl_brand';
        $table1 = 'tbl_test';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Brand index page<small>it all starts here</small></h1>
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
                    <h3 class="box-title"><a class="btn btn-sm btn-primary" href="addBrand.php">
                            <i class="fa fa-plus"></i> Add brand data</a> <span class="label label-success">
                            Brands </span><sup><span class="label label-danger"><?php echo $brand->numberOfRows($table); ?></sup>
                        </span>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
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
                        $dataDestroyed = $brand->destroy($id, $table);
                        if ($dataDestroyed) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                            <strong> WOW !</strong> Data has been removed from database !!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'brandIndex.php';
                            $brand->redirect($home_url);
                        }
                    }

                    ?>
                    <?php
                    $indexData = $tester->index($table1);
                    if (!empty($indexData)) {
                        foreach ($indexData as $value) {
                            echo $value->id;
                            echo $value->name;
                            echo $value->address . '<br>';
                        }
                    }
                    ?>
                    <table id="example1" class="table table-bordered table-striped table-small">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Brand Name</th>
                                <th>Category Id</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $brandData = $brand->index($table);
                            if (!empty($brandData)) {
                                $id = 1;
                                foreach ($brandData as $result) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $id++; ?>
                                        </td>
                                        <td>
                                            <?php echo $result->brand_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $result->cat_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $helper->dateFormat($result->created_at); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                                ?>
                                                <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit Product!" href="editBrand.php?edit_id=<?php echo $result->brand_id; ?>"><i class="fa fa-pencil"></i> Edit</a>

                                                <a class="btn btn-xs btn-danger" href="brandIndex.php?delete_id=<?php echo $result->brand_id; ?>" onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');">
                                                    <i class="fa fa-trash"></i> Delete</a>

                                                <a class="btn btn-xs btn-danger" href="deleteBrand.php?delete_id=<?php echo $result->brand_id; ?>">
                                                    <i class="fa fa-trash"></i> View & Delete</a>
                                            <?php
                                            } else {
                                                ?>
                                                <a class="btn btn-xs btn-primary" href="editBrand.php?edit_id=<?php echo $result->brand_id; ?>"><i class="fa fa-eye"></i> View</a><?php
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
                                <th>Brand Name</th>
                                <th>Category Id</th>
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
