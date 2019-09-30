<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Products as Products;

$product = new Products();
Session::init();
$table = 'tbl_sproducts';

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'add-to-cart':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            echo "I reside in add to cart option";

                            $home_url = 'single.php';
                            $product->redirect($home_url);
                        }
                    }
                }
            }
            break;
        case 'cart':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            include_once 'pages/cart.php';
                        }
                    }
                }
            }
            break;
        case 'single':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            include_once 'pages/single.php';
                        }
                    }
                }
            }
            break;
        default:
            #...
            break;
    }
}
