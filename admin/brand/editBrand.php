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
                Edit category data
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
                    <div class="col-sm-6 col-sm-offset-3">
                        <?php

                        // Classes are called
                        use Codecourse\Repositories\Category as Category;
                        use Codecourse\Repositories\Brand as Brand;
                        use Codecourse\Repositories\Session as Session;

                        $category = new Category();
                        $brand = new Brand();
                        $table = 'tbl_category';
                        $table1 = 'tbl_brand';

                        // Fetch single data from database to display
                        if (isset($_GET['edit_id'])) {
                            $id = $_GET['edit_id'];
                            $result = $brand->updateView($id, $table1);
                        }

                        //Will display all the messages vlidation/insert/update/delete
                        Session::init();
                        $message = Session::get('message');
                        if (!empty($message)) {
                            echo $message;
                            Session::set('message', null);
                        }

                        ?>

                        <form action="ProcessBrand.php" method="post">
                            <input type="hidden" name="brand_id" class="form-control"
                                value="<?php echo $result->brand_id; ?>">

                            <div class="form-group">
                                <label for="name">Brand Name:</label>
                                <input type="text" name="brand_name" class="form-control" class="form-control"
                                    value="<?php echo isset($result->brand_name) ? $result->brand_name : '' ; ?>">
                            </div>
                            <div class="form-group">
                                <label for="name"> Category:</label>
                                <select id="select" name="cat_id" class="form-control">
                                    <?php
                                    $categoryData = $category->index($table);
                                    if (!empty($categoryData)) {
                                        foreach ($categoryData as $category) {
                                            ?>
                                            <option <?php if ($category->cat_id == $result->cat_id) {
                                                ?>
                                                selected = "selected"
                                                <?php
                                                } ?>
                                                value="<?= $category->cat_id; ?>">
                                                <?=$category->cat_name; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <?php
                            if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                ?>
                            <button type="submit" name="submit" value="update" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i> Update</button>

                            <input type="hidden" name="id"
                                value="<?php echo $result->id; ?>">

                            <input type="hidden" name="action" value="update">

                            <a href="brandIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Brand Index</a>
                            <?php
                            } else {
                                ?>
                            <a href="brandIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Brand Index</a>
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
