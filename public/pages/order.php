<?php include_once '../partials/_head.php';

use Codecourse\Repositories\Session as Session;

Session::init();
?>

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
                <!-- <h2>Your processed order data here !!!</h2> -->
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span
                        class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container-fluid bg-light">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-10 processed-order">
                <style>
                .processed-order>p {
                    border: 2px solid#DDD;
                    padding: 20px;
                    backgeound-color: #edeff0;
                    font-size: 20px;
                    line-height: 30px;
                    margin-top: 0px;
                    /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                    0 6px 20px 0 rgba(0, 0, 0, 0.19); */
                }
                </style>

                <div class="success-message text-center bg-dark text-white py-2 mb-0">
                    <h2>Order Successful !!!</h2>
                </div>
                <div class="message">
                    <?php
                    include_once 'validationMessage.php';
                    ?>

                </div>
                <p>
                    <?php
                    $customerId = Session::get('customerId');
                    $orderRelatedData = $cart->payableAmountForOrderedproducts($customerId, $tableOrders);
                    if ($orderRelatedData) {
                        $sum = 0;

                        foreach ($orderRelatedData as $orderPrice) {
                            $price =  $orderPrice->total_price;
                            $sum = $sum + $price;
                        }
                        $vat = $sum * 0.15;
                        $grandTotal = $sum + $vat;
                        ?>
                    <span style="color:red;font-size:20px;font-weight:700;text-align:center;">Total payable amount
                        (including 15% vat) :
                        <?= isset($grandTotal) ? number_format($grandTotal, 2, '.', '') : ''; ?>
                        <b>&#2547;</b>
                    </span>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae nihil dolorum, quibusdam tenetur
                    eum atque qui modi magnam, assumenda dignissimos ab architecto, eius aut consectetur repellendus
                    earum at quisquam fugiat! .....
                    <a href="orderDetails.php" class="btn btn-sm btn-info"> Visit here</a>
                </p>
                <?php
            }
            ?>
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