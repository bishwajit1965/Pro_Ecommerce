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
                <h2> Cart Products</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>5</sup></span class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <div class="container">
        <!-- Content area begins -->
        <div class="row">
            <div class="col-sm-12 card content-area bg-light">
            <div class="row">
                <?php include_once '../partials/_left-sidebar.php'; ?>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-3 p-1">
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
                        <div class="col-sm-3 p-1">
                            <div class="card" style="">
                                <img src="../img/product_images/watch.jpg" class="card-img-top cart-img img-cover" alt="Cart Image">
                                <div class="card-body p-1 pt-3">
                                    <h6 class="card-title">Wrist watch</h6>
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
                        <div class="col-sm-3 p-1">
                            <div class="card" style="">
                                <img src="../img/product_images/laptop.jpg" class="card-img-top cart-img img-cover" alt="Cart Image">
                                <div class="card-body p-1 pt-3">
                                    <h6 class="card-title">Laptop</h6>
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
                        <div class="col-sm-3 p-1">
                            <div class="card" style="">
                                <img src="../img/product_images/camera.jpg" class="card-img-top cart-img img-cover" alt="Cart Image">
                                <div class="card-body p-1 pt-3">
                                    <h6 class="card-title"> DSLR Camera</h6>
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
                                        <a href="pages/single.php" class="btn btn-warning btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider area -->
                <div class="col-sm-3 p-1">
                    <div class="bd-example">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../img/product_images/camera.jpg" class="d-block w-100 img-class" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>First slide label</h5>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum....</p>
                                        <form action="" method="post">
                                            <button type="submit" class="btn btn-sm btn-primary">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../img/product_images/cell-phone.jpg" class="d-block w-100 img-class" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Second slide label</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit....</p>
                                        <form action="" method="post">
                                            <button type="submit" class="btn btn-sm btn-primary">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../img/product_images/laptop.jpg" class="d-block w-100 img-class" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        <form action="" method="post">
                                            <button type="submit" class="btn btn-sm btn-primary">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../img/product_images/tv.jpg" class="d-block w-100 img-class" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Fourth slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur....</p>
                                        <form action="" method="post">
                                            <button type="submit" class="btn btn-sm btn-primary">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--/ Slider ends -->
            </div>
            <div class="row d-flex justify-content-center">
                <nav aria-label="Page navigation example ">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
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
