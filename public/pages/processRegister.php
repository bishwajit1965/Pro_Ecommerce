<?php
require_once '../../admin/app/start.php';

use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\Register as Register;
use Codecourse\Repositories\Session as Session;

$register = new Register();
$helpers = new Helpers();
Session::init();
$table = 'tbl_customer';

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'register':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $first_name = $helpers->validation($_POST['first_name']);
                            $last_name = $helpers->validation($_POST['last_name']);
                            $email = $helpers->validation($_POST['email']);
                            $phone = $helpers->validation($_POST['phone']);
                            $address = $helpers->validation($_POST['address']);
                            $zip_code = $helpers->validation($_POST['zip_code']);
                            $country = $helpers->validation($_POST['country']);
                            $password = $helpers->validation($_POST['password']);
                            $confirm_password = $helpers->validation($_POST['confirm_password']);
                            if ($_POST['password'] == $_POST['confirm_password']) {
                                $password = $password;
                                $password = md5($_POST['password']);
                                $fields = [
                                    'first_name' => $first_name,
                                    'last_name' => $last_name,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'address' => $address,
                                    'zip_code' => $zip_code,
                                    'country' => $country,
                                    'password' => $password,
                                ];
                                if (empty($first_name)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> First name empty !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($last_name)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> Last name empty !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> Email address empty !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($password)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> Password field left empty !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (strlen($password) < 6) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> Password should be at least 6 chars !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($confirm_password)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> Confirm password field left empty !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (strlen($confirm_password) < 6) {
                                    $message = '<div class="alert alert-success" role="alert">
                                  <h4 class="alert-heading">SORRY !!!</h4>
                                  <p class="mb-0"> Confirm password should be at least 6 chars !!!</p>
                                </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } else {
                                    $registerData = $register->store($fields, $table);
                                    if ($registerData) {
                                        $message = '<div class="alert alert-success" role="alert">
                                      <h4 class="alert-heading">SUCCESSFUL !!!</h4>
                                      <p class="mb-0"> Data entered successfully !!!</p>
                                    </div>';
                                        Session::set('message', $message);
                                        if ($registerData) {
                                            $home_url = 'registerForm.php';
                                            Session::redirect("$home_url");
                                        }
                                    }
                                }
                            } else {
                                $message = '<div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">SORRY !!!</h4>
                                            <p class="mb-0"> Password mismatch !!!</p>
                                            </div>';
                                Session::set('message', $message);
                                $home_url = 'registerForm.php';
                                $register->redirect("$home_url");
                            }
                        }
                    }
                }
            }
            break;
        case 'update-customer':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $first_name = $helpers->validation($_POST['first_name']);
                            $last_name = $helpers->validation($_POST['last_name']);
                            $email = $helpers->validation($_POST['email']);
                            $phone = $helpers->validation($_POST['phone']);
                            $address = $helpers->validation($_POST['address']);
                            $zip_code = $helpers->validation($_POST['zip_code']);
                            $country = $helpers->validation($_POST['country']);
                            $password = $helpers->validation($_POST['password']);
                            $confirm_password = $helpers->validation($_POST['confirm_password']);
                            if ($_POST['password'] == $_POST['confirm_password']) {
                                $password = $password;
                                $password = md5($_POST['password']);
                                $fields = [
                                    'first_name' => $first_name,
                                    'last_name' => $last_name,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'address' => $address,
                                    'zip_code' => $zip_code,
                                    'country' => $country,
                                    'password' => $password,
                                ];
                                if (empty($first_name)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> First name empty !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($last_name)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> Last name empty !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> Email address empty !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($password)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> Password field left empty !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (strlen($password) < 6) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> Password should be at least 6 chars !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (empty($confirm_password)) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> Confirm password field left empty !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } elseif (strlen($confirm_password) < 6) {
                                    $message = '<div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">SORRY !!!</h4>
                                    <p class="mb-0"> Confirm password should be at least 6 chars !!!</p>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'registerForm.php';
                                    $register->redirect("$home_url");
                                } else {
                                    $registerData = $register->store($fields, $table);
                                    if ($registerData) {
                                        $message = '<div class="alert alert-success" role="alert">
                                                    <h4 class="alert-heading">SUCCESSFUL !!!</h4>
                                                    <p class="mb-0"> Data entered successfully !!!</p>
                                                    </div>';
                                        Session::set('message', $message);
                                        if ($registerData) {
                                            $home_url = 'registerForm.php';
                                            Session::redirect("$home_url");
                                        }
                                    }
                                }
                            } else {
                                $message = '<div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">SORRY !!!</h4>
                                            <p class="mb-0"> Password mismatch !!!</p>
                                            </div>';
                                Session::set('message', $message);
                                $home_url = 'registerForm.php';
                                $register->redirect("$home_url");
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
