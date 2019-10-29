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
        <?php include_once 'partials/_navbar.php'; ?>
        <!-- /Navbar ends -->

        <!-- Page title -->
        <div class="row text-center bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 pt-2">
                <h2>Choose a payment option</h2>
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
    <!-- Content area begins -->
    <div class="container-fluid bg-light">
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-4 py-4">
                <div class="payment-option d-flex justify-content-between mt-3 mb-3">
                    <a href="paymentOnLine.php" class="btn btn-lg btn-primary"><i class="fas fa-signal"></i> Online
                        payment</a>
                    <a href="paymentOffLine.php" class="btn btn-lg btn-info"><i class="fas fa-receipt"></i> Offline
                        payment</a>
                </div>
                <div class="cart-back d-flex justify-content-center mb-4">
                    <a href="cart.php" class="btn btn-block btn-lg btn-success"><i class="fas fa-cart-plus"></i>
                        Cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content area ends -->

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
