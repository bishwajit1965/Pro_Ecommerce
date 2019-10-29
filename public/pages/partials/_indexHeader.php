<div class="row pt-1 header-area">
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <h1 id="heading">Ecommerce site</h1>
        <h2>Your favourite web store</h3>
            <h3> Serving since 1995</h3>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center text-center">
        <div class="search-container">
            <form action="#">
                <input type="text" class="p-1 pl-2" placeholder="Search..." name="search">
                <button type="submit" class="bg-warning"><i class="fa fa-search p-1"></i></button>
            </form>
        </div>
    </div>
    <div class="col-sm-2 d-flex flex-column justify-content-center text-center">
        <form action="#">
            <div class="input-group input-group-sm p-1">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning pb-2 px-2"><i class="fas fa-cart-plus"></i></span>
                </div>
                <?php
                include_once '../admin/app/start.php';

                use Codecourse\Repositories\Session as Session;
                use Codecourse\Repositories\Cart as Cart;

                $customerId = Session::get('customerId');
                $tableOrders = 'tbl_orders';
                $cart = new Cart();
                $orderRelatedCustomerIdData = $cart->checksCustomerIdInOrdersTable($customerId, $tableOrders);
                if (!empty($orderRelatedCustomerIdData)) {
                    $quantity = 0;
                    $sum = 0;
                    foreach ($orderRelatedCustomerIdData as $orderData) {
                        $quantity = $quantity + $orderData->pro_quantity;
                        $sum = $sum + $orderData->total_price;
                    }
                    $vat = $sum * 0.15;
                    $grandTotal = $sum + $vat;
                }
                ?>
                <input type="text" name="total_price" class="form-control form-control-sm" placeholder="<?php if (!empty($quantity) && !empty($grandTotal)) {
                                                                                                            echo 'Q:' . $quantity . '|P :' . number_format($grandTotal, 2, '.', '') . '&#2547;';
                                                                                                        } else {
                                                                                                            echo "Log in please !!!";
                                                                                                        } ?>">
            </div>
        </form>
    </div>
    <div class="col-sm-4 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-sm-7 social-links d-flex flex-row justify-content-between">
                <a href=""><i class="fab fa-facebook-square"></i> </a>
                <a href=""><i class="fab fa-linkedin"></i> </a>
                <a href=""><i class="fab fa-twitter"></i> </a>
                <a href=""><i class="fab fa-google-plus"></i> </a>
                <a href=""><i class="fab fa-github"></i> </a>
            </div>
            <div class="col-sm-5 d-flex flex-row justify-content-between log-in">
                <?php
                $session = Session::checkLogin();
                if ($session == true) { ?>
                    <form action="pages/processLogin.php" method="post">
                        <input type="hidden" name="action" value="verify">
                        <button type="submit" name="submit" value="log_out" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                <?php
                } else {
                    ?>
                    <form action="pages/login.php" method="post">
                        <button type="submit" class="btn btn-sm btn-info">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>&nbsp;&nbsp;

                    <form action="pages/registerForm.php" method="post">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-user-plus"></i> Register
                        </button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="float-right px-2" style="margin-left:auto;font-weight:600;font-size:21px;color:#dbdbdb;text-shadow:1px 2px 3px #000;">
        <?php
        if (isset($_SESSION['login'])) {
            $sessionEmail = $_SESSION['login'];
            echo isset($sessionEmail) ? 'Welcome !!! you are logged in - ' . $sessionEmail : ' ';
        } else {
            echo "You are not logged in !!!";
        }
        ?>
    </div>
</div>
