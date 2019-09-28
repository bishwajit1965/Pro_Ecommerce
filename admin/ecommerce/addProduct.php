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
                Add products data
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

                    <?php
                    require_once '../app/start.php';
                    use Codecourse\Repositories\Session as Session;
                    use Codecourse\Repositories\Category as Category;
                    use Codecourse\Repositories\SubCategory as SubCategory;
                    use Codecourse\Repositories\Brand as Brand;

                    // Needed for inserting category id to products table
                    $category = new Category();
                    $subCategory = new SubCategory();
                    $brand = new Brand();

                    // Needed for fetching data from table
                    $table = 'tbl_category';
                    $table2 = 'tbl_sub_category';
                    $table3 = 'tbl_brand';

                    // Will display all the messages vlidation/insert/update/delete
                    Session::init();
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    ?>
                    <form action="processProduct.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pro_name">Product Name:</label>
                                    <input type="text" name="pro_name" class="form-control form-control-sm"
                                        placeholder="Insert product name....">
                                </div>
                                <div class="form-group">
                                    <label for="pro_number">Product Number:</label>
                                    <input type="text" name="pro_number" class="form-control form-control-sm"
                                        placeholder="Insert product number....">
                                </div>
                                <div class="form-group">
                                    <label for="former_price">Former Price:</label>
                                    <input type="text" name="former_price" class="form-control form-control-sm"
                                        placeholder="Insert former price....">
                                </div>
                                <div class="form-group">
                                    <label for="present_price">Present Price:</label>
                                    <input type="text" name="present_price" class="form-control form-control-sm"
                                        placeholder="Insert present price....">
                                </div>
                                <div class="form-group">
                                    <label for="photo"> Photo:</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pro_rating">Prod Rating:</label>
                                    <input type="number" name="pro_rating" min="1" max="5"
                                        class="form-control form-control-sm" placeholder="Insert product rating....">
                                </div>
                                <div class="form-group">
                                    <label for="name"> Category:</label>
                                    <select id="select" name="cat_id" class="form-control">
                                        <?php
                                        $categoryData = $category->index($table);
                                        if (!empty($categoryData)) {
                                            foreach ($categoryData as $category) {
                                                ?>
                                        <option
                                            value="<?= $category->cat_id; ?>">
                                            <?= $category->cat_name; ?>
                                        </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Sub Category:</label>
                                    <select id="select" name="sub_cat_id" class="form-control">
                                        <?php
                                        $subCategoryData = $subCategory->index($table2);
                                        if (!empty($subCategoryData)) {
                                            foreach ($subCategoryData as $subCategory) {
                                                ?>
                                        <option
                                            value="<?= $subCategory->sub_cat_id; ?>">
                                            <?= $subCategory->sub_cat_name; ?>
                                        </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Company:</label>
                                    <input type="text" name="pro_company" class="form-control"
                                        placeholder="Insert company....">
                                </div>
                                <div class="form-group">
                                    <label for="name"> Brand:</label>
                                    <select id="select" name="brand_id" class="form-control">
                                        <?php
                                        $brandData = $brand->index($table3);
                                        if (!empty($brandData)) {
                                            foreach ($brandData as $brand) {
                                                ?>
                                        <option
                                            value="<?= $brand->brand_id; ?>">
                                            <?= $brand->brand_name; ?>
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
                            </div>
                        </div>
                        <textarea name="pro_description" id="editor1">

                        </textarea><br>
                        <button type="submit" name="submit" value="insert" class="btn btn-sm btn-primary">
                            <i class="fa fa-upload"></i> Insert</button>
                        <a href="ecommerceIndex.php" class="btn btn-sm btn-warning">
                            <i class="fa fa-fast-backward"></i> Product Index</a>
                    </form>

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
