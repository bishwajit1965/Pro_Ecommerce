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
                <div class="category bg-secondary py-2 mt-3 px-3 mb-3 text-white text-center"><h3>Product details</h3></div>
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
                            alt="Cart Image" style="height:350px;">
                    </div>

                    <div class="col-sm-6">
                        <h4 class="card-title mt-2" style="font-size:30px; font-weight:bold;">Phone</h4>
                        <p class="card-text" style="text-align:justify;">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt quam quos quis ab
                            repellendusn iste. Numquam distinctio labore hic tempora eos nostrum error sint asperiores
                            exercitationem necessitatibus itaque quibusdam.....
                        </p>
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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="number" name="quantity" min="1" max="5"
                                        class="form-control input-sm mt-2 mb-2 bg-light" placeholder="Number of items.."
                                        selected="selected">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <form action="process.php" method="post">
                                    <input type="hidden" name="action" value="verify">
                                    <button type="submit" name="submit" value="add-to-cart"
                                        class="btn btn-primary btn-block mt-2 mb-2">
                                        <i class="fas fa-plus"></i> Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row bg-dark py-2 px-2 mt-3 mb-3 text-white text-center">
                    <h3>Product details</h3>
                </div> -->
                <div class="category bg-secondary py-2 mt-4 px-3 mb-3 text-white text-center"><h3>Product details</h3></div>
                <div class="product-details">
                    <p style="text-align:justify;">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic recusandae porro incidunt laborum.
                        Neque delectus quas dolore ea nostrum nesciunt reprehenderit, debitis possimus sunt! Blanditiis
                        iure eaque enim dolores necessitatibus voluptates excepturi corrupti! Eius vero repudiandae
                        labore culpa blanditiis dolorum qui natus sequi quas alias. Id incidunt sed ipsa quam. Suscipit
                        fuga aspernatur corrupti. Tenetur sequi, saepe culpa id veritatis cupiditate expedita excepturi
                        ab reprehenderit alias incidunt eveniet asperiores cum esse sit, recusandae fugiat quam nesciunt
                        eos, sed facere accusamus facilis rem blanditiis. Saepe illum a minima quos voluptatem in
                        officia architecto placeat, dolores, aperiam aut nostrum labore cumque, illo porro qui quia
                        iusto necessitatibus aliquam esse nisi eveniet quibusdam. Eveniet fugiat placeat quasi
                        repudiandae? Excepturi dolorem veritatis libero minima alias vitae voluptates doloremque odit!
                        Fuga minus dolor, similique, nam fugit neque illo in excepturi rerum ipsum, sed possimus error
                        mollitia. Asperiores neque numquam molestiae, praesentium quibusdam aliquid. Eos, natus error!
                        Voluptas numquam corporis est repellendus inventore suscipit sunt veniam fuga deleniti
                        voluptatibus, consequatur incidunt consectetur magni quod laboriosam nesciunt amet obcaecati.
                    </p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="category bg-secondary py-2 mt-3 px-3 text-white text-center"><h3>Categories</h3></div>
                <div class="category d-block">
                    <ul>
                        <li><a href="">Books</a></li>
                        <li><a href="">Watch</a></li>
                        <li><a href="">Laptop</a></li>
                        <li><a href="">Camera</a></li>
                        <li><a href="">Cosmetics</a></li>
                    </ul>
                </div>
                <div class="category bg-secondary py-2 mt-3 px-3 text-white text-center"><h3>Sub Categories</h3></div>
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
