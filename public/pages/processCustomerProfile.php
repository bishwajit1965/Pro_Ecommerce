<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\CustomerProfile as CustomerProfile;
use Codecourse\Repositories\Session as Session;

$customerProfile = new CustomerProfile();
Session::init();

$table = 'tbl_customer';


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
                                    // Checks to prevent duplicate entry
                                    $stmtExecute = $cart->preventDuplicateEntry($table5, $productId, $sessionId);
                                    if ($stmtExecute->pro_id == $productId && $stmtExecute->session_id == $sessionId) {
                                        $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                        <strong>Look carefully !!!</strong> Your cart item has already been added previously. You can update it only.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                        Session::set('message', $message);
                                        $home_url = 'cart.php';
                                        $product->redirect($home_url);
                                    } else {
                                        // If not added previously the data will be inserted
                                        $lastId = $cart->addToCart($table5, $table3, $productId, $quantity, $sessionId);
                                        $message = '<div class="alert alert-success alert-dismissible" role="alert"">
                                        <strong>WOW !!!</strong> Cart item has been added successfully!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                        Session::set('message', $message);
                                        $home_url = 'cart.php';
                                        $product->redirect($home_url);
                                    }
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
        case 'update-cart-item':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['pro_quantity'])) {
                                $productId = $_POST['pro_id'];
                                $productQuantity = $_POST['pro_quantity'];
                                $updatedQuantity = $cart->updateCartQuantity($table5, $productQuantity, $productId);
                                if ($productQuantity) {
                                    $message = '<div class="alert alert-success alert-dismissible" role="alert"">
                                        <strong>SUCCESSFUL !!!</strong> Your cart item quantity has been updated.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'cart.php';
                                    $product->redirect($home_url);
                                }
                            }
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
                                <strong>LOOK !!!</strong> Cart data has been deleted!!!
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
