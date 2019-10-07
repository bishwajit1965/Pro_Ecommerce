<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\LoginCustomer as LoginCustomer;
use Codecourse\Repositories\Helpers as Helpers;

$product = new Products();
$loginCustomer = new LoginCustomer();
$helpers = new Helpers();
Session::init();
$table = 'tbl_customer';

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'login':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            try {
                                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                                $password = md5($_POST['password']);
                                $customerData = $loginCustomer->logIn($email, $password, $table);
                                // Will verify email and passwrd
                                if (isset($email) && isset($password) && $email == $customerData->email && $password ==  $customerData->password) {
                                    Session::init();
                                    $value = $_POST['email'];
                                    Session::set('login', $value);
                                    $home_url = '../index.php';
                                    Session::redirect($home_url);
                                } else {
                                    $home_url = 'login.php';
                                    Session::redirect("$home_url?logInError");
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                }
            }
            break;
        case 'log_out':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            Session::destroy();
                            $home_url = 'login.php';
                            Session::redirect($home_url);
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