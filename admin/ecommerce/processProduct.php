<?php

require_once '../app/start.php';

use Codecourse\Repositories\Cart as Cart;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\Session as Session;

$cart = new Cart();
$products = new Products();
Session::init();
$table = 'tbl_products';
$tableOrders = 'tbl_orders';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'add') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $pro_name = $products->validate($_POST['pro_name']);
                        $pro_description = $products->validate($_POST['pro_description']);
                        $pro_number = $products->validate($_POST['pro_number']);
                        $former_price = $products->validate($_POST['former_price']);
                        $present_price = $products->validate($_POST['present_price']);
                        $pro_rating = $products->validate($_POST['pro_rating']);
                        $cat_id = $products->validate($_POST['cat_id']);
                        $sub_cat_id = $products->validate($_POST['sub_cat_id']);
                        $pro_company = $products->validate($_POST['pro_company']);
                        $brand_id = $products->validate($_POST['brand_id']);
                        $pro_status = $products->validate($_POST['pro_status']);
                        $pro_entry_date = $products->validate($_POST['pro_entry_date']);

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
                                'pro_name' => $pro_name,
                                'pro_description' => $pro_description,
                                'pro_number' => $pro_number,
                                'former_price' => $former_price,
                                'present_price' => $present_price,
                                'pro_rating' => $pro_rating,
                                'cat_id' => $cat_id,
                                'sub_cat_id' => $sub_cat_id,
                                'pro_company' => $pro_company,
                                'photo' => $photo,
                                'brand_id' => $brand_id,
                                'pro_status' => $pro_status,
                                'pro_entry_date' => $pro_entry_date
                            ];
                            if (!empty($pro_name) && !empty($pro_description)) {
                                $pro_name = filter_var($pro_name, FILTER_SANITIZE_STRING);
                                $pro_description = filter_var($pro_description, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['pro_name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Product name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_description'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product description field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_number'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product number field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['former_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Former price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['present_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Present price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_rating'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product rating field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['sub_cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Sub category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_company'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Company name field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['brand_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Brand field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($file_name)) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Photo field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif ($file_size > 1048567) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong id= "strong"#9C0A0A>WARNING!!! File size is larger than 1 MB!
                                </strong>&nbsp &nbsp
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (in_array($file_ext, $permitted) === false) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong> You can upload only </strong>&nbsp &nbsp
                                ' . implode(" , ", $permitted) . '</div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } else {
                                // Will store data in database with photo
                                $insertedDataWithPhoto = $products->store($fields, $table);
                                move_uploaded_file($file_temp, $photo);
                                if ($insertedDataWithPhoto) {
                                    $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Data inserted successfully with photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'ecommerceIndex.php';
                                    $products->redirect($home_url);
                                }
                            }
                        } else {
                            $fields = [
                                'pro_name' => $pro_name,
                                'pro_description' => $pro_description,
                                'pro_number' => $pro_number,
                                'former_price' => $former_price,
                                'present_price' => $present_price,
                                'pro_rating' => $pro_rating,
                                'cat_id' => $cat_id,
                                'sub_cat_id' => $sub_cat_id,
                                'pro_company' => $pro_company,
                                'brand_id' => $brand_id,
                                'pro_status' => $pro_status,
                                'pro_entry_date' => $pro_entry_date
                            ];
                            if (!empty($pro_name) && !empty($description)) {
                                $pro_name = filter_var($pro_name, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['pro_name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Product name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_description'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product description field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_number'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product number field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['former_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Former price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['present_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Present price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_rating'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product rating field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['sub_cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Sub category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['brand_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Brand field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } else {
                                // Will store data in database without photo
                                $insertedDataWithoutProducts = $products->store($fields, $table);
                                if ($insertedDataWithoutProducts) {
                                    $message = '<div class="alert alert-info alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Data inserted successfully without any photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'ecommerceIndex.php';
                                    $products->redirect($home_url);
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
                        $pro_id = $products->validate($_POST['pro_id']);
                        $pro_name = $products->validate($_POST['pro_name']);
                        $pro_description = $products->validate($_POST['pro_description']);
                        $pro_number = $products->validate($_POST['pro_number']);
                        $former_price = $products->validate($_POST['former_price']);
                        $present_price = $products->validate($_POST['present_price']);
                        $pro_rating = $products->validate($_POST['pro_rating']);
                        $cat_id = $products->validate($_POST['cat_id']);
                        $sub_cat_id = $products->validate($_POST['sub_cat_id']);
                        $pro_company = $products->validate($_POST['pro_company']);
                        $brand_id = $products->validate($_POST['brand_id']);
                        $pro_status = $products->validate($_POST['pro_status']);
                        $pro_entry_date = $products->validate($_POST['pro_entry_date']);

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
                                'pro_id' => $pro_id,
                                'pro_name' => $pro_name,
                                'pro_description' => $pro_description,
                                'pro_number' => $pro_number,
                                'former_price' => $former_price,
                                'present_price' => $present_price,
                                'pro_rating' => $pro_rating,
                                'cat_id' => $cat_id,
                                'sub_cat_id' => $sub_cat_id,
                                'pro_company' => $pro_company,
                                'photo' => $photo,
                                'brand_id' => $brand_id,
                                'pro_status' => $pro_status,
                                'pro_entry_date' => $pro_entry_date
                            ];
                            if (!empty($pro_name) && !empty($pro_description)) {
                                $pro_name = filter_var($pro_name, FILTER_SANITIZE_STRING);
                                $description = filter_var($pro_description, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['pro_name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Product name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_description'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product description field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_number'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product number field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['former_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Former price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['present_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Present price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_rating'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product rating field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['sub_cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Sub category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_company'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Company name field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['brand_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Brand field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($file_name)) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Photo field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif ($file_size > 1048567) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong id= "strong"#9C0A0A>WARNING!!! File size is larger than 1 MB!
                                </strong>&nbsp &nbsp
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (in_array($file_ext, $permitted) === false) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <strong> You can upload only </strong>&nbsp &nbsp
                                ' . implode(" , ", $permitted) . '</div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } else {
                                // Will update database with selected photo
                                $dataUpdatedWithPhoto = $products->update($fields, $pro_id, $table);
                                move_uploaded_file($file_temp, $photo);
                                if ($dataUpdatedWithPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Data updated successfully with the newly selected photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'ecommerceIndex.php';
                                    $products->redirect($home_url);
                                }
                            }
                        } else {
                            $fields = [
                                'pro_id' => $pro_id,
                                'pro_name' => $pro_name,
                                'pro_description' => $pro_description,
                                'pro_number' => $pro_number,
                                'former_price' => $former_price,
                                'present_price' => $present_price,
                                'pro_rating' => $pro_rating,
                                'cat_id' => $cat_id,
                                'sub_cat_id' => $sub_cat_id,
                                'pro_company' => $pro_company,
                                'brand_id' => $brand_id,
                                'pro_status' => $pro_status,
                                'pro_entry_date' => $pro_entry_date
                            ];
                            if (!empty($pro_name) && !empty($description)) {
                                $pro_name = filter_var($pro_name, FILTER_SANITIZE_STRING);
                            }
                            if (empty($_POST['pro_name'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Product name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_description'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product description field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_number'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product number field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'addProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['former_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Former price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['present_price'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Present price field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['pro_rating'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Product rating field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['sub_cat_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Sub category id field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } elseif (empty($_POST['brand_id'])) {
                                $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                                <strong> SORRY !</strong> Brand field was left blank !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'editProduct.php';
                                $products->redirect($home_url);
                            } else {
                                // Will store data in database without photo
                                $updatedDataWithoutPhoto = $products->updateWithoutPhoto($fields, $pro_id, $table);
                                if ($updatedDataWithoutPhoto) {
                                    $message = '<div class="alert alert-info alert-dismissible" role="alert">
                                    <strong> WOW !</strong> Data updated successfully with existing photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'ecommerceIndex.php';
                                    $products->redirect($home_url);
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
                        $id = $products->validate($_POST['pro_id']);
                        $dataDeleted = $products->destroy($id, $table);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong> Data has been deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'ecommerceIndex.php';
                            $products->redirect($home_url);
                        }
                    }
                }
            }
        }
        break;
    case 'update-status':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'verify') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        if (!empty($_POST['order_id']) && !empty($_POST['pro_price']) && !empty($_POST['ordered_on'])) {
                            $order_id = $cart->validate($_POST['order_id']);
                            $pro_price = $cart->validate($_POST['pro_price']);
                            $ordered_on = $cart->validate($_POST['ordered_on']);
                            $ordered_status = $cart->validate($_POST['status']);
                            $updatedStatus = $cart->updateOrderStatus($tableOrders, $order_id, $pro_price, $ordered_on, $ordered_status);
                            if ($updatedStatus == true) {
                                $message = '<div class="alert alert-danger alert-dismissible " role="alert">
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

    default:
        // code...
        break;
}
