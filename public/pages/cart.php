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
    <!-- Content area begins -->
    <div class="container pb-3">
        <table class="table table-striped table-small table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th width:"25%">Prod Name</th>
                    <th width:"20%">Prod Image</th>
                    <th width:"10%">Pro Price</th>
                    <th width:"20%">Pro Quantity</th>
                    <th width:"15%">Total Price</th>
                    <th width:"10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">Product Name</td>
                    <td><img class="img-fluid w-25 h-0" src="../img/product_images/camera.jpg" alt=""></td>
                    <td> 50000.00 <b>&#2547;</b></td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="number" name="quantity" min="1" max="5" class=" form-control col-sm-12" placeholder="Select" selected="selected">
                            </div>
                            <div class="col-sm-6">
                                <a name="" id="" class="btn btn-primary col-sm-12" href="#" role="button"><i class="fas fa-edit"></i> Update</a></>
                            </div>
                        </div>
                    </td>
                    <td style="display:block;text-align:right;">50,000.00 <b>&#2547;</b></td>
                    <td>
                        <a href="" class="btn btn-sm btn-danger"> Delete</a>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Product Name</td>
                    <td><img class="img-fluid w-25 h-0" src="../img/product_images/camera.jpg" alt=""></td>
                    <td> 50000.00 <b>&#2547;</b></td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="number" name="quantity" min="1" max="5" class=" form-control col-sm-12" placeholder="Select" selected="selected">
                            </div>
                            <div class="col-sm-6">
                                <a name="" id="" class="btn btn-primary col-sm-12" href="#" role="button"><i class="fas fa-edit"></i> Update</a></>
                            </div>
                        </div>
                    </td>
                    <td style="display:block;text-align:right;">50,000.00 <b>&#2547;</b></td>
                    <td>
                        <a href="" class="btn btn-sm btn-danger"> Delete</a>
                    </td>
                </tr>
                <tr>
                    <td scope="row">Product Name</td>
                    <td><img class="img-fluid w-25 h-0" src="../img/product_images/camera.jpg" alt=""></td>
                    <td> 50000.00 &#2547;</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="number" name="quantity" min="1" max="5" class=" form-control col-sm-12" placeholder="Select" selected="selected">
                            </div>
                            <div class="col-sm-6">
                                <a name="" id="" class="btn btn-primary col-sm-12" href="#" role="button"><i class="fas fa-edit"></i> Update</a></>
                            </div>
                        </div>
                    </td>
                    <td style="display:block;text-align:right;">50,000.00 <b>&#2547;</b></td>
                    <td>
                        <a href="" class="btn btn-sm btn-danger"> Delete</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="">

                    </td>
                    <td colspan="2" class="">
                        <span style="display:block;text-align:right;font-weight:bold;color:#666;">Sub total : 50,000.00 <b>&#2547;</b></span>

                        <span style="display:block;text-align:right;font-weight:bold;color:#666;margin-bottom:10px;">Vat- 15% : 7,500.00 <b>&#2547;</b></span>

                        <span style="display:block;text-align:right;font-weight:700;font-size:18px;">Grand total: Tk- 57,500.00 <b>&#2547;</b></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row text-center">
            <div class="col-sm-6">
                <a href="" class="btn btn-md btn-primary"> <i class="fas fa fa-cart-plus"></i> Continue Shopping</a>
            </div>
            <div class="col-sm-6">
                <a href="" class="btn btn-md btn-warning"> <i class="fas fa-check-circle"></i> Check out</a>
            </div>
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
