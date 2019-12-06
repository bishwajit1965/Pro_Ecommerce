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
        include_once '../../admin/app/start.php';
        // Class is instantiated
        use Codecourse\Repositories\Invoice as Invoice;
        use Codecourse\Repositories\Helpers as Helper;
        use Codecourse\Repositories\Session as Session;

        $invoice = new Invoice();
        $helper = new Helper;
        $sessionId = session_id();
        Session::init();
        $table = 'tbl_invoice';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Invoice index page<small>it all starts here</small></h1>
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
                    <h3 class="box-title"><a class="btn btn-sm btn-primary" href="addCategory.php">
                            <i class="fa fa-plus"></i> Add category data</a> <span class="label label-success">
                            Invoices </span><sup><span
                                class="label label-danger"><?php echo $invoice->numberOfRows($tableInvoice, $sessionId); ?></sup>
                        </span>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"><i class="fa fa-times"></i></button>
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
                    ?>
                    <table id="example1" class="table table-bordered table-condensed table-striped table-small">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>PrId</th>
                                <th>OrId</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Vat 15%</th>
                                <th>Gr-Total</th>
                                <th>Ordered on</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $invoiceData = $invoice->retrieveDataFromInvoice($tableInvoice);
                            if (!empty($invoiceData)) {
                                $id = 1;
                                foreach ($invoiceData as $result) {
                                    ?>
                            <tr>
                                <td><?php echo $id++; ?></td>
                                <td><?php echo $result->pro_id; ?></td>
                                <td><?php echo $result->order_id; ?></td>
                                <td><?php echo $result->pro_name; ?></td>
                                <td><?php if (empty($result->photo)) { ?>
                                    <div class="zoom">
                                        <img id="image" src="../gallery/avatar/avatar.png" alt="Alternative Image"
                                            style="width:50px;height:50px;"></div>
                                    <?php } else { ?>
                                    <div class="zoom">
                                        <img id="image" src="<?php echo $result->photo; ?>" class="img-thumbnail"
                                            style="width:50px;height:50px;" alt="Product Photo"></div>
                                    <?php } ?>
                                </td>
                                <td> <?php $price = $result->pro_price;
                                                        echo number_format($price, 2, '.', '') . ' &#2547'; ?> </td>
                                <td> <?php echo $result->pro_quantity; ?> </td>

                                <td> <?php $subTotal = $result->total_price;
                                                        echo  number_format($subTotal, 2, '.', '') . ' &#2547'; ?>
                                </td>
                                <td> <?php $vat = $result->total_price * 0.15;
                                                        echo number_format($vat, 2, '.', '') . ' &#2547'; ?> </td>
                                <td> <?php $grandTotal = ($subTotal + $vat);
                                                        echo number_format($grandTotal, 2, '.', '') . ' &#2547'; ?>
                                </td>
                                <td> <?php echo $helper->dateFormat($result->created_at); ?> </td>
                                <td>
                                    <a> <?php if ($_SESSION['userEmail'] == $user_home->getEmail()) { ?>
                                        <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit Product!"
                                            href="editInvoice.php?edit_id=<?php echo $result->id; ?>"><i
                                                class="fa fa-pencil"></i> Edit</a>

                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete Product!"
                                            href="deleteInvoice.php?delete_id=<?php echo $result->id; ?>"
                                            onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');">
                                            <i class="fa fa-trash"></i> Delete</a>

                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip"
                                            title="View and delete Product!"
                                            href="invoice.php?invoice_id=<?php echo $result->id; ?>"
                                            onClick="return confirm('Do you really want to view this data?');">
                                            <i class="fa fa-trash"></i>Print-Invoice</a>

                                        <?php } else { ?>
                                        <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="View Product!"
                                            href="editCategopry.php?edit_id=<?php echo $result->id; ?>"
                                            onClick="return confirm('Do you really want to view this data?');"><i
                                                class="fa fa-eye"></i>
                                            View</a><?php                                                                                                } ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else { }
                            ?>
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>Id</th>
                                <th>PrId</th>
                                <th>OrId</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Vat 15%</th>
                                <th>Gr-Total</th>
                                <th>Ordered on</th>
                                <th>Actions</th>
                            </tr>
                        </tfooter>
                    </table>
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