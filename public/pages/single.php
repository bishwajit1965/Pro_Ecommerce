<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Brand as Brand;
use Codecourse\Repositories\Category as Category;
use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\Products as MyProduct;
use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\SubCategory as SubCategory;

Session::init();
Session::checkSession();

// Needed for inserting category id to products table
$category = new Category;
$subCategory = new SubCategory;
$product = new MyProduct();
$helper = new Helpers();
$brand = new Brand();

// Needed table for fetching data
$table = 'tbl_category';
$table2 = 'tbl_sub_category';
$table3 = 'tbl_products';
$table4 = 'tbl_brand';
$table5 = 'tbl_cart';

// Get single product id to fetch data
if (isset($_GET['single_id'])) {
    $id = $_GET['single_id'];
}
?>
<?php include_once '../partials/_head.php'; ?>

<body>
    <div class="container-fluid">
        <!-- Header Border -->
        <div class="row bg-dark py-1"></div>
        <!-- /Header Border -->

        <!-- Header -->
        <?php include_once '../partials/_header.php'; ?>
        <!-- /Header ends -->

        <!-- Navbar -->
        <?php include_once '../partials/_navbar.php'; ?>
        <!-- /Navbar ends -->

        <!-- Page title -->
        <div class="row text-center bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h2>Your Single Product in Detail</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container bg-light">
        <div class="row">
            <div class="col-sm-9 content-area">
                <div class="category bg-secondary py-2 mt-3 px-3 mb-3 text-white text-center">
                    <h3>Product details</h3>
                </div>
                <!-- Error message will be displayed -->
                <?php
                if (isset($_GET['error'])) {
                    $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                    <strong> SORRY !</strong> Something went wrong!!! Please check out !!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                    echo $message;
                }
                ?>
                <!-- /Error message will be displayed -->
                <div class="row">
                    <?php
                    // Will display all the messages vlidation/insert/update/delete
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    ?>
                    <?php
                    $single_product = $product->getSingleProduct($id, $table3);
                    ?>
                    <div class="col-sm-6">
                        <img src="../../admin/ecommerce/<?= $single_product->photo; ?>" class="card-img-top cart-img img-cover" alt="Cart Image" style="height:292px;">
                    </div>

                    <div class="col-sm-6">
                        <h4 class="card-title" style="font-size:30px; font-weight:bold;">
                            <?= $single_product->pro_name; ?>
                        </h4>
                        <p class="card-text" style="text-align:justify;">
                            <?= $helper->textShorten(htmlspecialchars_decode($single_product->pro_description), 277); ?>
                        </p>
                        <div class="row ">
                            <div class="col-sm-6">
                                <span class="price-rating-description mb-2" style="font-weight:bold; display:block;"><s>Form Price :
                                        <?= number_format((float) $single_product->present_price, 2, '.', '') ?>
                                        <b>&#2547;</b></s>
                                </span>

                                <span class="price-rating-description" style="font-weight:bold; display:block;">Present
                                    Price : <?= number_format((float) $single_product->present_price, 2, '.', '') ?>
                                    <b>&#2547;</b>
                                </span>
                                <span>
                                    <span class="price-rating-description"><b>Rating:</b></span>
                                    <?php
                                    $rating = $single_product->pro_rating;
                                    for ($i = 1; $i <= $rating; $i++) {
                                        ?>
                                        <i class="fas fa-star rating-star price-rating-description">
                                        </i>
                                    <?php
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="col-sm-6">
                                <span class="price-rating-description mb-2" style="font-weight:bold; display:block;">Comp:
                                    <?= $single_product->pro_company; ?>
                                </span>
                                <?php
                                $brandData = $brand->index($table4);
                                if (!empty($brandData)) {
                                    foreach ($brandData as $brand) {
                                        if ($brand->brand_id == $single_product->brand_id) {
                                            ?>
                                            <span class="price-rating-description" style="font-weight:bold; display:block;">
                                                Brand : <?= $brand->brand_name; ?>
                                            </span>
                                <?php
                                        } else {
                                            #....
                                        }
                                    }
                                }
                                ?>
                                <span class="price-rating-description"><b>
                                        Product Number:&nbsp;<?= $single_product->pro_number; ?></b>
                                </span>
                            </div>
                        </div>

                        <form action="processCart.php" method="post" autocomplete="on">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="number" name="quantity" value="1" min="1" autofocus max="20" selected class="form-control input-sm mt-2 mb-2 bg-light" placeholder="Select">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="hidden" name="action" value="verify">
                                    <input type="hidden" name="pro_id" value="<?= $single_product->pro_id; ?>">
                                    <input type="hidden" name="session_id" value="<?= $single_product->session_id; ?>">
                                    <button type="submit" name="submit" value="add-to-cart" class="btn btn-primary btn-block mt-2 mb-2">
                                        <i class="fas fa-cart-plus"></i> Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="category bg-secondary py-2 mt-4 px-3 mb-3 text-white text-center">
                    <h3>Product details</h3>
                </div>
                <div class="product-details">
                    <p style="text-align:justify;">
                        <?= htmlspecialchars_decode($single_product->pro_description); ?>
                    </p>
                </div>
                <a href=" ../index.php" class="btn btn-sm btn-primary mb-2"><i class="fas fa-fast-backward"> </i> Home page</a>
            </div>
            <!-- Right Sidebar -->
            <?php include_once '../partials/_rightSidebar.php'; ?>
            <!-- /Right Sidebar -->
        </div>
    </div>
    <!-- /Content area ends -->

    <!-- Footer area begins -->
    <div class="container-fluid">
        <!-- Footer top -->
        <?php include_once '../partials/_top-footer.php'; ?>
        <!-- /Footer top -->

        <!-- Footer -->
        <?php include_once '../partials/_footer.php'; ?>
        <!-- /Footer ends -->
    </div>
    <!-- /Footer area ends -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
