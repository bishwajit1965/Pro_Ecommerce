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
                <h2> Single Product</h2>
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
                <div class="col-sm-4 p-1">
                    <div class="card" style="">
                        <img src="../img/product_images/cell-phone.jpg" class="card-img-top cart-img img-cover"
                        alt="Cart Image">
                        <div class="card-body p-1 pt-3">
                            <h6 class="card-title">Phone</h6>
                            <p class="card-text">Some quick example text to build on the card title....</p>
                            <s>Price : 5200.00 <b>&#2547;</b></s>
                            <span style="font-weight:bold; display:block;">Price : 5000.00
                            <b>&#2547;</b></span>
                            <span>
                                <span class="rating-star"><b>Rating:</b></span>
                                <i class="fas fa-star rating-star"></i>
                                <i class="fas fa-star rating-star"></i>
                                <i class="fas fa-star rating-star"></i>
                                <i class="fas fa-star rating-star"></i>
                                <i class="fas fa-star rating-star"></i>
                            </span>
                            <div class="btn-group cart-add-link" role="group" aria-label="Basic example">
                                <a href="#" class="btn btn-primary btn-sm">Add</a>
                                <a href="single.php" class="btn btn-warning btn-sm">Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>
    <!-- /Content area ends -->
</div>

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
