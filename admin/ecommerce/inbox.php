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
        $tableCustomer = 'tbl_customer';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Orders inbox page<small>it all starts here</small></h1>
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
                    <h3 class="box-title"><a class="btn btn-sm btn-primary" href="addProduct.php">
                            <i class="fa fa-plus"></i> Add Products data</a>
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
                                    <th>Prod Name</th>
                                    <th>Pro Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>CustomerId</th>
                                    <th>Address</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $customerOrderDetails = $cart->customerOrders($tableOrders);
                                if (!empty($customerOrderDetails)) {
                                    foreach ($customerOrderDetails as $result) {
                                        ?>
                                        <tr>
                                            <td><?php echo $result->order_id; ?>
                                            </td>
                                            <td><?php echo $helpers->dateFormat($result->ordered_on); ?>
                                            </td>
                                            <td><?php echo $result->pro_name; ?>
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
                                                <?php echo $result->customer_id; ?>
                                            </td>
                                            <td>
                                                <a href="customer.php?customer_id=<?= $result->customer_id; ?>"> View details</a>
                                            </td>
                                            <td>
                                                <?php if (empty($result->photo)) { ?>
                                                    <img src="../gallery/avatar/avatar.png" alt="Alternative Image" style="width:50px;height:50px;">
                                                <?php } else { ?>
                                                    <img src="<?php echo $result->photo; ?>" class="img-thumbnail" style="width:50px;height:50px;" alt="Product Photo">
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <?php if ($_SESSION['userEmail'] == $user_home->getEmail()) { ?>
                                                    <?php if ($result->status == '0') { ?>
                                                        <a class="btn btn-sm btn-primary buttons" data-toggle="tooltip" title="Shift order data" href="?shifting_id=<?php echo $result->order_id; ?> && price=<?= $result->pro_price; ?> && date=<?= $result->ordered_on; ?>"><i class="fa fa-paper-plane"></i> Shift</a>
                                                    <?php } else { ?>

                                                        <a class="btn btn-sm btn-danger buttons" data-toggle="tooltip" title="Remove order" href="?shifting_id=<?php echo $result->order_id; ?> && price=<?= $result->pro_price; ?> && date=<?= $result->ordered_on; ?>"><i class="fa fa-trash"></i> Remove</a>
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
                                    <th>Prod Name</th>
                                    <th>Pro Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>CustomerId</th>
                                    <th>Address</th>
                                    <th>Photo</th>
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
