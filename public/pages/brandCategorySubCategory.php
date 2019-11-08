<?php include_once 'partials/_head.php'; ?>

<body>
    <div class="container-fluid">
        <!-- Header Border -->
        <div class="row bg-dark py-1"></div>
        <!-- /Header Border -->
        <!-- Header -->
        <?php include_once 'partials/_header.php'; ?>
        <!-- /Header ends -->
        <!-- Navbar -->
        <!-- <nav class="row navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
            <a class="navbar-brand" href="../index.php" style="font-size:16px;">HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <?php

                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current_page = basename($path, '.php');
                    if ($session == true) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" <?php if ($current_page == 'customerProfileIndex') {
                                                        echo 'id="active"';
                                                    }
                                                    ?> href="customerProfileIndex.php">Profile</a>
                        </li>
                        <?php
                            if ($cart->checkCartTable($table5, $sessionId)) { ?>
                            <li class="nav-item">
                                <a <?php if ($current_page == 'cart') {
                                                echo 'id="active"';
                                            } ?> class="nav-link" href="cart.php"> Cart</a>
                            </li>
                            <li class="nav-item">
                                <a <?php if ($current_page == 'payment') {
                                                echo 'id="active"';
                                            } ?>class="nav-link" href="payment.php"> Payment</a>
                            </li>
                    <?php }
                    } ?>
                    <?php
                    $orderRelatedCustomerIdData = $cart->checksCustomerIdInOrdersTable($customerId, $tableOrders);
                    if (!empty($orderRelatedCustomerIdData)) {
                        ?>
                        <li class="nav-item">
                            <a <?php if ($current_page == 'orderDetails') {
                                        echo 'id="active"';
                                    } ?>class="nav-link" href="orderDetails.php"> Order List</a>
                        </li>
                        <li class="nav-item">
                            <a <?php if ($current_page == 'order') {
                                        echo 'id="active"';
                                    } ?>class="nav-link" href="order.php"> Order</a>
                        </li>
                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="topBrands.php">Top Brands</a>
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
        </nav> -->
        <?php include_once 'partials/_navbar.php'; ?>
        <!-- /Navbar ends -->
        <!-- Page title -->
        <!-- <div class="row text-center  bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 pt-2">
                <h2> Cart Home</h2>
            </div>
            <div class="col-sm-2 d-flex flex-row justify-content-center pt-0">
                <h3>
                    <span class="badge badge-info">
                        <i class="fas fa-cart-plus">&nbsp;</i>
                        <sup>3</sup>
                    </span class="badge badge-secondary">
                </h3>
            </div>
        </div> -->
        <!-- /Page title -->
    </div>
    <div class="container-fluid">
        <!-- Content area begins -->
        <div class="row">
            <div class="col-sm-12 card content-area bg-light">
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
                                $displayIDWiseBrandedProduct = $products->displayAllBrandedItems($tableProducts, $brandId);
                                if (!empty($displayIDWiseBrandedProduct)) {
                                    foreach ($displayIDWiseBrandedProduct as $displayAllData) {
                                        if ($brandId == $displayAllData->brand_id) {
                                            ?>
                                            <div class="col-sm-3 p-1">
                                                <div class="card" style="">
                                                    <img src="../../admin/ecommerce/<?= isset($displayAllData->photo) ? $displayAllData->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                                    <div class="card-body p-1 pt-3 pb-2">
                                                        <h6 class="card-title">
                                                            <?= isset($displayAllData->pro_name) ? $displayAllData->pro_name : ''; ?>
                                                        </h6>
                                                        <p class="card-texts">
                                                            <?= isset($displayAllData->pro_description) ? $helpers->textShorten(htmlspecialchars_decode($displayAllData->pro_description), 68)  : ''; ?>
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
                                                            <?php
                                                                            $brandName = $brand->getBrand($tableBrand);
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
                                                        <?php
                                                                        $rating = $displayAllData->pro_rating;
                                                                        for ($i = 1; $i <= $rating; $i++) {
                                                                            ?>
                                                            <i class="fas fa-star rating-star"></i>
                                                        <?php
                                                                        } ?>

                                                        <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                            <a href="single.php?single_id=<?php echo $displayAllData->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>

                                                            <a href="single.php?single_id=<?php echo $displayAllData->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                                    }
                                                }
                                            } else {
                                                include_once 'notFound.php';
                                            }
                                        } elseif (isset($_GET['category_id'])) {
                                            $categoryId = $_GET['category_id'];
                                            $categoryWiseProductData = $products->categoryIdWisePdoductData($tableProducts, $categoryId);
                                            if (!empty($categoryWiseProductData)) {
                                                foreach ($categoryWiseProductData as $categoryProduct) {
                                                    if ($categoryId == $categoryProduct->cat_id) {
                                                        ?>
                                            <div class="col-sm-3 p-1 products-data">
                                                <div class="card" style="">
                                                    <img src="../../admin/ecommerce/<?= isset($categoryProduct->photo) ? $categoryProduct->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                                    <div class="card-body p-1 pt-3 pb-2">
                                                        <h6 class="card-title">
                                                            <?= isset($categoryProduct->pro_name) ? $categoryProduct->pro_name : ''; ?>
                                                        </h6>
                                                        <p class="card-texts">
                                                            <?= isset($categoryProduct->pro_description) ? $helpers->textShorten(htmlspecialchars_decode($categoryProduct->pro_description), 68)  : ''; ?>
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
                                                            <?php
                                                                            $brandName = $brand->getBrand($tableBrand);
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
                                                        <?php
                                                                        $rating = $categoryProduct->pro_rating;
                                                                        for ($i = 1; $i <= $rating; $i++) {
                                                                            ?>
                                                            <i class="fas fa-star rating-star"></i>
                                                        <?php
                                                                        } ?>

                                                        <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                            <a href="single.php?single_id=<?php echo $categoryProduct->pro_id; ?>"                                                                class="btn btn-primary btn-sm"> <i class="fas fa-info-circle"></i> Add</a>

                                                            <a href="single.php?single_id=<?php echo $categoryProduct->pro_id; ?>"                                                            class="btn btn-warning btn-sm"> <i class="fas fa-info-circle"></i> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                                    }
                                                }
                                            } else {
                                                include_once 'notFound.php';
                                            }
                                        } elseif (isset($_GET['sub_category_id'])) {
                                            $subCategoryId = $_GET['sub_category_id'];
                                            $subCategoryWiseProductData =
                                                $products->subCategoryIdWisePdoductData($tableProducts, $subCategoryId);
                                            if (!empty($subCategoryWiseProductData)) {
                                                foreach ($subCategoryWiseProductData as $subCategoryProduct) {
                                                    if ($subCategoryId == $subCategoryProduct->sub_cat_id) {
                                                        ?>
                                            <div class="col-sm-3 p-1 products-data">
                                                <div class="card" style="">
                                                    <img src="../../admin/ecommerce/<?= isset($subCategoryProduct->photo) ? $subCategoryProduct->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                                    <div class="card-body p-1 pt-3 pb-2">
                                                        <h6 class="card-title">
                                                            <?= isset($subCategoryProduct->pro_name) ? $subCategoryProduct->pro_name : ''; ?>
                                                        </h6>
                                                        <p class="card-texts">
                                                            <?= isset($subCategoryProduct->pro_description) ? $helpers->textShorten(htmlspecialchars_decode($subCategoryProduct->pro_description), 68)  : ''; ?>
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
                                                            <?php
                                                            $brandName = $brand->getBrand($tableBrand);
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
                                                        <?php
                                                        $rating = $subCategoryProduct->pro_rating;
                                                        for ($i = 1; $i <= $rating; $i++) { ?>
                                                            <i class="fas fa-star rating-star"></i>
                                                        <?php } ?>
                                                        <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                            <a href="single.php?single_id=<?php echo $subCategoryProduct->pro_id; ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>

                                                            <a href="single.php?single_id=<?php echo $subCategoryProduct->pro_id; ?>" class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                            }
                                        }
                                    } else {
                                        include_once 'notFound.php';
                                    }
                                } else {
                                    ?>
                                <!-- Default branded data loading if brand not clicked ends-->
                                <?php
                                    $products = $frontEnd->defaultFrontEndBrandedProducts($tableProducts);
                                    foreach ($products as $product) {
                                        ?>
                                    <div class="col-sm-3 p-1 products-data">
                                        <div class="card" style="">
                                            <img src="../../admin/ecommerce/<?= isset($product->photo) ? $product->photo : ''; ?>" class="card-img-top cart-img img-cover" alt="Cart Image">
                                            <div class="card-body p-1 pt-3 pb-2">
                                                <h6 class="card-title">
                                                    <?= isset($product->pro_name) ? $product->pro_name : ''; ?>
                                                </h6>
                                                <p class="card-texts">
                                                    <?= isset($product->pro_description) ? $helpers->textShorten(htmlspecialchars_decode($product->pro_description), 68)  : ''; ?>
                                                </p>
                                                <s>Price : <?= isset($product->former_price) ? number_format($product->former_price, 2, '.', '') : ''; ?> <b>&#2547;</b>
                                                </s>
                                                <span style="font-weight:bold; display:block;">Price : <?= isset($product->present_price) ? number_format($product->present_price, 2, '.', '') : ''; ?><b>&#2547;</b>
                                                </span>
                                                <span style="font-weight:bold; display:block;">Brand :
                                                    <?php
                                                    $brandName = $brand->getBrand($tableBrand);
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
                                                <?php } ?>
                                                <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                    <a href="single.php?single_id=<?php echo $product->pro_id; ?>"
                                                       class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Add</a>
                                                    <a href="single.php?single_id=<?php echo $product->pro_id; ?>"
                                                       class="btn btn-warning btn-sm"><i class="fas fa-info-circle"></i> Details</a>
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
                                    $brandedData = $brand->brandedItems($tableBrand);
                                    if (!empty($brandedData)) {
                                        foreach ($brandedData as $brand) { ?>
                                            <li>
                                                <a href="brandCategorySubCategory.php?brand_id=<?= $brand->brand_id ?>">
                                                    <?= $brand->brand_name ?></a>
                                            </li>
                                    <?php } } ?>
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
                                    $categoryData = $category->index($tableCategory);
                                    if (!empty($categoryData)) {
                                        foreach ($categoryData as $category) { ?>
                                            <li>
                                                <a href="brandCategorySubCategory.php?category_id=<?= $category->cat_id; ?>">
                                                    <?= $category->cat_name; ?>
                                                </a>
                                            </li>
                                    <?php } } ?>
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
                                    $subCategoryData = $subCategory->index($tableSubCategory);
                                    if (!empty($subCategoryData)) {
                                        foreach ($subCategoryData as $subCategory) { ?>
                                            <li>
                                                <a href="brandCategorySubCategory.php?sub_category_id=<?= $subCategory->sub_cat_id; ?>">
                                                    <?= $subCategory->sub_cat_name; ?>
                                                </a>
                                            </li>
                                    <?php } } ?>
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
        <?php include_once 'partials/_top-footer.php'; ?>
        <!-- /Footer top -->

        <!-- Footer -->
        <?php include_once 'partials/_footer.php'; ?>
        <!-- /Footer ends -->
    </div>
    <!-- /Footer area ends -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once 'partials/_scripts.php'; ?>
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
