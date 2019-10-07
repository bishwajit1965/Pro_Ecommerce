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
        // Class is instantiated
        use Codecourse\Repositories\Products as Products;
        use Codecourse\Repositories\Helpers as Helper;
        use Codecourse\Repositories\Session as Session;

        $products = new Products();
        $helper = new Helper;
        Session::init();
        $table = 'tbl_products';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Products index page<small>it all starts here</small></h1>
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
                            }?>
                        </sup>
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

                    <table id="example1" class="table table-bordered table-striped table-small table-compact">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Prod Name</th>
                                <th>Description</th>
                                <th>For Price</th>
                                <th>Pre Price</th>
                                <th>Pro Rating</th>
                                <th>Photo</th>
                                <th>Cat Id</th>
                                <th>Pro Ent Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $products = $products->index($table);
                            if (!empty($products)) {
                                $id = 1;
                                foreach ($products as $result) {
                                    ?>
                            <tr>
                                <td><?php echo $id++; ?>
                                </td>
                                <td><?php echo $result->pro_name; ?>
                                </td>
                                <td><?php echo $helper->textShorten(htmlspecialchars_decode($result->pro_description), 20); ?>
                                </td>
                                <td>
                                    <?php  $price = $result->former_price;
                                    echo number_format($price, 2, '.', '').' &#2547'; ?>

                                </td>
                                <td>
                                    <?php
                                            $price = $result->present_price;
                                    echo number_format($price, 2, '.', '').' &#2547'; ?>
                                </td>
                                <td>
                                    <?php echo $result->pro_rating; ?>
                                </td>
                                <td>
                                    <?php
                                            if (empty($result->photo)) {
                                                ?>
                                    <img src="../gallery/avatar/avatar.png" alt="Alternative Image"
                                        style="width:50px;height:50px;">
                                    <?php
                                            } else {
                                                ?>
                                    <img src="<?php echo $result->photo; ?>" class="img-thumbnail"
                                        style="width:50px;height:50px;" alt="Product Photo">
                                    <?php
                                            } ?>
                                </td>
                                <td><?php echo $result->cat_id; ?>
                                </td>

                                <td><?php echo $helper->dateFormat($result->pro_entry_date); ?>
                                </td>
                                <td>
                                    <?php
                                            if ($_SESSION['userEmail'] == $user_home->getEmail()) {
                                                ?>
                                    <a class="btn btn-xs btn-primary buttons" data-toggle="tooltip" title="Edit data!"
                                        href="editProduct.php?edit_id=<?php echo $result->pro_id; ?>"><i
                                            class="fa fa-pencil"></i> </a>

                                    <a class="btn btn-xs btn-danger buttons" data-toggle="tooltip"
                                        title="Delete data here!"
                                        href="ecommerceIndex.php?delete_id=<?php echo $result->pro_id; ?>"
                                        onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');"><i
                                            class="fa fa-trash"></i> </a>

                                    <a class="btn btn-xs btn-danger buttons" data-toggle="tooltip"
                                        title="View then delete!"
                                        href="deleteProduct.php?delete_id=<?php echo $result->pro_id; ?>">
                                        <i class="fa fa-trash"></i> D-View</a>
                                    <?php
                                            } else {
                                                ?>
                                    <a class="btn btn-xs btn-primary buttons"
                                        href="editProduct.php?edit_id=<?php echo $result->pro_id; ?>">
                                        <i class="fa fa-eye"></i> View</a><?php
                                            } ?>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>Id</th>
                                <th>Prod Name</th>
                                <th>Description</th>
                                <th>For Price</th>
                                <th>Pre Price</th>
                                <th>Pro Rating</th>
                                <th>Photo</th>
                                <th>Cat Id</th>
                                <th>Pro Ent Date</th>
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