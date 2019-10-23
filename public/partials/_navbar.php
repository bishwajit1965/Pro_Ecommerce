<nav class="row navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
            </li>
            <?php
            include_once '../../admin/app/start.php';

            use Codecourse\Repositories\Session as Session;
            use Codecourse\Repositories\Cart as Cart;

            $cart = new Cart();
            $table5 = 'tbl_cart';

            $session = Session::checkLogin();
            $sessionId = session_id();
            if ($session == true) {
                ?>
            <li class="nav-item">
                <a class="nav-link" href="customerProfileIndex.php"> Profile</a>
            </li>
            <?php
                    if ($cart->checkCartTable($table5, $sessionId)) { ?>
            <li class="nav-item">
                <a class="nav-link" href="cart.php"> Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="payment.php"> Payment</a>
            </li>
            <?php } ?>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="topBrands.php">Top Brands</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
    </div>
</nav>