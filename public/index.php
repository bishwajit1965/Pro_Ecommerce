<?php
// Loader of cl;ass files
include_once '../admin/app/start.php';

// Classes are included
use Codecourse\Repositories\Brand as Brand;
use Codecourse\Repositories\Cart as Cart;
use Codecourse\Repositories\Category as Category;
use Codecourse\Repositories\FrontEnd as FrontEnd;
use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\Products;
use Codecourse\Repositories\Profile as Profile;
use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\SocialMedia as SocialMedia;
use Codecourse\Repositories\SubCategory as SubCategory;

// starts session
Session::init();

// Classes instantiated
$cart = new Cart();
$brand = new Brand();
$category = new Category();
$frontEnd = new FrontEnd();
$helper = new Helpers();
$pdoduct = new Products();
$profile = new Profile();
$subCategory = new SubCategory();
$socialMedia = new SocialMedia();

$session = Session::checkLogin();
$sessionId = session_id();
$sessionId = session_id();

// Gets the file name to show whether it is active or not
$current_page = basename($_SERVER["SCRIPT_FILENAME"], '.php');

// Tables
$table1 = 'tbl_brand';
$table5 = 'tbl_cart';
$table3 = 'tbl_category';
$table = 'tbl_products';
$table2 = 'tbl_sub_category';
$tableBrand = 'tbl_brand';
$tableCategory = 'tbl_category';
$tableSubCategory = 'tbl_sub_category';
$tableCustomer = 'tbl_customer';
$tableCart = 'tbl_cart';
$tableHeader = 'tbl_header';
$tablePeoducts = 'tbl_products';
$tableOrders = 'tbl_orders';
$tableSocialMedia = 'tbl_social_sites';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ecommerce site</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap4.min.css">
    <!-- Favicon -->
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon" />
    <!-- Font awesome kit-->
    <script src="https://kit.fontawesome.com/1b551efcfa.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">
    <!-- Nivo slider -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="nivo-slider/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="nivo-slider/nivo-slider.css" media="screen" />
    <link rel="stylesheet" href="nivo-slider/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider/nivo-slider.css" type="text/css" media="screen" />
    <!-- <link rel="stylesheet" href="nivo-slider/demo/style.css" type="text/css" media="screen" /> -->

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>

