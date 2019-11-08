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
        <!-- <div class="row text-center bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 pt-2">
                <h2>Your orderedpPrice details</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div> -->
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <style>
                .total-amount {
                    font-size: 20px;
                    font-weight: 700;
                    color: #000;
                    border-bottom: 3px solid#00d9d9;
                    margin-top: 30px;
                }

                .greeting-message {
                    font-size: 20px;
                    font-weight: 500;
                    color: #444;
                }
            </style>
            <?php
            $customerOrderDetails = $cart->customerOrderDetails($tableOrders, $customerId);
            if ($customerOrderDetails) {
                $sum = 0;
                foreach ($customerOrderDetails as $orderPrice) {
                    $price =  $orderPrice->total_price;
                    $sum = $sum + $price;
                }
                $vat = $sum * 0.15;
                $grandTotal = $sum + $vat;
                ?>
                <div class="message d-flex justify-content-sm-center">
                    <h1 class="mb-1" style="font-weight:900;">WOW !!! order has been placed successfully !!!</h1>
                </div>
                <p class="total-amount">
                    Your total payable amount including 15% vat [ <span style="color:red;">(15% vat) <?= $vat !== null ?  number_format($vat, 2, '.', ',') : ''; ?> + <?= $sum !== null ? number_format($sum, 2, '.', ',') : ''; ?> (Price)</span> ] <span style="color:#0070df;font-size:26px;font-weight:900;">=<?= $grandTotal !== null ? number_format($grandTotal, 2, '.', ',') : ''; ?> <b>&#2547;</b> </span>
                </p>
            <?php } ?>
            <p class="greeting-message">
                Thanks for ordering. Your order will be processed soon. Yo will be informed
                about the order and the product will be delivered to your address as early as possible. Thakning you in
                anticipation. Keep well and keep ordering. We will try to serve with full sincerity and honesty. BYE BYE
                !!!
            </p>
            <a href="orderDetails.php" class="btn btn-sm btn-info mt-4 mr-1 mb-4"><i class="fas fa-eye"></i>
                View order details</a>

            <a href="../index.php" class="btn btn-sm btn-primary mt-4 mb-4"><i class="fas fa-cart-plus"></i>
                Continue shopping</a>
        </div>
    </div><!-- /Content area ends -->

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
</body>

</html>
