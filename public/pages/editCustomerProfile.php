<?php
require_once '../../admin/app/start.php';


use Codecourse\Repositories\CustomerProfile as CustomerProfile;

use Codecourse\Repositories\Session as Session;

Session::init();
Session::checkSession();

// Needed for inserting category id to products table
$customerProfile = new CustomerProfile();

// Needed table for fetching data
$table = 'tbl_customer';

// Get single product id to fetch data
if (isset($_GET['edit_customer_id'])) {
    $id = $_GET['edit_customer_id'];
}

// Data will be fetched for display
$result = $customerProfile->updateView($id, $table);

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
                <h2>Edit customer Detail</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container bg-light">
        <div class="row">
            <div class="col-sm-12 content-area">
                <div class="category bg-secondary py-2 mt-3 px-3 mb-3 text-white text-center">
                    <h3>Edit customer data</h3>
                </div>
                <div class="row">
                    <?php
                    // Will display all the messages vlidation/insert/update/delete
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    ?>
                </div>
                <form action="processCustomerProfile.php" method="post" autocomplete="on">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm bg-light" name="first_name" value="<?= isset($result->first_name) ? $result->first_name : ''; ?>">
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-sm" name="last_name" value="<?= isset($result->last_name) ? $result->last_name : ''; ?>">
                            </div>
                            <div class=" form-group">
                                <input type="email" class="form-control form-control-sm" name="email" value="<?= isset($result->email) ? $result->email : ''; ?> ">
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-sm" name="phone" value="<?= isset($result->phone) ? $result->phone : ''; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="address" value="<?= isset($result->address) ? $result->address : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="zip_code" value="<?= isset($result->zip_code) ? $result->zip_code : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="country" value="<?= isset($result->country) ? $result->country : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="links mb-3">
                        <input type="hidden" name="action" value="verify">
                        <input type="hidden" name="edit_customer_id" value="<?= $id; ?>">

                        <button type="submit" name="submit" value="update-customer" class="btn btn-sm btn-success">
                            <i class="fas fa-edit"></i> Update</button>

                        <a href="customerProfileIndex.php" class="btn btn-sm btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Profile Index</a>
                        <a href=" ../index.php" class="btn btn-sm btn-primary"><i class="fas fa-fast-backward">
                            </i> Home page</a>
                    </div>
                </form>
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
