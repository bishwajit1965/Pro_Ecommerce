<?php

require_once '../app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Core as Core;

$core = new Core();
Session::init();
$table = 'tbl_student';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'add') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $name = $core->validate($_POST['name']);
                        $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                        $file_name = $_FILES['photo']['name'];
                        $file_size = $_FILES['photo']['size'];
                        $file_temp = $_FILES['photo']['tmp_name'];
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $photo = 'uploads/'.$unique_image;
                        $email = $core->validate($_POST['email']);
                        $address = $core->validate($_POST['address']);
                        $phone = $core->validate($_POST['phone']);
                        // Sanitizing string data
                        if (!empty($file_name)) {
                            $fields = [
                                'name' => $name,
                                'photo' => $photo,
                                'email' => $email,
                                'address' => $address,
                                'phone' => $phone,
                            ];
                            if (!empty($name) && !empty($description)) {
                                $name = filter_var($name, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['email'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Email field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['address'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Addrerss field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($file_name)) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Photo field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif ($file_size > 1048567) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong id= "strong"#9C0A0A>WARNING!!! File size is larger than 1 MB!
                                </strong>&nbsp &nbsp
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif (in_array($file_ext, $permitted) === false) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong> You can upload only </strong>&nbsp &nbsp
                                '.implode(" , ", $permitted).'</div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } else {
                                // Will store data in database with photo
                                $insertedDataWithPhoto = $core->store($fields, $table);
                                move_uploaded_file($file_temp, $photo);
                                if ($insertedDataWithPhoto) {
                                    $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Data inserted successfully with photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'studentIndex.php';
                                    $core->redirect($home_url);
                                }
                            }
                        } else {
                            $fields = [
                                'name' => $name,
                                'email' => $email,
                                'address' => $address,
                                'phone' => $phone,
                            ];
                            if (!empty($name) && !empty($description)) {
                                $name = filter_var($name, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['email'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Email field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['address'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Address field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addStudent.php';
                                $core->redirect($home_url);
                            } else {
                                // Will store data in database without photo
                                $insertedDataWithoutPhoto = $core->store($fields, $table);
                                if ($insertedDataWithoutPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Data inserted successfully without any photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'studentIndex.php';
                                    $core->redirect($home_url);
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
                        $id = $core->validate($_POST['edit_id']);

                        $id = $core->validate($_POST['id']);
                        $name = $core->validate($_POST['name']);
                        // Photo insert
                        $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                        $file_name = $_FILES['photo']['name'];
                        $file_size = $_FILES['photo']['size'];
                        $file_temp = $_FILES['photo']['tmp_name'];
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $photo = 'uploads/'.$unique_image;
                        $email = $core->validate($_POST['email']);
                        $address = $core->validate($_POST['address']);
                        $phone = $core->validate($_POST['phone']);
                        // Confirms photo is selected
                        if (!empty($file_name)) {
                            $fields = [
                                'id' => $id,
                                'name' => $name,
                                'photo' => $photo,
                                'email' => $email,
                                'address' => $address,
                                'phone' => $phone,
                            ];
                            if (!empty($name) && !empty($description)) {
                                $name = filter_var($name, FILTER_SANITIZE_STRING);
                                $description = filter_var($description, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['email'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Email field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['address'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Addrerss field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($file_name)) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Photo field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif ($file_size > 1048567) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong id= "strong"#9C0A0A>WARNING!!! File size is larger than 1 MB!
                                </strong>&nbsp &nbsp
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif (in_array($file_ext, $permitted) === false) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong> You can upload only </strong>&nbsp &nbsp
                                '.implode(" , ", $permitted).'</div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } else {
                                // Will update database with selected photo
                                $dataUpdatedWithPhoto = $core->update($fields, $id, $table);
                                move_uploaded_file($file_temp, $photo);
                                if ($dataUpdatedWithPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Data updated successfully with the newly selected photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'studentIndex.php';
                                    $core->redirect($home_url);
                                }
                            }
                        } else {
                            $fields = [
                                'id' => $id,
                                'name' => $name,
                                'email' => $email,
                                'address' => $address,
                                'phone' => $phone,
                            ];
                            if (!empty($name) && !empty($description)) {
                                $name = filter_var($name, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['email'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Email field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } elseif (empty($_POST['address'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Address field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editStudent.php';
                                $core->redirect($home_url);
                            } else {
                                // Will update data with the existing photo
                                $dataUpdatedWithoutPhoto = $core->updateWithoutPhoto($fields, $id, $table);
                                if ($dataUpdatedWithoutPhoto) {
                                    $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Data updated successfully with existing photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'studentIndex.php';
                                    $core->redirect($home_url);
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
                        $id = $core->validate($_POST['id']);
                        $dataDeleted = $core->destroy($id, $table);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong> Data deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'studentIndex.php';
                            $core->redirect($home_url);
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
