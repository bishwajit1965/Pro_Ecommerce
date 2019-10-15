<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Cart as Cart;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\Session as Session;

Session::init();
Session::checkSession();

$sessionId = session_id();
$cart = new Cart();
$product = new Products();
$table = 'tbl_cart';
?>
<div class="row pt-1 header-area">
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <h1 id="heading">Ecommerce site</h1>
        <h3>Your favourite web store</h3>
        <h3> Serving since 1995</h3>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center text-center">
        <div class="search-container">
            <form action="#">
                <input type="text" class="pl-2" placeholder="Search..." name="search">
                <button type="submit" class="bg-warning"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <form action="#">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning"><i class="fas fa-cart-plus px-2 py-1"></i></span>
                </div>
                <?php
                $cartData = $cart->priceDisplay($table, $sessionId);
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
                }
                ?>
                <input type="text" class="form-control p-0 pl-1" placeholder="<?php if (!empty($sum)) : echo 'Qty : ' . $quantity . ' || ' . 'Price: ' . number_format($sum, 2, '.', '') . ' &#2547; '; ?>
              <?php else :
                    echo "Empty cart"; ?>
                <?php endif ?>">

            </div>
        </form>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-sm-8 social-links">
                <a href=""><i class="fab fa-facebook-square"></i> </a>
                <a href=""><i class="fab fa-linkedin"></i> </a>
                <a href=""><i class="fab fa-twitter"></i> </a>
                <a href=""><i class="fab fa-google-plus"></i> </a>
                <a href=""><i class="fab fa-github"></i> </a>
            </div>
            <div class="col-sm-3 d-flex flex-row justify-content-center log-in">
                <?php
                if (Session::checkLogin() == true) { ?>
                    <form action="processLogin.php" method="post">
                        <input type="hidden" name="action" value="verify">
                        <button type="submit" name="submit" value="log_out" class="btn btn-sm btn-danger">Logout</button>
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
    <div class="float-right px-2" style="margin-left:auto;font-weight:800;font-size:22px;color:#dbdbdb;text-shadow:1px 2px 3px #000;">
        <?php
        if (isset($_SESSION['login'])) {
            $sessionEmail = $_SESSION['login'];
            echo isset($sessionEmail) ? 'Welcome !!! you are logged in - ' . $sessionEmail : ' ';
        }
        ?>
    </div>
</div>
