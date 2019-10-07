<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\Cart as Cart;

$product = new Products();
$cart = new Cart();
Session::init();
$table3 = 'tbl_products';
$table5 = 'tbl_cart';

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'add-to-cart':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['pro_id']) && $_POST['pro_id'] !== null) {
                                $productId = $_POST['pro_id'];
                                $quantity = $_POST['quantity'];
                                if (session_id() !== null) {
                                    $sessionId = session_id();
                                    $lastId = $cart->addToCart($table5, $table3, $productId, $quantity, $sessionId);
                                    $home_url = 'cart.php';
                                    $product->redirect($home_url);
                                }
                            } else {
                                $home_url = '404.php';
                                $product->redirect($home_url);
                            }
                        }
                    }
                }
            }
            break;
        case 'update':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            echo "Cart item updated successfully";
                        }
                    }
                }
            }
            break;
        case 'delete':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $id = $_POST['cart_id'];
                            $cart->destroy($id, $table5);
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Cart data has been deleted!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'cart.php';
                            $cart->redirect($home_url);
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