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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Order specific customer data
                <small>it all starts here</small>
            </h1>
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
                    <h3 class="box-title"><a href="inbox.php" class="btn btn-sm btn-primary"><i class="fa fa-fast-backward"></i> Order inbox</a> </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->

                    <?php
                    require_once '../app/start.php';

                    use Codecourse\Repositories\Session as Session;

                    // Catches the customer id
                    if (isset($_GET['customer_id'])) {
                        $customerId = $_GET['customer_id'];
                    }
                    // Will display all the messages vlidation/insert/update/delete
                    Session::init();
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    ?>
                    <div class="table-responsive-sm">
                        <table class="table table-condensed  table-sm table-striped mb-0">
                            <thead class="thead-inverse">
                                <tr>
                                    <th colspan="3" class="text-center py-0">
                                        <h2>Order specific customer data</h2>
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="border:1px solid#DDD;">
                                <?php
                                $customerData = $customerProfile->orderSpecificCustomerAddtess($tableCustomer, $customerId);
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
                                                    <a href="editCustomerProfile.php?edit_customer_id=<?php echo $customer->id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit </a>

                                                    <input type="hidden" name="action" value="verify">
                                                    <input type="hidden" name="delete_customer_id" value="<?php echo $customer->id; ?>">

                                                    <button type="submit" name="submit" onClick="return confirm('Afe you sure of deleting this dfata ? Once lost, lost for ever.')" class="btn btn-sm btn-danger" value="delete"> <i class="fa fa-trash"></i>
                                                        Delete</button>

                                                    <a href="inbox.php" class="btn btn-sm btn-primary"><i class="fa fa-fast-backward"></i> Order inbox</a>
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
    <?php include_once '../partials/_footer.php '; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
