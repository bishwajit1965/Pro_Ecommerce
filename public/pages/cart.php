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
                <h3>
                    <span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i>
                        <sup>
                            <?php
                            $numberOfItems = $cart->numberOfRows($table, $sessionId);
                            if (!empty($numberOfItems)) {
                                echo $numberOfItems;
                            }
                            ?>
                        </sup>
                    </span class="badge badge-secondary">
                </h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container pb-3">
        <?php
        // Will display messages
        $message = Session::get('message');
        if (!empty($message)) {
            echo $message;
            Session::set('message', null);
        }
        ?>
        <table class="table table-striped table-condensed table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th width:"2%">Id</th>
                    <th width:"20%">Prod Name</th>
                    <th width:"15%">Prod Image</th>
                    <th width:"18%">Pro Price</th>
                    <th width:"15%">Pro Quantity</th>
                    <th width:"20%">Total Price</th>
                    <th width:"10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cartData = $cart->index($table, $sessionId);
                if (!empty($cartData)) {
                    $i = 0;
                    $sum = 0;
                    foreach ($cartData as $cart) {
                        $i++; ?>
                        <tr>
                            <td scope="row"><?= $i; ?>
                            <td scope="row"><?= isset($cart->pro_name) ? $cart->pro_name : ''; ?>
                            </td>
                            <td><img class="" src="../../admin/ecommerce/<?= $cart->photo; ?>" alt="<?= $cart->pro_name; ?>" style="width:45px;height:35px;"></td>
                            <td><?= isset($cart->pro_price) ? number_format($cart->pro_price, 2, '.', '') : ''; ?>
                                <b> &#2547;</b></td>
                            <td>
                                <form action="processCart.php" method="post">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="number" name="pro_quantity" value="<?= isset($cart->pro_quantity) ? $cart->pro_quantity : ''; ?>" min="1" max="25" class="form-control form-control-sm" placeholder="Select" selected="selected">
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="hidden" name="action" value="verify">
                                            <input type="hidden" name="pro_id" value="<?= $cart->pro_id; ?>">

                                            <button type="submit" name="submit" value="update-cart-item" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Update</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="display:block;text-align:right;"><?php $total = $cart->pro_price * $cart->pro_quantity;
                                                                                echo isset($total) ? number_format($total, 2, '.', '') : ''; ?>
                                <b>&#2547;</b></td>
                            <td>
                                <form action="processCart.php" method="post">
                                    <input type="hidden" name="action" value="verify">
                                    <input type="hidden" name="cart_id" value="<?= $cart->cart_id; ?>">
                                    <button type="submit" name="submit" value="delete" class="btn btn-sm btn-danger" onClick="return confirm('Do ypuy really want to delete this data ? If not click cancel button');">
                                        <i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                            // Grand tgotal calculation
                            if ($sum !== null) {
                                $sum = $sum + $total;
                            }
                        }
                    } else {
                        ?>
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>SORRY !</strong> There is no data avaiable in the cart table.
                    </div>
                <?php
                }
                ?>
                <tr>
                    <td colspan="7" class="bg-dark text-white " style="padding-right:140px;">
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-3">
                                <span style="display:block;text-align:right;font-weight:bold;color:#FFF;font-size:14px;">
                                    Sub total :
                                    <?php
                                    if (!empty($sum)) {
                                        echo number_format($sum, 2, '.', '');
                                    }
                                    ?>
                                    <b>&#2547;</b>
                                </span>
                                <span style="margin-left:auto;">+</span>
                                <span style="display:block;text-align:right;font-weight:bold;color:#FFF;margin-bottom:10px;border-bottom:3px solid #DDD;font-size:14px;">
                                    Vat - 15% :
                                    <?php
                                    if (!empty($sum)) {
                                        $vat = $sum * 0.15;
                                        echo number_format($vat, 2, '.', '');
                                    }
                                    ?>
                                    <b>&#2547;</b>
                                </span>
                                <span style="display:block;text-align:right;font-weight:700;font-size:14px;color:#FFF;">
                                    Grand total :
                                    <?php
                                    if (!empty($sum) && !empty($vat)) {
                                        $grandTotal = $sum + $vat;
                                        echo number_format($grandTotal, 2, '.', '');
                                    }
                                    ?>
                                    <b> &#2547; </b></span>
                            </div>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row d-dlex flex-row justify-content-around">
            <a href=" ../index.php" class="btn btn-sm btn-primary"><i class="fas fa-fast-backward"> </i> Home page</a>
            <form action="processCart.php" method="post">
                <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"> </i>
                    Process Cart </button>
            </form>
            <form action="processProductCart.php" method="post">
                <button type="submit" name="submit" class="btn btn-sm btn-warning"><i class="fas fa-cart-plus"> </i>
                    Check out </button>
            </form>
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