<body>
    <div class="container-fluid">
        <!-- Header Border -->
        <div class="row bg-dark py-1"></div>
        <!-- /Header Border -->
        <!-- Header -->
        <?php include_once 'pages/partials/_indexHeader.php'; ?>
        <!-- /Header ends -->
        <!-- Navbar -->
        <nav class="row navbar navbar-expand-lg navbar-dark bg-dark clearfix" id="navbar">
            <a <?php
                if ($current_page == 'index') {
                    echo 'id="active"';
                }  ?> class="navbar-brand" href="index.php" style="font-size:16px;">HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a <?php
                            if ($current_page == 'brandCategorySubCategory') {
                                echo 'id="active"';
                            }  ?>class="nav-link" href="pages/brandCategorySubCategory.php">View products</a>
                    </li>
                    <?php

                    if ($session == true) {
                        ?>
                        <?php
                            if ($cart->checkCartTable($table5, $sessionId)) {
                                ?>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/cart.php">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/payment.php">Payment</a>
                            </li>
                        <?php
                            } ?>

                        <li class="nav-item">
                            <a class="nav-link" href="pages/customerProfileIndex.php">Profile</a>
                        </li>
                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="pages/contact.php">Contact</a>
                    </li>
                    <?php
                    $customerId = Session::get('customerId');
                    $orderRelatedCustomerIdData = $cart->checksCustomerIdInOrdersTable($customerId, $tableOrders);
                    if (!empty($orderRelatedCustomerIdData)) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/orderDetails.php"> Order List</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a <?php if ($current_page == 'aboutUs') {
                                echo 'id="active"';
                            } ?>class="nav-link" href="pages/aboutUs.php"> About Us</a>
                    </li>
                    <li class="nav-item">
                        <a <?php if ($current_page == 'termsAndConditions') {
                                echo 'id="active"';
                            } ?>class="nav-link" href="pages/termsAndConditions.php"> Term & Cond</a>
                    </li>
                    <li class="nav-item">
                        <a <?php if ($current_page == 'privacyPolicy') {
                                echo 'id="active"';
                            } ?>class="nav-link" href="pages/privacyPolicy.php"> Priv Policy</a>
                    </li>
                    <li class="nav-item">
                        <a <?php if ($current_page == 'returnPolicy') {
                                echo 'id="active"';
                            } ?>class="nav-link" href="pages/returnPolicy.php"> Retu Policy</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Navbar ends -->
        <!-- Page title -->
        <div class="row text-center  bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 pt-2">
                <h2> Cart Home</h2>
            </div>
            <div class="col-sm-2">
                <h3>
                    <span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i>
                        <sup class="badge badge-danger">
                            <?php if (!empty($sum)) :
                                echo $quantity; ?>
                            <?php else :
                                echo "0"; ?>
                            <?php endif ?>
                        </sup>
                    </span>
                </h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <div class="container-fluid">
        <!-- Content area begins -->
        <div class="row">
            <div class="col-sm-12 card content-area bg-light">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <?php
                            // $file_name = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                            // echo $file_name;
                            $records_per_page = 4;
                            $productsData = $frontEnd->paging($table, $records_per_page);
                            $products = $frontEnd->frontEndDataAndPagination($productsData);
                            foreach ($products as $product) {
                                ?>
                                <div class="col-sm-3 p-1 products-data">
                                    <div class="card" style="">

                                        <img src="../admin/ecommerce/<?= isset($product->photo) ? $product->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                        <div class="card-body p-1 pt-3 pb-2">
                                            <h6 class="card-title">
                                                <?= isset($product->pro_name) ? $product->pro_name : ''; ?>
                                            </h6>
                                            <p class="card-texts">
                                                <?= isset($product->pro_description) ? $helper->textShorten(htmlspecialchars_decode($product->pro_description), 68)  : ''; ?>
                                            </p>
                                            <s>Price :
                                                <?= isset($product->former_price) ? number_format($product->former_price, 2, '.', '') : ''; ?>
                                                <b>&#2547;</b>
                                            </s>
                                            <span style="font-weight:bold; display:block;">Price :
                                                <?= isset($product->present_price) ? number_format($product->present_price, 2, '.', '') : ''; ?>
                                                <b>&#2547;</b>
                                            </span>
                                            <span class="rating-star">
                                                <b>Rating:</b>
                                            </span>
                                            <?php
                                                $rating = $product->pro_rating;
                                                for ($i = 1; $i <= $rating; $i++) {
                                                    ?>
                                                <i class="fas fa-star rating-star"></i>
                                            <?php
                                                } ?>

                                            <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                <a href="pages/single.php?single_id=<?php echo $product->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>
                                                <a href="pages/single.php?single_id=<?php echo $product->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Slider area -->
                    <div class="col-sm-4 p-1">
                        <div id="wrapper">
                            <div class="slider-wrapper theme-default">
                                <div id="slider" class="nivoSlider">
                                    <?php
                                    $sliderData = $frontEnd->sliderDataDisplay($table);
                                    foreach ($sliderData as $slider) {
                                        ?>
                                        <a href="#">
                                            <img src="../admin/ecommerce/<?php echo $slider->photo; ?>" style="width:100%;height:316px;" class="img-cover" data-thumb="../admin/ecommerce/<?php echo $slider->photo; ?>" alt="<?php echo $slider->pro_name; ?>" title="<?php echo $slider->pro_name; ?>" />
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Slider ends -->
                </div>

                <!-- Pagination begins -->
                <div class="row d-flex justify-content-center">
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination">
                            <?php $frontEnd->paginglink($table, $records_per_page); ?>
                        </ul>
                    </nav>
                    <?php
                    $data = $frontEnd->NumberOfCountedRows($table);
                    ?>
                </div>
                <!-- /Pagination eends -->

                <!-- Featured Products -->
                <div class="row">
                    <div class="col-sm-10">
                        <?php
                        if (isset($_GET['brand_id'])) {
                            echo '
                            <div class="row branded-product bg-secondary  p-2">
                            <h2 style="margin:auto;padding-top:4px;padding-bottom:4px;">Selected  branded  products</h2>
                            </div>
                            ';
                        } elseif (isset($_GET['category_id'])) {
                            echo '
                            <div class="row branded-product bg-secondary  p-2">
                            <h2 style="margin:auto;padding-top:4px;padding-bottom:4px;">Category wise selected products</h2>
                            </div>
                            ';
                        } elseif (isset($_GET['sub_category_id'])) {
                            echo '
                            <div class="row branded-product bg-secondary  p-2">
                            <h2 style="margin:auto;padding-top:4px;padding-bottom:4px;">Sub category wise selected products</h2>
                            </div>
                            ';
                        } else {
                            echo '
                            <div class="row branded-product bg-secondary  p-2">
                            <h2 style="margin:auto;padding-top:4px;padding-bottom:4px;">Random branded products</h2>
                            </div>
                            ';
                        }
                        ?>
                        <div class="row">
                            <?php
                            if (!empty($_GET['brand_id'])) {
                                $brandId = $_GET['brand_id'];
                                $displayIDWiseBrandedProduct = $pdoduct->displayAllBrandedItems($table, $brandId);
                                if (!empty($displayIDWiseBrandedProduct)) {
                                    foreach ($displayIDWiseBrandedProduct as $displayAllData) {
                                        if ($brandId == $displayAllData->brand_id) {
                                            ?>
                                            <div class="col-sm-3 p-1">
                                                <div class="card" style="">
                                                    <img src="../admin/ecommerce/<?= isset($displayAllData->photo) ? $displayAllData->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                                    <div class="card-body p-1 pt-3 pb-2">
                                                        <h6 class="card-title">
                                                            <?= isset($displayAllData->pro_name) ? $displayAllData->pro_name : ''; ?>
                                                        </h6>
                                                        <p class="card-texts">
                                                            <?= isset($displayAllData->pro_description) ? $helper->textShorten(htmlspecialchars_decode($displayAllData->pro_description), 68)  : ''; ?>
                                                        </p>
                                                        <s>Price :
                                                            <?= isset($displayAllData->former_price) ? number_format($displayAllData->former_price, 2, '.', '') : ''; ?>
                                                            <b>&#2547;</b>
                                                        </s>
                                                        <span style="font-weight:bold; display:block;">Price :
                                                            <?= isset($present_price) ? number_format($displayAllData->present_price, 2, '.', '') : ''; ?>
                                                            <b>&#2547;</b>
                                                        </span>
                                                        <span style="font-weight:bold; display:block;">Brand :
                                                            <?php $brandName = $brand->getBrand($table1);
                                                                            if (!empty($brandName)) {
                                                                                foreach ($brandName as $b_data) {
                                                                                    if ($b_data->brand_id == $displayAllData->brand_id) {
                                                                                        echo $b_data->brand_name;
                                                                                    }
                                                                                }
                                                                            } ?>
                                                        </span>

                                                        <span class="rating-star">
                                                            <b>Rating:</b>
                                                        </span>
                                                        <?php $rating = $displayAllData->pro_rating;
                                                                        for ($i = 1; $i <= $rating; $i++) {
                                                                            ?>
                                                            <i class="fas fa-star rating-star"></i>
                                                        <?php
                                                                        } ?>

                                                        <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                            <a href="pages/single.php?single_id=<?php echo $displayAllData->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>

                                                            <a href="pages/single.php?single_id=<?php echo $displayAllData->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                                    }
                                                }
                                            } else {
                                                include_once 'pages/notFound.php';
                                            }
                                        } elseif (isset($_GET['category_id'])) {
                                            $categoryId = $_GET['category_id'];
                                            $categoryWiseProductData = $pdoduct->categoryIdWisePdoductData($table, $categoryId);
                                            if (!empty($categoryWiseProductData)) {
                                                foreach ($categoryWiseProductData as $categoryProduct) {
                                                    if ($categoryId == $categoryProduct->cat_id) {
                                                        ?>
                                            <div class="col-sm-3 p-1 products-data">
                                                <div class="card" style="">
                                                    <img src="../admin/ecommerce/<?= isset($categoryProduct->photo) ? $categoryProduct->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                                    <div class="card-body p-1 pt-3 pb-2">
                                                        <h6 class="card-title">
                                                            <?= isset($categoryProduct->pro_name) ? $categoryProduct->pro_name : ''; ?>
                                                        </h6>
                                                        <p class="card-texts">
                                                            <?= isset($categoryProduct->pro_description) ? $helper->textShorten(htmlspecialchars_decode($categoryProduct->pro_description), 68)  : ''; ?>
                                                        </p>
                                                        <s>Price :
                                                            <?= isset($categoryProduct->former_price) ? number_format($categoryProduct->former_price, 2, '.', '') : ''; ?>
                                                            <b>&#2547;</b>
                                                        </s>
                                                        <span style="font-weight:bold; display:block;">Price :
                                                            <?= isset($categoryProduct->present_price) ? number_format($categoryProduct->present_price, 2, '.', '') : ''; ?>
                                                            <b>&#2547;</b>
                                                        </span>

                                                        <span style="font-weight:bold; display:block;">Brand :
                                                            <?php $brandName = $brand->getBrand($table1);
                                                                            if (!empty($brandName)) {
                                                                                foreach ($brandName as $b_data) {
                                                                                    if ($b_data->brand_id == $categoryProduct->brand_id) {
                                                                                        echo $b_data->brand_name;
                                                                                    }
                                                                                }
                                                                            } ?>
                                                        </span>

                                                        <span class="rating-star">
                                                            <b>Rating:</b>
                                                        </span>
                                                        <?php $rating = $categoryProduct->pro_rating;
                                                                        for ($i = 1; $i <= $rating; $i++) {
                                                                            ?>
                                                            <i class="fas fa-star rating-star"></i>
                                                        <?php
                                                                        } ?>

                                                        <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                            <a href="pages/single.php?single_id=<?php echo $categoryProduct->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>

                                                            <a href="pages/single.php?single_id=<?php echo $categoryProduct->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                                    }
                                                }
                                            } else {
                                                include_once 'pages/notFound.php';
                                            }
                                        } elseif (isset($_GET['sub_category_id'])) {
                                            $subCategoryId = $_GET['sub_category_id'];
                                            $subCategoryWiseProductData = $pdoduct->subCategoryIdWisePdoductData($table, $subCategoryId);
                                            if (!empty($subCategoryWiseProductData)) {
                                                foreach ($subCategoryWiseProductData as $subCategoryProduct) {
                                                    if ($subCategoryId == $subCategoryProduct->sub_cat_id) {
                                                        ?>
                                            <div class="col-sm-3 p-1 products-data">
                                                <div class="card" style="">
                                                    <img src="../admin/ecommerce/<?= isset($subCategoryProduct->photo) ? $subCategoryProduct->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                                    <div class="card-body p-1 pt-3 pb-2">
                                                        <h6 class="card-title">
                                                            <?= isset($subCategoryProduct->pro_name) ? $subCategoryProduct->pro_name : ''; ?>
                                                        </h6>
                                                        <p class="card-texts">
                                                            <?= isset($subCategoryProduct->pro_description) ? $helper->textShorten(htmlspecialchars_decode($subCategoryProduct->pro_description), 68)  : ''; ?>
                                                        </p>
                                                        <s>Price :
                                                            <?= isset($subCategoryProduct->former_price) ? number_format($subCategoryProduct->former_price, 2, '.', '') : ''; ?>
                                                            <b>&#2547;</b>
                                                        </s>
                                                        <span style="font-weight:bold; display:block;">Price :
                                                            <?= isset($subCategoryProduct->present_price) ? number_format($subCategoryProduct->present_price, 2, '.', '') : ''; ?>
                                                            <b>&#2547;</b>
                                                        </span>
                                                        <span style="font-weight:bold; display:block;">Brand :
                                                            <?php $brandName = $brand->getBrand($table1);
                                                                            if (!empty($brandName)) {
                                                                                foreach ($brandName as $b_data) {
                                                                                    if ($b_data->brand_id == $subCategoryProduct->brand_id) {
                                                                                        echo $b_data->brand_name;
                                                                                    }
                                                                                }
                                                                            } ?>
                                                        </span>
                                                        <span class="rating-star">
                                                            <b>Rating:</b>
                                                        </span>
                                                        <?php $rating = $subCategoryProduct->pro_rating;
                                                                        for ($i = 1; $i <= $rating; $i++) {
                                                                            ?>
                                                            <i class="fas fa-star rating-star"></i>
                                                        <?php
                                                                        } ?>
                                                        <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                            <a href="pages/single.php?single_id=<?php echo $subCategoryProduct->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>

                                                            <a href="pages/single.php?single_id=<?php echo $subCategoryProduct->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                            }
                                        }
                                    } else {
                                        include_once 'pages/notFound.php';
                                    }
                                } else {
                                    ?>
                                <!-- Default branded data loading if brand not clicked ends-->
                                <?php
                                    $products = $frontEnd->defaultFrontEndBrandedProducts($table);
                                    foreach ($products as $product) {
                                        ?>
                                    <div class="col-sm-3 p-1 products-data">
                                        <div class="card" style="">
                                            <img src="../admin/ecommerce/<?= isset($product->photo) ? $product->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                            <div class="card-body p-1 pt-3 pb-2">
                                                <h6 class="card-title">
                                                    <?= isset($product->pro_name) ? $product->pro_name : ''; ?>
                                                </h6>
                                                <p class="card-texts">
                                                    <?= isset($product->pro_description) ? $helper->textShorten(htmlspecialchars_decode($product->pro_description), 68)  : ''; ?>
                                                </p>
                                                <s>Price :
                                                    <?= isset($product->former_price) ? number_format($product->former_price, 2, '.', '') : ''; ?>
                                                    <b>&#2547;</b>
                                                </s>
                                                <span style="font-weight:bold; display:block;">Price :
                                                    <?= isset($product->present_price) ? number_format($product->present_price, 2, '.', '') : ''; ?>
                                                    <b>&#2547;</b>
                                                </span>

                                                <span style="font-weight:bold; display:block;">Brand :
                                                    <?php $brandName = $brand->getBrand($table1);
                                                            if (!empty($brandName)) {
                                                                foreach ($brandName as $b_data) {
                                                                    if ($b_data->brand_id == $product->brand_id) {
                                                                        echo $b_data->brand_name;
                                                                    }
                                                                }
                                                            } ?>
                                                </span>

                                                <span class="rating-star">
                                                    <b>Rating:</b>
                                                </span>
                                                <?php
                                                        $rating = $product->pro_rating;
                                                        for ($i = 1; $i <= $rating; $i++) {
                                                            ?>
                                                    <i class="fas fa-star rating-star"></i>
                                                <?php
                                                        } ?>

                                                <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                    <a href="pages/single.php?single_id=<?php echo $product->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>
                                                    <a href="pages/single.php?single_id=<?php echo $product->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <!--/ Default branded data loading if brand not clicked ends-->
                        </div>
                    </div>
                    <div class="col-sm-2 bg-light brands px-1">
                        <div class="branded-product bg-secondary text-center py-2">
                            <h2>Prod Links</h2>
                        </div>
                        <!-- Accordion begins -->
                        <button class="accordion">
                            <h2 class="accordion-heading">Brands</h2>
                        </button>
                        <div class="panel">
                            <div class="row brands">
                                <ul>
                                    <?php
                                    $brandedData = $brand->brandedItems($table1);
                                    if (!empty($brandedData)) {
                                        foreach ($brandedData as $brand) {
                                            ?>
                                            <li>
                                                <a href="index.php?brand_id=<?= $brand->brand_id ?>">
                                                    <?= $brand->brand_name ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <button class="accordion">
                            <h2 class="accordion-heading">Categories</h2>
                        </button>
                        <div class="panel">
                            <div class="row brands">
                                <ul>
                                    <?php
                                    $categoryData = $category->index($table3);
                                    if (!empty($categoryData)) {
                                        foreach ($categoryData as $category) {
                                            ?>
                                            <li>
                                                <a href="index.php?category_id=<?= $category->cat_id; ?>">
                                                    <?= $category->cat_name; ?>
                                                </a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <button class="accordion">
                            <h2 class="accordion-heading">Sub-cats</h2>
                        </button>
                        <div class="panel">
                            <div class="row brands">
                                <ul>
                                    <?php
                                    $subCategoryData = $subCategory->index($table2);
                                    if (!empty($subCategoryData)) {
                                        foreach ($subCategoryData as $subCategory) {
                                            ?>
                                            <li>
                                                <a href="index.php?sub_category_id=<?= $subCategory->sub_cat_id; ?>">
                                                    <?= $subCategory->sub_cat_name; ?>
                                                </a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- /Accordion ends -->
                    </div>
                </div>
                <!-- /Featured Products -->
            </div>
        </div>
        <!-- /Content area ends -->
    </div>
    <!-- Footer area begins -->
    <div class="container-fluid">
        <!-- Footer top -->
        <?php include_once 'pages/partials/_top-footer.php'; ?>
        <!-- /Footer top -->

        <!-- Footer -->
        <?php include_once 'pages/partials/_indexFooter.php'; ?>
        <!-- /Footer ends -->
    </div>
    <!-- /Footer area ends -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once 'pages/partials/_scripts.php'; ?>
    <!-- Accordion -->
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
    <!-- /Accordion -->
</body>

</html>
