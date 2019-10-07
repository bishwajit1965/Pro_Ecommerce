<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\Cart as Cart;

Session::init();
Session::checkSession();

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
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>5</sup></span
                        class="badge badge-secondary"></h3>
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
                $cartData = $cart->index($table);
                if (!empty($cartData)) {
                    $i =0;
                    foreach ($cartData as $cart) {
                        $i++; ?>
                <tr>
                    <td scope="row"><?=$i; ?>
                    <td scope="row"><?=$cart->pro_name; ?>
                    </td>
                    <td><img class="" src="../../admin/ecommerce/<?=$cart->photo; ?>" alt="<?=$cart->pro_name; ?>"
                            style="width:50px;height:40px;"></td>
                    <td><?=$cart->pro_price; ?> <b> &#2547;</b></td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="number" name="quantity" value="<?= $cart->pro_quantity; ?>" min="1"
                                    max="25" class="form-control form-control-sm" placeholder="Select"
                                    selected="selected">
                            </div>
                            <div class="col-sm-6">
                                <form action="processProductcart.php" method="post">
                                    <input type="hidden" name="action" value="verify">
                                    <button type="submit" name="submit" value="update-cart-item"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Update</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td style="display:block;text-align:right;"><?=$cart->pro_price * $cart->pro_quantity; ?>
                        <b>&#2547;</b></td>
                    <td>
                        <form action="processCart.php" method="post">
                            <input type="hidden" name="action" value="verify">
                            <input type="hidden" name="cart_id" value="<?=$cart->cart_id; ?>">
                            <button type="submit" name="submit" value="delete" class="btn btn-sm btn-danger"
                                onClick="return confirm('Do ypuy really want to delete this data ? If not click cancel button');">
                                <i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                } else {
                }
                ?>
                <tr>
                    <td colspan="7" class="">
                        <span style="display:block;text-align:right;font-weight:bold;color:#666;">Sub total : 50,000.00
                            <b>&#2547;</b></span>
                        <span
                            style="display:block;text-align:right;font-weight:bold;color:#666;margin-bottom:10px;">Vat-
                            15% : 7,500.00 <b>&#2547;</b></span>
                        <span style="display:block;text-align:right;font-weight:700;font-size:18px;">Grand total: Tk-
                            57,500.00 <b>&#2547;</b></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row d-dlex flex-row justify-content-around">
            <a href=" ../index.php" class="btn btn-sm btn-primary"><i class="fas fa-fast-backward"> </i> Home page</a>
            <form action="processProductCart.php" method="post">
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