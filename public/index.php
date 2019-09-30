<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ecommerce site</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
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
    <!-- <link rel="stylesheet" href="nivo-slider/demo/style.css" type="text/css" media="screen" />

    <!-- Custom stylesheets-->
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
        <?php include_once 'partials/_header.php'; ?>
        <!-- /Header ends -->
        <!-- Navbar -->
        <?php include_once 'partials/_navbar_index.php'; ?>
        <!-- /Navbar ends -->
        <!-- Page title -->
        <div class="row text-center bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h2> Cart Home</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <div class="container">
        <!-- Content area begins -->
        <div class="row">
            <div class="col-sm-12 card content-area bg-light">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <?php
                            include_once '../admin/app/start.php';

                            use Codecourse\Repositories\FrontEnd as FrontEnd;
                            use Codecourse\Repositories\Helpers as Helper;

                            $table = 'tbl_products';
                            $helper = new Helper;
                            $frontEnd = new FrontEnd;
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
                                                <?= isset($product->former_price) ? $product->former_price : ''; ?>
                                                <b>&#2547;</b></s>
                                            <span style="font-weight:bold; display:block;">Price :
                                                <?= isset($product->present_price) ? $product->present_price : ''; ?>
                                                <b>&#2547;</b></span>
                                            <span>
                                                <span class="rating-star"><b>Rating:</b></span>
                                                <?php
                                                    $rating = $product->pro_rating;
                                                    for ($i = 0; $i < $rating; $i++) {
                                                        ?>
                                                    <i class="fas fa-star rating-star"></i>
                                                <?php
                                                    }
                                                    ?>
                                            </span>
                                            <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                                <a href="#" class="btn btn-primary btn-sm">Add</a>
                                                <a href="pages/single.php?single_id=<?php echo $product->pro_id; ?>" class="btn btn-warning btn-sm">Details</a>
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

                    <!-- Featured Products -->
                    <div class="col-sm-12">

                    </div>
                    <!-- /Featured Products -->
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once 'partials/_scripts.php'; ?>
</body>

</html>
