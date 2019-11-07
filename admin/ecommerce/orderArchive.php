<?php include_once '../partials/_head.php'; ?>
<!-- Site wrapper -->
<div class="wrapper">
    <?php include_once '../partials/_header.php'; ?>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <?php include_once '../partials/_leftSidebar.php'; ?>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php

        use Codecourse\Repositories\Session as Session;

        Session::init();
        $customerId = Session::get('customerId');
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Orders archive page<small>it all starts here</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <a class="btn btn-sm btn-primary" href="addProduct.php">
                            <i class="fa fa-plus"></i> Add Products data</a>
                        <a class="btn btn-sm btn-success" href="inbox.php">
                            <i class="fa fa-fast-backward"></i> Order index</a>
                        <span class="label label-success">
                            Products </span><sup><span class="label label-danger">
                                <?php
                                if ($products->numberOfRows($table) == '') {
                                    echo "0";
                                } else {
                                    echo $products->numberOfRows($table);
                                } ?>
                        </sup>
                        </span>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <style>
                        * {
                            box-sizing: border-box;
                        }

                        .zoom {
                            padding: 1px;
                            background-color: #DDD;
                            transition: transform .2s;
                            width: 50px;
                            height: 52px;
                            margin: 0 auto;
                            border-radius: 5px;
                        }

                        .zoom:hover {
                            -ms-transform: scale(5.5);
                            /* IE 9 */
                            -webkit-transform: scale(5.5);
                            /* Safari 3-8 */
                            transform: scale(5.5);
                        }
                    </style>
                    <?php
                    // Will display all the messages vlidation/insert/update/delete
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    // Get the delete id
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];
                        $dataDestroyed = $products->destroy($id, $table);
                        if ($dataDestroyed) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                            <strong> WOW !</strong> Data has been removed from database !!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'ecommerceIndex.php';
                            $products->redirect($home_url);
                        }
                    }

                    ?>
                    <div class="table-responsive-sm">
                        <table id="example1" class="table table-bordered table-sm table-condensed table-striped table-compact">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>P_Name</th>
                                    <th>P_Number</th>
                                    <th>P_Price</th>
                                    <th>P_Qty</th>
                                    <th>Tot_Price</th>
                                    <th>Photo</th>
                                    <th>Cust_Id</th>
                                    <th>Ord_Status</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $customerOrderArchive = $cart->customersOrdersArchive($tableOrdersArchive);
                                if (!empty($customerOrderArchive)) {
                                    foreach ($customerOrderArchive as $result) {
                                        ?>
                                        <tr>
                                            <td><?php echo $result->order_id; ?>
                                            </td>
                                            <td><?php echo $helpers->dateFormat($result->ordered_on); ?>
                                            </td>
                                            <td><?php echo $result->pro_name; ?>
                                            </td>
                                            <td><?php echo $result->pro_number; ?>
                                            </td>
                                            <td>
                                                <?php $price = $result->pro_price;
                                                        echo number_format($price, 2, '.', '') . ' &#2547'; ?>
                                            </td>

                                            <td>
                                                <?php echo $result->pro_quantity; ?>
                                            </td>
                                            <td>
                                                <?php echo $result->total_price; ?>
                                            </td>
                                            <td>
                                                <?php if (empty($result->photo)) { ?>
                                                    <div class="zoom">
                                                        <img id="image" src="../gallery/avatar/avatar.png" alt="Alternative Image" style="width:50px;height:50px;"></div>
                                                <?php } else { ?>
                                                    <div class="zoom">
                                                        <img id="image" src="<?php echo $result->photo; ?>" class="img-thumbnail" style="width:50px;height:50px;" alt="Product Photo"></div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php echo $result->customer_id; ?>
                                            </td>
                                            <td>
                                                <?php if ($result->status == '0') { ?>
                                                    <span style="color:#cd1f05;font-weight:700;"><?= "Pending"; ?></span>
                                                <?php } elseif ($result->status == '1') { ?>
                                                    <span style="color:#000;font-weight:700;"><?= "Processed"; ?></span>
                                                <?php } elseif ($result->status == '3') { ?>
                                                    <span data-toggle="tooltip" title="Your product will be delivered soon !!!" style="color:#0076ec;font-weight:800;"><?= "Confirmed"; ?></span>
                                                <?php } else { } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-success" href="customer.php?customer_id=<?= $result->customer_id; ?>"> View details</a>
                                            </td>
                                            <td>
                                                <?php if ($_SESSION['userEmail'] == $user_home->getEmail()) { ?>
                                                    <?php if ($result->status == '0') { ?>
                                                        <form action="processOrders.php" method="post">

                                                            <input type="hidden" name="order_id" value="<?php echo $result->order_id; ?>">

                                                            <input type="hidden" name="pro_price" value="<?= $result->pro_price; ?>">

                                                            <input type="hidden" name="ordered_on" value="<?= $result->ordered_on; ?>">

                                                            <input type="hidden" name="status" value="<?= $result->status; ?>">

                                                            <input type="hidden" name="action" value="verify">

                                                            <button type="submit" data-toggle="tooltip" title="Shift order" name="submit" value="update-status" class="btn btn-xs btn-primary"><i class="fa fa-paper-plane"></i> Shift order</button>

                                                        </form>
                                                    <?php } elseif ($result->status == '1') { ?>
                                                        <form action="processOrders.php" method="post">

                                                            <input type="hidden" name="order_id" value="<?php echo $result->order_id; ?>">

                                                            <input type="hidden" name="pro_price" value="<?= $result->pro_price; ?>">

                                                            <input type="hidden" name="ordered_on" value="<?= $result->ordered_on; ?>">

                                                            <input type="hidden" name="status" value="<?= $result->status; ?>">

                                                            <input type="hidden" name="action" value="verify">

                                                            <button type="submit" data-toggle="tooltip" title="Revoke order" name="submit" value="revoke_status" class="btn btn-xs btn-info"><i class="fa fa-paper-plane"></i> Revoke Order</button>

                                                        </form>
                                                    <?php } elseif ($result->status == '3') { ?>
                                                        <form action="processOrders.php" method="post">

                                                            <input type="hidden" name="action" value="verify">

                                                            <input type="hidden" name="order_id" value="<?php echo $result->order_id; ?>">

                                                            <input type="hidden" name="customer_id" value="<?php echo $result->customer_id; ?>">

                                                            <input type="hidden" name="ordered_on" value="<?php echo $result->ordered_on; ?>">

                                                            <input type="hidden" name="status" value="<?php echo $result->status; ?>">

                                                            <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Archive order" name="submit" value="delete" onClick="return confirm('Are you sure of archiving this order ?');"> <i class="fa fa-trash"></i> Delete</button>

                                                        </form>
                                                    <?php } else { ?>
                                            </td>
                                        <?php } ?>

                                    <?php } else { ?>
                                        <td>
                                            <a class="btn btn-xs btn-primary buttons" href="editProduct.php?edit_id=<?php echo $result->pro_id; ?>">
                                                <i class="fa fa-eye"></i> View</a><?php } ?>
                                        </td>
                                        </tr>
                                <?php
                                    }
                                } ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>P_Name</th>
                                    <th>P_Number</th>
                                    <th>P_Price</th>
                                    <th>P_Qty</th>
                                    <th>Tot_Price</th>
                                    <th>Photo</th>
                                    <th>Cust_Id</th>
                                    <th>Ord_Status</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
                    <!-- Code above -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">Footer</div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once '../partials/_footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
