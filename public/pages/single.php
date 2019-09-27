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
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span
                        class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>

    <div class="container">
        <!-- Content area begins -->
        <div class="row">
            <div class="col-sm-9 content-area bg-light">
                <div class="row bg-info py-3 px-3 text-white">
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
                    require_once '../../admin/app/start.php';
                    use Codecourse\Repositories\Session as Session;
                    use Codecourse\Repositories\Category as Category;
                    use Codecourse\Repositories\SubCategory as SubCategory;

                    // Needed for inserting category id to products table
                    $category = new Category;
                    $subCategory = new SubCategory;
                    // Needed for fetching data from table
                    $table = 'tbl_category';
                    $table2 = 'tbl_sub_category';

                    // Will display all the messages vlidation/insert/update/delete
                    // Session::init();
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }


                    ?>
                    <div class="col-sm-6">
                        <img src="../img/product_images/cell-phone.jpg" class="card-img-top cart-img img-cover"
                            alt="Cart Image" style="height:365px;">
                    </div>

                    <div class="col-sm-6">
                        <h6 class="card-title">Phone</h6>
                        <p class="card-text" style="text-align:justify;">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt quam quos quis ab repellendusn iste. Numquam distinctio labore hic tempora eos nostrum error sint asperiores exercitationem necessitatibus itaque quibusdam vel illum, unde.
                            Iusto voluptas eius adipisci nobis
                        reprehenderit quam expedita iste modi ullam autem. Eius est consequatur sequi ex dolor nemo tempora
                        dignissimos, dolore, itaque pariatur hic. Dolores consequuntur id nulla, odit perferendis, </p>
                        <div class="row">
                            <div class="col-sm-6">
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
                            </div>
                            <div class="col-sm-6">
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
                            </div>
                        </div>

                        <form action="process.php" method="post">
                            <input type="hidden" name="action" value="verify">
                            <button type="submit" name="submit" value="add-to-cart" class="btn btn-primary btn-sm mt-2 mb-2">
                                <i class="fas fa-plus"></i> Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row bg-info py-3 px-3 text-white"><h3>Categories</h3></div>
                <div class="category d-block">
                    <ul>
                        <li><a href="">Books</a></li>
                        <li><a href="">Watch</a></li>
                        <li><a href="">Laptop</a></li>
                        <li><a href="">Camera</a></li>
                        <li><a href="">Cosmetics</a></li>

                    </ul>
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
