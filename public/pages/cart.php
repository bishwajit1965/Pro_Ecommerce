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
        <div class="row text-center bg-secondary text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 pt-2">
                <h2> Cart Products</h2>
            </div>
            <div class="col-sm-2">
                <h3>
                    <span class="badge"><i class="fas fa-cart-plus">&nbsp;</i>
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
        <?php
        include_once '../../admin/app/start.php';

        use Codecourse\Repositories\Session as Session;

        // Will display all the messages vlidation/insert/update/delete
        $message = Session::get('message');
        if (!empty($message)) {
            echo $message;
            Session::set('message', null);
        }
        ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <tr>
                        <th width="2%">Id</th>
                        <th width="15%">Prod Name</th>
                        <th width="13%">Prod Image</th>
                        <th width="13%">Prod Number</th>
                        <th width="17%">Pro Price</th>
                        <th width="15%">Pro Quantity</th>
                        <th width="10%" style="text-align:right;">Actions</th>
                        <th width="15%" style="text-align:right;">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cartData = $cart->index($tableCart, $sessionId);
                    if (!empty($cartData)) {
                        $i = 0;
                        $sum = 0;
                        foreach ($cartData as $cart) {
                            $i++; ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= isset($cart->pro_name) ? $cart->pro_name : ''; ?>
                        </td>
                        <td><img class="" src="../../admin/ecommerce/<?= $cart->photo; ?>" alt="<?= $cart->pro_name; ?>"
                                style="width:45px;height:35px;"></td>
                        <td>
                            <?= isset($cart->pro_number) ? $cart->pro_number : ''; ?>
                        </td>
                        <td style="">
                            <?= isset($cart->pro_price) ? number_format($cart->pro_price, 2, '.', ',') : ''; ?>
                            <b> &#2547;</b></td>

                        <td>
                            <form action="processCart.php" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" name="pro_quantity"
                                            value="<?= isset($cart->pro_quantity) ? $cart->pro_quantity : ''; ?>"
                                            min="1" autofocus max="25" class="form-control form-control-sm"
                                            selected="selected">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="action" value="verify">
                                        <input type="hidden" name="pro_id" value="<?= $cart->pro_id; ?>">

                                        <button type="submit" name="submit" value="update-cart-item"
                                            class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                                            Update</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td style="text-align:right;">
                            <form action="processCart.php" method="post">
                                <input type="hidden" name="action" value="verify">
                                <input type="hidden" name="cart_id" value="<?= $cart->cart_id; ?>">
                                <button type="submit" name="submit" value="delete" class="btn btn-sm btn-danger"
                                    onClick="return confirm('Do ypuy really want to delete this data ? If not click cancel button');">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                        <td style="display:block;text-align:right;">
                            <?php $total = $cart->pro_price * $cart->pro_quantity;
                                            echo isset($total) ? number_format($total, 2, '.', ',') : ''; ?>
                            <b>&#2547;</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Grand tgotal calculation -->
                            <?php if ($sum !== null) {
                                            $sum = $sum + $total;
                                        }
                                    }
                                } else { ?>
                            <div class="alert alert-primary alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>SORRY !!!</strong> There is no product avaiable in the cart at present.
                            </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <div class="row">
                                <div class="col-sm-9 py-5">
                                    <div class="row d-dlex flex-row justify-content-around">
                                        <a href="../index.php" class="btn btn-md btn-primary"><i
                                                class="fas fa-cart-plus">
                                            </i> Continue shopping</a>
                                        <?php if (!empty($cartData)) { ?>
                                        <form action="payment.php" method="post">
                                            <button type="submit" name="submit" class="btn btn-md btn-info"><i
                                                    class="fas fa-cart-plus"> </i>
                                                Check out </button>
                                        </form>
                                        <?php } else { } ?>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <span
                                        style="display:block;text-align:right;font-weight:bold;color:#000;font-size:14px;">
                                        Sub total :
                                        <?php if (!empty($sum)) {
                                                    echo number_format($sum, 2, '.', ',');
                                                } ?>
                                        <b>&#2547;</b>
                                    </span>
                                    <span style="margin-left:auto;"> + </span>
                                    <span
                                        style="display:block;text-align:right;font-weight:bold;color:#000;margin-bottom:10px;border-bottom:3px solid #a6a6a6;font-size:14px;">
                                        Vat - 15% :
                                        <?php if (!empty($sum)) {
                                                    $vat = $sum * 0.15;
                                                    echo number_format($vat, 2, '.', ',');
                                                } ?>
                                        <b>&#2547;</b>
                                    </span>
                                    <span
                                        style="display:block;text-align:right;font-weight:800;font-size:16px;color:#000;">
                                        Grand total :
                                        <?php if (!empty($sum) && !empty($vat)) {
                                                    $grandTotal = $sum + $vat;
                                                    echo number_format($grandTotal, 2, '.', ',');
                                                } ?><b> &#2547; </b>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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