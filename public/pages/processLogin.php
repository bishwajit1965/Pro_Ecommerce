<?php
include_once 'ClassLoader.php';

use Codecourse\Repositories\Session as Session;

Session::init();

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'login':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            try {
                                $email = $_POST['email'];
                                $email = $helpers->validation(filter_var($email, FILTER_VALIDATE_EMAIL));
                                $password = $_POST['password'];
                                $password = $helpers->validation($password);
                                if (empty($_POST['email'])) {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                <span class="alert-heading">SORRY !!! Empty email field !</span>
                                            </div>';
                                    Session::set('message', $message);
                                    $url = 'login.php';
                                    $loginCustomer->redirect("$url");
                                } elseif (empty($_POST['password'])) {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                <span class="alert-heading">SORRY !!! Empty password field !</span>
                                            </div>';
                                    Session::set('message', $message);
                                    $url = 'login.php';
                                    $loginCustomer->redirect("$url");
                                } else {
                                    $customerData = $loginCustomer->logIn($email, $tableCustomer);
                                    if ($customerData->email == $email && $customerData->password == md5($password)) {
                                        Session::init();
                                        Session::set('customerLogin', true);
                                        Session::set('customerId', $customerData->id);
                                        $value = $_POST['email'];
                                        Session::set('login', $value);
                                        $home_url = '../index.php';
                                        Session::redirect("$home_url");
                                    } else {
                                        $home_url = 'login.php';
                                        Session::redirect("$home_url?logInError");
                                    }
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
                            if (isset($_GET['session_id'])) {
                                $sessionId = $_GET['session_id'];
                            }
                            $stmtExec = $cart->destroyDataFromCartTableOnLogOut($sessionId, $tableCart);
                            Session::destroy();
                            $home_url = 'login.php';
                            Session::redirect("$home_url");
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