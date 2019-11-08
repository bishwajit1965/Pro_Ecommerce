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
                <h2>Your orders in detailed list</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-secondary"><i class="fas fa-cart-plus 4x">&nbsp;</i><sup class="bg-danger px-2">3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrapper">
                    <?php
                    include_once '../../admin/app/start.php';

                    use Codecourse\Repositories\Session as Session;
                    // Will display all the messages validation/insert/update/delete
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    ?>
                    <div class="table-responsive-sm">
                        <table class="table table-condensed ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>ID</th>
                                    <th>Pro Name</th>
                                    <th>Pro Image</th>
                                    <th style="text-align:right;">Pro Number</th>
                                    <th style="text-align:right;">Pro price</th>
                                    <th style="text-align:right;">Pro Qunty</th>
                                    <th style="text-align:right;">Total Price</th>
                                    <th style="text-align:right;">Ordered on</th>
                                    <th style="text-align:right;">Order Status</th>
                                    <th style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $customerOrderDetails = $cart->customerOrderDetails($tableOrders, $customerId);
                                if (!empty($customerOrderDetails)) {
                                    $i = 0;
                                    $sum = 0;
                                    foreach ($customerOrderDetails as $order) {
                                        $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= isset($order->pro_name) ? $order->pro_name : ''; ?></td>
                                            <td><img class="" src="../../admin/ecommerce/<?= $order->photo; ?>" alt="<?= $order->pro_name; ?>" style="width:45px;height:35px;"></td>
                                            <td style="text-align:right;">
                                                <?= isset($order->pro_number) ? $order->pro_number : ''; ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= isset($order->pro_price) ? number_format($order->pro_price, 2, '.', '') : ''; ?>
                                                <b> &#2547;</b></td>
                                            <td style="text-align:right;">
                                                <?= isset($order->pro_quantity) ? $order->pro_quantity : ''; ?>
                                            </td>

                                            <td style="text-align:right;">
                                                <?php $total = $order->pro_price * $order->pro_quantity;
                                                        echo isset($total) ? number_format($total, 2, '.', ',') : ''; ?>
                                                <b>&#2547;</b></td>
                                            <td style="text-align:right;">
                                                <?php echo  $helpers->dateFormat($order->ordered_on); ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php if ($order->status == '1') { ?>
                                                    <span style="color:#333;font-weight:700;"><?= "Processed"; ?></span>
                                                <?php } elseif ($order->status == '2') { ?>
                                                    <span class="btn btn-sm btn-success" style="color:#FFF;font-weight:700;"><?= "Confirmed"; ?> <i class="fas fa-check"></i> </span>
                                                <?php } else { ?>
                                                    <span style="color:#cd1f05;font-weight:700;"><?= "Pending"; ?></span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php if ($order->status == '0') {
                                                            echo 'N/A';
                                                        } elseif ($order->status == '1') { ?>
                                                    <form action="processCart.php" method="post">
                                                        <input type="hidden" name="action" value="verify">

                                                        <input type="hidden" name="order_id" value="<?= $order->order_id; ?>">

                                                        <input type="hidden" name="customer_id" value="<?= $order->customer_id; ?>">
                                                        <input type="hidden" name="status" value="<?= $order->status; ?>">

                                                        <input type="hidden" name="ordered_on" value="<?= $order->ordered_on; ?>">
                                                        <button type="submit" name="submit" value="confirm_order" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-check"></i> Confirm</button>
                                                    </form>
                                                <?php } else { ?>
                                                    <span class="btn btn-sm btn-danger"><i class="fas fa-check"></i> OK</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- Grand total calculation -->
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
                                        <strong>SORRY !!!</strong> There is no product available in the cart at present.
                                    </div>
                                <?php } ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="row d-dlex flex-row justify-content-around" style="padding-top:35px;">
                                                    <a href=" ../index.php" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus">
                                                        </i> Continue shopping</a>
                                                    <a href=" ../index.php" class="btn btn-sm btn-info"><i class="fas fa-fast-backward">
                                                        </i> Home page</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="price-calculation" style="padding-right:64.5%;">
                                                    <span style="display:block;text-align:right;font-weight:bold;color:#000;font-size:16px;">
                                                        Sub total :
                                                        <?php if (!empty($sum)) {
                                                            echo number_format($sum, 2, '.', ',');
                                                        } ?>
                                                        <b>&#2547;</b>
                                                    </span>
                                                    <span style="margin-left:auto;">+</span>
                                                    <span style="display:block;text-align:right;font-weight:bold;color:#000;margin-bottom:10px;border-bottom:3px solid #a6a6a6;font-size:16px;">
                                                        Vat - 15% :
                                                        <?php if (!empty($sum)) {
                                                            $vat = $sum * 0.15;
                                                            echo number_format($vat, 2, '.', ',');
                                                        } ?>
                                                        <b>&#2547;</b>
                                                    </span>
                                                    <span style="display:block;text-align:right;font-weight:800;font-size:18px;color:#000;">
                                                        Grand total :
                                                        <?php if (!empty($sum) && !empty($vat)) {
                                                            $grandTotal = $sum + $vat;
                                                            echo number_format($grandTotal, 2, '.', ',');
                                                        } ?>
                                                        <b> &#2547; </b></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="thead-inverse">
                                <tr>
                                    <th colspan="10" class="text-center py-2"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
