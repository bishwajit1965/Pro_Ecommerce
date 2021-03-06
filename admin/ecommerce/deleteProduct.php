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
            Delete product from store
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
                    <?php
                    // Class is called
                    use Codecourse\Repositories\Products as Products;
                    use Codecourse\Repositories\Category as Category;
                    use Codecourse\Repositories\SubCategory as SubCategory;

                    $products = new Products();
                    $category = new Category;
                    $subCategory = new SubCategory;
                    $table = 'tbl_products';
                    $table1 = 'tbl_category';
                    $table2 = 'tbl_sub_category';
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];
                        $result = $products->destroyView($id, $table);
                    }
                    ?>
                    <!-- Confirmation alert to delete -->
                    <div class="alert alert-warning alert-dismissible " role="alert">
                        <span>Are you sure of deleting this data ? Once deleted it will be lost for ever !!!</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="processProduct.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pro_name">Product Name:</label>
                                    <input type="text" name="pro_name" class="form-control form-control-sm"
                                    value="<?= isset($result->pro_name) ? $result->pro_name : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="pro_number">Product Number:</label>
                                    <input type="text" name="pro_number" class="form-control form-control-sm"
                                    value="<?= isset($result->pro_number) ? $result->pro_number : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="former_price">Former Price:</label>
                                    <input type="text" name="former_price" class="form-control form-control-sm"
                                    value="<?= isset($result->former_price) ? $result->former_price : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="present_price">Present Price:</label>
                                    <input type="text" name="present_price" class="form-control form-control-sm"
                                    value="<?= isset($result->present_price) ? $result->present_price : '';?>">
                                </div>
                                <div class="form-group">
                                    <label for="photo"> Photo:</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pro_rating">Prod Rating:</label>
                                            <input type="number" name="pro_rating" min="1" max="5" class="form-control form-control-sm"
                                            value="<?= isset($result->pro_rating) ? $result->pro_rating : '';?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="name"> Category:</label>
                                            <select id="select" name="cat_id" class="form-control">
                                                <?php
                                                $categoryData = $category->index($table1);
                                                if (!empty($categoryData)) {
                                                    foreach ($categoryData as $category) {
                                                        ?>
                                                <option
                                                        <?php if ($result->cat_id == $category->cat_id) {?>
                                                    selected = "selected"
                                                            <?php
                                                        } ?>
                                                    value="<?= $category->cat_id;?>">
                                                        <?= $category->cat_name;?>
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
                                                        <?php if ($result->sub_cat_id == $subCategory->sub_cat_id) {?>
                                                    selected = "selected"
                                                            <?php
                                                        } ?>
                                                    value="<?= $subCategory->sub_cat_id;?>">
                                                        <?= $subCategory->sub_cat_name;?>
                                                </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        if (empty($result->photo)) {
                                            ?>
                                        <img src="../gallery/avatar/avatar.png" class="img-cover" style="width:100%;height:210px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="Product Image">
                                            <?php
                                        } else {
                                            ?>
                                        <img src="<?= $result->photo;?>" class="img-cover" style="width:100%;height:220px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="Product Image">
                                            <?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Company:</label>
                                    <input type="text" name="pro_company" value="<?= $result->pro_company;?>" class="form-control">
                                </div>

                            </div>
                        </div>
                        <textarea name="pro_description" id="editor1">
                                    <?= isset($result->pro_description) ? $result->pro_description : '';?>
                        </textarea><br>
                        <?php
                        if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                            ?>
                        <input type="hidden" name="pro_id" value="<?php echo $result->pro_id; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" name="submit" value="delete" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> Delete</button>
                        <a href="ecommerceIndex.php" class="btn btn-sm btn-warning">
                            <i class="fa fa-fast-backward"></i> Ecommerce Index</a>
                            <?php
                        } else {
                            ?>
                        <a href="ecommerceIndex.php" class="btn btn-sm btn-warning">
                        <i class="fa fa-fast-backward"></i>Ecommerce Index</a>
                            <?php
                        }
                        ?>
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
    <?php include_once '../partials/_footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>
</html>
