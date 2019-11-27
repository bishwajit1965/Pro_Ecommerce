<?php
include_once 'ClassLoader.php';

use Codecourse\Repositories\Session as Session;

Session::init();
$sessionId = session_id();
$customerId = Session::get('customerId');

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'contact-us':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $firstName = $helpers->validation($_POST['first_name']);
                            $lastName = $helpers->validation($_POST['last_name']);
                            $email = $helpers->validation(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
                            $phone = $helpers->validation($_POST['phone']);
                            $message = $helpers->validation($_POST['message']);
                            if (empty($firstName)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> First name field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($lastName)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Last name field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($email)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Email field was left blank !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($phone)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Phone field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($message)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Message field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } else {
                                $fields = [
                                    'first_name' => $firstName,
                                    'last_name' => $lastName,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'message' => $message,
                                    'customer_session' => $sessionId,
                                    'customer_id' => $customerId
                                ];
                                $lastId = $contactUs->store($fields, $tableContactUs);
                                if ($lastId) {
                                    $message = '<div class="alert alert-success alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Yor message has been sent successfully!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'contact.php';
                                    $contactUs->redirect("$home_url");
                                }
                            }
                        }
                    }
                }
            }
            break;
        case 'view_message':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $home_url = 'editContact.php';
                            $contactUs->redirect("$home_url");
                        }
                    }
                }
            }
            break;
        case 'update_message':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $firstName = $helpers->validation($_POST['first_name']);
                            $lastName = $helpers->validation($_POST['last_name']);
                            $email = $helpers->validation(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
                            $phone = $helpers->validation($_POST['phone']);
                            $message = $helpers->validation($_POST['message']);
                            if (empty($firstName)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> First name field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($lastName)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Last name field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($email)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Email field was left blank !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($phone)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Phone field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } elseif (empty($message)) {
                                $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                    <strong>ERROR !!!</strong> Message field was left blank!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'contact.php';
                                $contactUs->redirect("$home_url");
                            } else {
                                $fields = [
                                    'session_id' => $sessionId,
                                    'customer_id' => $customerId,
                                    'first_name' => $firstName,
                                    'last_name' => $lastName,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'message' => $message
                                ];
                                $lastId = $contactUs->updateWithoutPhoto($fields, $sessionId, $tableContactUs);
                                if ($lastId) {
                                    $message = '<div class="alert alert-success alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Yor message has been sent successfully!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'contact.php';
                                    $contactUs->redirect("$home_url");
                                }
                            }
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