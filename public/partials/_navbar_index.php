<nav class="row navbar navbar-expand-lg navbar-dark bg-dark clearfix">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="pages/products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/topBrands.php">Top Brands</a>
            </li>
            <?php
            include_once '../admin/app/start.php';

            use Codecourse\Repositories\Session as Session;

            $session = Session::checkLogin();
            if ($session == true) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="pages/cart.php">Cart</a>
                </li>
                <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="pages/profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/contact.php">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
