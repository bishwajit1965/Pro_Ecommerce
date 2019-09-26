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
                Add sub category data
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
                    <div class="col-sm-6 col-sm-offset-3">
                        <?php

                        use Codecourse\Repositories\Session as Session;
                        // To insert category
                        use Codecourse\Repositories\Category as Category;

                        // To insert lcategory id
                        $table = 'tbl_category';
                        $category = new Category();

                        // Will display all the messages vlidation/insert/update/delete
                        Session::init();
                        $message = Session::get('message');
                        if (!empty($message)) {
                            echo $message;
                            Session::set('message', null);
                        }
                        ?>

                        <form action="ProcessSubCategory.php" method="post">
                            <div class="form-group">
                                <label for="name">Sub Category Name:</label>
                                <input type="text" name="sub_cat_name" class="form-control form-control-sm"
                                    placeholder="Insert catergory name....">
                            </div>

                            <div class="form-group">
                                <label for="cat_id">Category Id:</label>
                                <select id="select" name="cat_id" class="form-control">
                                        <option value="">Select category</option>
                                        <?php
                                        $categoryData = $category->index($table);
                                        if (!empty($categoryData)) {
                                            foreach ($categoryData as $category) {
                                                ?>
                                            <option value="<?php echo $category->cat_id;?>">
                                                    <?php echo $category->cat_name;?>
                                            </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="action" value="add">
                            </div>

                            <button type="submit" name="submit" value="insert" class="btn btn-sm btn-primary">
                                <i class="fa fa-upload"></i> Insert</button>

                            <a href="subcategoryIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Sub Category Index</a>
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
