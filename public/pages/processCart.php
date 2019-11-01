<?php
include_once 'ClassLoader.php';

use Codecourse\Repositories\Session as Session;

Session::init();
$sessionId = session_id();

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
                                    $stmtExecute = $cart->preventDuplicateEntry($tableCart, $productId, $sessionId);
                                    if ($stmtExecute->pro_id == $productId && $stmtExecute->session_id == $sessionId) {
                                        $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                        <strong>LOOK CAREFULLY !!!</strong> Your cart item has already been added previously. You can now update or remove it only.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                        Session::set('message', $message);
                                        $home_url = 'cart.php';
                                        $products->redirect($home_url);
                                    } else {
                                        // If not added previously the data will be inserted
                                        $lastId = $cart->addToCart($tableCart, $tablePeoducts, $productId, $quantity, $sessionId);
                                        $message = '<div class="alert alert-success alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Product has been added to cart successfully!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                        Session::set('message', $message);
                                        $home_url = 'cart.php';
                                        $products->redirect($home_url);
                                    }
                                }
                            } else {
                                $home_url = '404.php';
                                $products->redirect($home_url);
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
                                $updatedQuantity = $cart->updateCartQuantity($tableCart, $productQuantity, $productId);
                                if ($productQuantity) {
                                    $message = '<div class="alert alert-success alert-dismissible" role="alert"">
                                        <strong>SUCCESSFUL !!!</strong> Your cart product quantity has been updated.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'cart.php';
                                    $products->redirect($home_url);
                                }
                            }
                        }
                    }
                }
            }
            break;
        case 'order':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $orderedProduct = $cart->processOrderToBuyProduct($tableCart, $sessionId, $tableOrders);
                            $stmtExec = $cart->destroyDataFromCartTableOnLogOut($sessionId, $tableCart);
                            $message = '<div class="alert alert-primary alert-dismissible" role="alert"">
                                <strong>SUCCESS !!!</strong> Order has been placed successfully!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'order.php';
                            $cart->redirect("$home_url");
                        }
                    }
                }
            }
            break;
        case 'confirm_order':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'varify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['submit'])) {
                                if (isset($_POST['order_id']) && isset($_POST['customer_id']) && isset($_POST['ordered_on']) && isset($_POST['status'])) {
                                    // Verifies and matches all the fields then updates
                                    $order_id = $cart->validate($_POST['order_id']);
                                    $customer_id = $cart->validate($_POST['customer_id']);
                                    $ordered_on = $cart->validate($_POST['ordered_on']);
                                    $ordered_status = $cart->validate($_POST['status']);
                                    // Confirms staus in orders table
                                    $confirmOrderStatus = $cart->confirmOrderStatus($tableOrders, $order_id, $customer_id, $ordered_on, $ordered_status);
                                    // validation messages and page redirects
                                    if ($confirmOrderStatus) {
                                        $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Ordered status has been confirmed successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                        Session::set('message', $message);
                                        $home_url = 'orderDetails.php';
                                        $cart->redirect("$home_url");
                                    }
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
                            $cart->destroy($id, $tableCart);
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                <strong>LOOK CAREFULLY !!!</strong> Cart data has been deleted!!!
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
