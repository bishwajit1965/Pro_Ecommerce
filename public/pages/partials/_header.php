<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;
?>
<div class="row pt-1 header-area">
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <h1 id="heading">Ecommerce site</h1>
        <h2>Your favourite web store</h3>
            <h3> Serving since 1995</h3>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center text-center">
        <div class="search-container">
            <form action="#">
                <input type="text" class="pl-2 p-1" placeholder="Search..." name="search">
                <button type="submit" class="bg-warning"><i class="fa fa-search p-1"></i></button>
            </form>
        </div>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <form action="#">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning pb-2 px-2"><i class="fas fa-cart-plus"></i></span>
                </div>
                <?php
                switch ($current_page) {
                    case 'cart':
                        $cartData = $cart->priceDisplay($tableCart, $sessionId);
                        if (!empty($cartData)) {
                            $sum = 0;
                            $quantity = 0;
                            foreach ($cartData as $carts) {
                                $total = $carts->pro_price * $carts->pro_quantity;
                                if ($sum !== null) {
                                    $sum = $sum + $total;
                                    $quantity = $quantity + $carts->pro_quantity;
                                }
                            }
                        } else {
                            $message = "Empty cart. You may place order.";
                        }
                        break;
                    case 'payment':
                        $cartData = $cart->priceDisplay($tableCart, $sessionId);
                        if (!empty($cartData)) {
                            $sum = 0;
                            $quantity = 0;
                            foreach ($cartData as $carts) {
                                $total = $carts->pro_price * $carts->pro_quantity;
                                if ($sum !== null) {
                                    $sum = $sum + $total;
                                    $quantity = $quantity + $carts->pro_quantity;
                                }
                            }
                        } else {
                            $message = "Empty cart. You may place order.";
                        }
                        break;
                    case 'paymentOffLine':
                        $cartData = $cart->priceDisplay($tableCart, $sessionId);
                        if (!empty($cartData)) {
                            $sum = 0;
                            $quantity = 0;
                            foreach ($cartData as $carts) {
                                $total = $carts->pro_price * $carts->pro_quantity;
                                if ($sum !== null) {
                                    $sum = $sum + $total;
                                    $quantity = $quantity + $carts->pro_quantity;
                                }
                            }
                        } else {
                            $message = "Empty cart. You may place order.";
                        }
                        break;
                    case 'order':
                        $customerOrderDetails = $cart->customerOrderDetails($tableOrders, $customerId);
                        if (!empty($customerOrderDetails)) {
                            $sum = 0;
                            $quantity = 0;
                            foreach ($customerOrderDetails as $carts) {
                                $total = $carts->pro_price * $carts->pro_quantity;
                                if ($sum !== null) {
                                    $sum = $sum + $total;
                                    $quantity = $quantity + $carts->pro_quantity;
                                }
                            }
                        } else {
                            $message = "Empty cart. You may place order.";
                        }
                        break;
                    case 'orderDetails':
                        $customerOrderDetails = $cart->customerOrderDetails($tableOrders, $customerId);
                        if (!empty($customerOrderDetails)) {
                            $sum = 0;
                            $quantity = 0;
                            foreach ($customerOrderDetails as $carts) {
                                $total = $carts->pro_price * $carts->pro_quantity;
                                if ($sum !== null) {
                                    $sum = $sum + $total;
                                    $quantity = $quantity + $carts->pro_quantity;
                                }
                            }
                        } else { }
                        break;
                    case 'customerProfileIndex':
                        $message = "You can only update your profile!";
                        break;
                    case 'single':
                        $message = "Place order now !";
                        break;
                    default:
                        $message = "Place order";
                        break;
                }
                ?>

                    <input type="text" disabled="disabled" class="form-control form-control-sm" placeholder="<?php
                                                                                                                if (isset($sum)  && isset($quantity)) {
                                                                                                                    echo "Qty:" . $quantity . '|' . "Pri:" . number_format($sum, 2, '.', '') . ' + Vat due (15%)' . '&#2547; ';
                                                                                                                } else {
                                                                                                                    echo $message;
                                                                                                                }
                                                                                                                ?>">
            </div>
        </form>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-sm-8 d-flex justify-content-between social-links">
                <a href=""><i class="fab fa-facebook text-white"></i></a>
                <a href=""><i class="fab fa-linkedin text-white"></i></a>
                <a href=""><i class="fab fa-twitter text-white"></i></a>
                <a href=""><i class="fab fa-google-plus text-white"></i></a>
                <a href=""><i class="fab fa-github text-white"></i></a>
            </div>
            <div class="col-sm-4 d-flex justify-content-between log-in">
                <?php
                if (Session::checkLogin() == true) { ?>
                    <form action="processLogin.php" method="post">
                        <input type="hidden" name="action" value="verify">
                        <input type="hidden" name="session_id" value="<?php echo $carts->session_id; ?>">
                        <button type="submit" name="submit" value="log_out" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                <?php
                } else {
                    ?>
                    <form action="pages/login.php" method="post">
                        <button type="submit" class="btn btn-sm btn-info">
                            Login
                        </button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class=" px-2" style="margin-left:auto;font-weight:600;font-size:21px;color:#dbdbdb;text-shadow:1px 2px 3px #000;">
        <?php
        if (isset($_SESSION['login'])) {
            $sessionEmail = $_SESSION['login'];
            echo isset($sessionEmail) ? 'Welcome !!! you are logged in - ' . $sessionEmail : ' ';
        }
        ?>
    </div>
</div>
