<?php

require_once '../app/start.php';

use Codecourse\Repositories\Header as Header;
use Codecourse\Repositories\Session as Session;

$header = new Header();

Session::init();
$tableHeader = 'tbl_header';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'verify') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $title = $header->validate($_POST['title']);
                        $slogan = $header->validate($_POST['slogan']);
                        $established = $header->validate($_POST['established']);
                        // Photo
                        $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                        $file_name = $_FILES['photo']['name'];
                        $file_size = $_FILES['photo']['size'];
                        $file_temp = $_FILES['photo']['tmp_name'];
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                        $photo = 'uploads/' . $unique_image;
                        // Sanitizing string data
                        if (!empty($file_name)) {
                            $fields = [
                                'title' => $title,
                                'slogan' => $slogan,
                                'established' => $established,
                                'photo' => $photo
                            ];
                            if (!empty($title) && !empty($slogan) && !empty($photo)) {
                                $title = filter_var($title, FILTER_SANITIZE_STRING);
                                $slogan = filter_var($slogan, FILTER_SANITIZE_STRING);
                                $established = filter_var($established, FILTER_SANITIZE_STRING);
                                $photo = filter_var($photo, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['title'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Title field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['slogan'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Slogan field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['established'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Established field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($file_name)) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Photo field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif ($file_size > 1048567) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong id= "strong"#9C0A0A>WARNING!!! File size is larger than 1 MB!
                                </strong>&nbsp &nbsp
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif (in_array($file_ext, $permitted) === false) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong> You can upload only </strong>&nbsp &nbsp
                                ' . implode(" , ", $permitted) . '</div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } else {
                                // Will store data in database with photo
                                $insertedDataWithPhoto = $header->store($fields, $tableHeader);
                                move_uploaded_file($file_temp, $photo);
                                if ($insertedDataWithPhoto) {
                                    $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Data inserted successfully with photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'headerIndex.php';
                                    $header->redirect($home_url);
                                }
                            }
                        } else {
                            $fields = [
                                'title' => $title,
                                'slogan' => $slogan,
                                'established' => $established
                            ];
                            if (!empty($title) && !empty($slogan) && !empty($established)) {
                                $title = filter_var($title, FILTER_SANITIZE_STRING);
                                $slogan = filter_var($slogan, FILTER_SANITIZE_STRING);
                                $established = filter_var($established, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['title'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Title field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['slogan'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Slogan field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['established'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Established field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addHeader.php';
                                $header->redirect($home_url);
                            } else {
                                // Will store data in database without photo
                                $insertedDataWithoutPhoto = $header->store($fields, $tableHeader);
                                if ($insertedDataWithoutPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Header is inserted successfully without any photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'headerIndex.php';
                                    $header->redirect($home_url);
                                }
                            }
                        }
                    }
                }
            }
        }

        break;
    case 'update':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'update') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        //  Received id form edit student page
                        $id = $header->validate($_POST['id']);
                        $title = $header->validate($_POST['title']);
                        $slogan = $header->validate($_POST['slogan']);
                        $established = $header->validate($_POST['established']);
                        // Photo update
                        $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                        $file_name = $_FILES['photo']['name'];
                        $file_size = $_FILES['photo']['size'];
                        $file_temp = $_FILES['photo']['tmp_name'];
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                        $photo = 'uploads/' . $unique_image;
                        // Confirms photo is selected
                        if (!empty($file_name)) {
                            $fields = [
                                'title' => $title,
                                'slogan' => $slogan,
                                'established' => $established,
                                'photo' => $photo
                            ];
                            if (!empty($title) && !empty($slogan) && !empty($photo)) {
                                $title = filter_var($title, FILTER_SANITIZE_STRING);
                                $slogan = filter_var($slogan, FILTER_SANITIZE_STRING);
                                $established = filter_var($established, FILTER_SANITIZE_STRING);
                                $photo = filter_var($photo, FILTER_SANITIZE_STRING);
                            }
                            if (!empty($title) && !empty($slogan) && !empty($established)) {
                                $title = filter_var($title, FILTER_SANITIZE_STRING);
                                $slogan = filter_var($slogan, FILTER_SANITIZE_STRING);
                                $established = filter_var($established, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['title'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Title field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['slogan'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Slogan field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['established'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Established field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editHeader.php';
                                $header->redirect($home_url);
                            } else {
                                // Will update database with selected photo
                                $dataUpdatedWithPhoto = $header->update($fields, $id, $tableHeader);
                                move_uploaded_file($file_temp, $photo);
                                if ($dataUpdatedWithPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Header updated successfully with the newly selected photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'headerIndex.php';
                                    $header->redirect($home_url);
                                }
                            }
                        } else {
                            $fields = [
                                'title' => $title,
                                'slogan' => $slogan,
                                'established' => $established
                            ];
                            if (!empty($title) && !empty($slogan) && !empty($photo)) {
                                $title = filter_var($title, FILTER_SANITIZE_STRING);
                                $slogan = filter_var($slogan, FILTER_SANITIZE_STRING);
                                $established = filter_var($established, FILTER_SANITIZE_STRING);
                                $photo = filter_var($photo, FILTER_SANITIZE_STRING);
                            }
                            if (!empty($title) && !empty($slogan) && !empty($established)) {
                                $title = filter_var($title, FILTER_SANITIZE_STRING);
                                $slogan = filter_var($slogan, FILTER_SANITIZE_STRING);
                                $established = filter_var($established, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['title'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Title field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['slogan'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Slogan field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editHeader.php';
                                $header->redirect($home_url);
                            } elseif (empty($_POST['established'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Established field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editHeader.php';
                                $header->redirect($home_url);
                            } else {
                                // Will store data in database without photo
                                $updatedDataWithoutPhoto = $header->updateWithoutPhoto($fields, $id, $tableHeader);
                                if ($updatedDataWithoutPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Header data updated successfully with existing photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'headerIndex.php';
                                    $header->redirect($home_url);
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
            if ($_REQUEST['action'] == 'delete') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $id = $header->validate($_POST['id']);
                        $dataDeleted = $header->destroy($id, $tableHeader);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong> Data has been deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'headerIndex.php';
                            $header->redirect($home_url);
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
