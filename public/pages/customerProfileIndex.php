<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\CustomerProfile as CustomerProfile;
use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\Session as Session;

Session::init();
Session::checkSession();

// Needed for inserting category id to products table
$customerPro = new CustomerProfile();
$helpers = new Helpers();

// Needed table for fetching data
$table12 = 'tbl_customer';

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
                <h2>Customer Profile Index</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container">
        <?php
        // Will display all the messages vlidation/insert/update/delete
        $message = Session::get('message');
        if (!empty($message)) {
            echo $message;
            Session::set('message', null);
        }
        ?>
        <div class="row">
            <table class="table table-light table-condensed table-condensed table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Countery</th>
                        <th>Zip Code</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $customerData = $customerPro->customerIndex($table12);
                    foreach ($customerData as $customer) {
                        if (Session::get('login') ==  $customer->email) {
                            ?>
                            <tr>
                                <td><?php echo $customer->id; ?>
                                </td>
                                <td><?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                </td>
                                <td><?php echo $customer->email; ?>
                                </td>
                                <td><?php echo $customer->phone; ?>
                                </td>
                                <td><?php echo $customer->address; ?>
                                </td>
                                <td><?php echo $customer->country; ?>
                                </td>
                                <td><?php echo $customer->zip_code; ?>
                                </td>
                                <td><?php echo $helpers->dateFormat($customer->created_at); ?>
                                </td>
                                <td>

                                    <form action="processCustomerProfile.php" method="post">
                                        <a href="editCustomerProfile.php?edit_customer_id=<?php echo $customer->id; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit </a>

                                        <input type="hidden" name="action" value="verify">
                                        <input type="hidden" name="delete_customer_id" value="<?php echo $customer->id; ?>">
                                        <button type="submit" name="submit" onClick="return confirm('Afe you sure of deleting this dfata?')" class="btn btn-sm btn-danger" value="delete"> <i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

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

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
