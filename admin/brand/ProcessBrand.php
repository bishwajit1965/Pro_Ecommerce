<?php

require_once '../app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Brand as Brand;

$brand = new Brand();
Session::init();
$table = 'tbl_brand';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'add') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $brand_name = $brand->validate(ucfirst($_POST['brand_name']));
                        $cat_id = $brand->validate(ucfirst($_POST['cat_id']));
                        $brand_name = filter_var($brand_name, FILTER_SANITIZE_STRING);

                        $fields = [
                            'brand_name' => $brand_name,
                            'cat_id' => $cat_id
                        ];
                        // This code will check and prevent duplicate entry of data
                        $brandData = $brand->index($table);
                        if (!empty($brandData)) {
                            foreach ($brandData as $brandName) {
                                if ($brandName->brand_name ==  $brand_name) {
                                    $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                        Brand data has already been taken before !!! Please try another one !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addBrand.php';
                                    $brand->redirect($home_url);
                                    exit();
                                }
                            }
                        }
                        if (empty($_POST['brand_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Category name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'addbrand.php';
                            $brand->redirect($home_url);
                        } elseif (empty($_POST['cat_id'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Category field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'addbrand.php';
                            $brand->redirect($home_url);
                        } else {
                            // Will store data in database with photo
                            $insertedbrandData = $brand->store($fields, $table);
                            if ($insertedbrandData) {
                                $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> WOW !</strong>Brand data inserted successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'brandIndex.php';
                                $brand->redirect($home_url);
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
                        //  Received id form edit category page
                        $id = $brand->validate($_POST['brand_id']);
                        $brand_name = $brand->validate($_POST['brand_name']);
                        $cat_id = $brand->validate($_POST['cat_id']);

                        $fields = [
                            'brand_id' => $id,
                            'brand_name' => $brand_name,
                            'cat_id' => $cat_id,
                        ];
                        if (!empty($brand_name)) {
                            $brand_name = filter_var($brand_name, FILTER_SANITIZE_STRING);
                        }
                        if (empty($_POST['brand_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Brand name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'editBrand.php';
                            $brand->redirect($home_url);
                        } else {
                            // Will update data with the existing photo
                            $result = $brand->update($fields, $id, $table);
                            if ($result) {
                                $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Brand data updated successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'brandIndex.php';
                                $brand->redirect($home_url);
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
                        $id = $brand->validate($_POST['cat_id']);
                        $dataDeleted = $brand->destroy($id, $table);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong> Brand data has been deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'brandIndex.php';
                            $brand->redirect($home_url);
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
