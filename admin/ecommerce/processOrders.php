<?php

require_once '../app/start.php';

use Codecourse\Repositories\Cart as Cart;
use Codecourse\Repositories\Session as Session;

$cart = new Cart();
Session::init();
$tableOrders = 'tbl_orders';

switch ($_POST['submit']) {
    case 'update-status':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'verify') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        if (isset($_POST['order_id']) && isset($_POST['pro_price']) && isset($_POST['ordered_on']) && isset($_POST['status'])) {
                            // Verifies and matches all the fields then updates
                            $order_id = $cart->validate($_POST['order_id']);
                            $pro_price = $cart->validate($_POST['pro_price']);
                            $ordered_on = $cart->validate($_POST['ordered_on']);
                            $ordered_status = $cart->validate($_POST['status']);
                            // Updates staus in orders table
                            $statusUpdated = $cart->updateOrderStatus($tableOrders, $order_id, $pro_price, $ordered_on, $ordered_status);
                            // validation messages and page redirects
                            if (statusUpdated) {
                                $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Ordered data has successfully been shifted !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'inbox.php';
                                $cart->redirect("$home_url");
                            }
                        }
                    }
                }
            }
        }
        break;
    case 'revoke_status':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'verify') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['order_id']) && isset($_POST['pro_price']) && isset($_POST['ordered_on']) && isset($_POST['status'])) {
                                // Verifies and matches all the fields then updates
                                $order_id = $cart->validate($_POST['order_id']);
                                $pro_price = $cart->validate($_POST['pro_price']);
                                $ordered_on = $cart->validate($_POST['ordered_on']);
                                $ordered_status = $cart->validate($_POST['status']);
                                // Revoke staus in orders table
                                $statusUpdated = $cart->revokeOrderStatus($tableOrders, $order_id, $pro_price, $ordered_on, $ordered_status);
                                // validation messages and page redirects
                                if (statusUpdated) {
                                    $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Ordered status has been rovoked successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'inbox.php';
                                    $cart->redirect("$home_url");
                                }
                            }
                        }
                    }
                }
            }
        }
        break;
    case 'delete_order':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'verify') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['order_id']) && isset($_POST['customer_id']) && isset($_POST['ordered_on']) && isset($_POST['status'])) {
                                // Verifies and matches all the fields then updates
                                $order_id = $cart->validate($_POST['order_id']);
                                $customer_id = $cart->validate($_POST['customer_id']);
                                $ordered_on = $cart->validate($_POST['ordered_on']);
                                $ordered_status = $cart->validate($_POST['status']);
                                // Revoke staus in orders table
                                $statusUpdated = $cart->deleteOrder($tableOrders, $order_id, $customer_id, $ordered_on, $ordered_status);
                                // validation messages and page redirects
                                if (statusUpdated) {
                                    $message = '<div class="alert alert-warning alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Order has been rovoked successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'inbox.php';
                                    $cart->redirect("$home_url");
                                }
                            }
                        }
                    }
                }
            }
        }
        break;

    default:
        // code...
        break;
}
