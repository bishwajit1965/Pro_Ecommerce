<?php
require_once 'Classloader.php';

use Codecourse\Repositories\Session as Session;

Session::init();
Session::checkSession();
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
                <h2>Your Single Product in Detail</h2>
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
        <div class="row">
            <div class="col-sm-6">
                <!-- Will display validation messages -->
                <?php
                include_once 'validationMessage.php';
                ?>
                <!-- /Will display validation messages -->
                <div class="wrapper" style="border:1px solid#DDD;">
                    <table class="table table-condensed  table-sm table-striped mb-0">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Pro Name</th>
                                <th>Pro Image</th>
                                <th style="text-align:right;">Pro price</th>
                                <th style="text-align:left;">Pro Qunty</th>
                                <th style="text-align:right;">Total Price</th>
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
                                <td scope="row"><?= $i; ?></td>
                                <td cope="row"><?= isset($cart->pro_name) ? $cart->pro_name : ''; ?></td>
                                <td><img class="" src="../../admin/ecommerce/<?= $cart->photo; ?>"
                                        alt="<?= $cart->pro_name; ?>" style="width:45px;height:35px;"></td>
                                <td style="display:block;text-align:right;">
                                    <?= isset($cart->pro_price) ? number_format($cart->pro_price, 2, '.', '') : ''; ?>
                                    <b> &#2547;</b></td>
                                <td style="text-align:left;">
                                    <!-- <?= isset($cart->pro_quantity) ? $cart->pro_quantity : ''; ?> -->
                                    <div>
                                        <form action="processCart.php" method="post">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="number" name="pro_quantity"
                                                        value="<?= isset($cart->pro_quantity) ? $cart->pro_quantity : ''; ?>"
                                                        min="1" max="25" class="form-control form-control-sm"
                                                        placeholder="Select" selected="selected">
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
                                    </div>
                                </td>
                                <td style="display:block;text-align:right;">
                                    <?php $total = $cart->pro_price * $cart->pro_quantity;
                                                    echo isset($total) ? number_format($total, 2, '.', '') : ''; ?>
                                    <b>&#2547;</b></td>
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
                                <strong>SORRY !!!</strong> There is no product avaiable in the cart at present.
                            </div>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="bg-light">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="row d-dlex flex-row justify-content-around"
                                                style="padding-top:35px;">
                                                <a href=" ../index.php" class="btn btn-sm btn-primary"><i
                                                        class="fas fa-cart-plus">
                                                    </i> Cintinue shopping</a>
                                                <?php
                                                if (!empty($cartData)) {
                                                    ?>
                                                <form action="processCart.php" method="post">
                                                    <input type="hidden" name="action" value="verify">
                                                    <button type="submit" name="submit" value="order"
                                                        class="btn btn-sm btn-danger"><i class="fas fa-folder-plus"></i>
                                                        Order now</button>
                                                </form>
                                                <form action="cart.php" method="post">
                                                    <button type="submit" name="submit" class="btn btn-sm btn-info"><i
                                                            class="fas fa-cart-plus"> </i>
                                                        Cart </button>
                                                </form>
                                                <?php
                                                } else { }
                                                ?>

                                            </div>

                                        </div>

                                        <div class="col-sm-5">
                                            <span
                                                style="display:block;text-align:right;font-weight:bold;color:#000;font-size:14px;">
                                                Sub total :
                                                <?php
                                                if (!empty($sum)) {
                                                    echo number_format($sum, 2, '.', '');
                                                }
                                                ?>
                                                <b>&#2547;</b>
                                            </span>
                                            <span style="margin-left:auto;">+</span>
                                            <span
                                                style="display:block;text-align:right;font-weight:bold;color:#000;margin-bottom:10px;border-bottom:3px solid #a6a6a6;font-size:14px;">
                                                Vat - 15% :
                                                <?php
                                                if (!empty($sum)) {
                                                    $vat = $sum * 0.15;
                                                    echo number_format($vat, 2, '.', '');
                                                }
                                                ?>
                                                <b>&#2547;</b>
                                            </span>
                                            <span
                                                style="display:block;text-align:right;font-weight:800;font-size:16px;color:#000;">
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
                        <tfoot class="thead-inverse">
                            <tr>
                                <th colspan="7" class="text-center py-2">

                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <table class="table table-condensed  table-sm table-striped mb-0 p-3">
                    <thead class="thead-inverse">
                        <tr>
                            <th colspan="3" class="text-center py-">
                                <h3>Customer Profile Data</h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody style="border:1px solid#DDD;">
                        <?php
                        $customerData = $customerProfile->customerIndex($tableCustomer);
                        foreach ($customerData as $customer) {
                            if (Session::get('login') ==  $customer->email) {
                                ?>
                        <tr>
                            <th style="width:100px;">ID</th>
                            <td>:</td>
                            <td><?php echo $customer->id; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>:</td>
                            <td><?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td><?php echo $customer->email; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>:</td>
                            <td><?php echo $customer->phone; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:</td>
                            <td><?php echo $customer->address; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Countery</th>
                            <td>:</td>
                            <td><?php echo $customer->country; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td>:</td>
                            <td><?php echo $customer->zip_code; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>:</td>
                            <td><?php echo $helpers->dateFormat($customer->created_at); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Actions</th>
                            <td>:</td>
                            <td>
                                <form action="processCustomerProfile.php" method="post">
                                    <a href="editCustomerProfile.php?edit_customer_id=<?php echo $customer->id; ?>"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit </a>

                                    <input type="hidden" name="action" value="verify">
                                    <input type="hidden" name="delete_customer_id" value="<?php echo $customer->id; ?>">

                                    <button type="submit" name="submit"
                                        onClick="return confirm('Afe you sure of deleting this dfata ? Once lost, lost for ever.')"
                                        class="btn btn-sm btn-danger" value="delete"> <i class="fas fa-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot class="thead-inverse">
                        <tr>
                            <th colspan="3" class="text-center py-2"></th>
                        </tr>
                    </tfoot>
                </table>
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