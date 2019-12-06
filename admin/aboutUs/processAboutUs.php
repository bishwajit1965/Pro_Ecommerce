<?php
include_once '../app/start.php';

use Codecourse\Repositories\AboutUs as AboutUs;
use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\Session as Session;

Session::init();
$aboutUs = new AboutUs();
$helpers = new Helpers();
$tableAboutUs = 'tbl_about_us';
$sessionId = session_id();

if (isset($_POST['submit'])) {
    $accessor = $_POST['submit'];
    switch ($accessor) {
        case 'insert_about_us':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {
                            $phone = $helpers->validation($_POST['phone']);
                            $email = $helpers->validation($_POST['email']);
                            $address = $helpers->validation($_POST['address']);
                            $description = $helpers->validation($_POST['description']);
                            $url  = $helpers->validation($_POST['url']);
                            if (session_id() !== null) {
                                $fields = [
                                    'phone' => $phone,
                                    'email' => $email,
                                    'address' => $address,
                                    'description' => $description,
                                    'url' => $url
                                ];

                                if (empty($phone)) {
                                    $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                        <strong>LOOK CAREFULLY !!!</strong> Phone field is empty !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboutUs->redirect($home_url);
                                } elseif (empty($email)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Email field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } elseif (empty($address)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Address field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } elseif (empty($description)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Description field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } elseif (empty($url)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Url field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } else {
                                    $aboutUsData = $aboutUs->store($fields, $tableAboutUs);
                                    if ($aboutUsData) {
                                        $message = '<div class="alert alert-success alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> About us data has been added successfully!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                        Session::set('message', $message);
                                        $home_url = 'addAboutUs.php';
                                        $aboutUs->redirect($home_url);
                                    }
                                }
                            } else {
                                $home_url = 'unauthorised.php';
                                $aboutUs->redirect($home_url);
                            }
                        }
                    }
                }
            }
            break;
        case 'update_about_us':
            if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'verify') {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['submit'])) {

                            $id = $_POST['edit_id'];
                            $phone = $helpers->validation($_POST['phone']);
                            $email = $helpers->validation($_POST['email']);
                            $address = $helpers->validation($_POST['address']);
                            $description = $helpers->validation($_POST['description']);
                            $url  = $helpers->validation($_POST['url']);
                            if (session_id() !== null) {
                                $fields = [
                                    'phone' => $phone,
                                    'email' => $email,
                                    'address' => $address,
                                    'description' => $description,
                                    'url' => $url
                                ];

                                if (empty($phone)) {
                                    $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                        <strong>LOOK CAREFULLY !!!</strong> Phone field is empty !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboutUs->redirect($home_url);
                                } elseif (empty($email)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Email field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } elseif (empty($address)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Address field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } elseif (empty($description)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Description field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } elseif (empty($url)) {
                                    $message = '<div class="alert alert-danger alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> Url field was left empty!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addAboutUs.php';
                                    $aboputUs->redirect($home_url);
                                } else {
                                    $aboutUsData = $aboutUs->updateWithoutPhoto($fields, $id, $tableAboutUs);
                                    if ($aboutUsData) {
                                        $message = '<div class="alert alert-success alert-dismissible mb-0" role="alert"">
                                        <strong>WOW !!!</strong> About us data has been updated successfully!!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                        Session::set('message', $message);
                                        $home_url = 'aboutUsIndex.php';
                                        $aboutUs->redirect($home_url);
                                    }
                                }
                            } else {
                                $home_url = 'unauthorised.php';
                                $aboutUs->redirect($home_url);
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
