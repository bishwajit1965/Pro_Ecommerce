<?php

require_once '../app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\SubCategory as SubCategory;

$subCategory = new SubCategory();
Session::init();
$table = 'tbl_sub_category';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'add') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $sub_cat_name = $subCategory->validate($_POST['sub_cat_name']);
                        $cat_id = $subCategory->validate($_POST['cat_id']);
                        $sub_cat_name = filter_var($sub_cat_name, FILTER_SANITIZE_STRING);
                        $cat_id = filter_var($cat_id, FILTER_SANITIZE_STRING);

                        $fields = [
                            'sub_cat_name' => $sub_cat_name,
                            'cat_id' => $cat_id
                        ];
                        // This code will check and prevent duplicate entry of data
                        $subCategoryData = $subCategory->index($table);
                        if (!empty($subCategoryData)) {
                            foreach ($subCategoryData as $subCategoryName) {
                                if ($subCategoryName->sub_cat_name ==  $sub_cat_name) {
                                    $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                    Sub category data has already been taken before !!! Please try another one !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addSubCategory.php';
                                    $subCategory->redirect($home_url);
                                    exit();
                                }
                            }
                        }

                        if (empty($_POST['sub_cat_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                            Sub category name field remained blank!!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'addSubCategory.php';
                            $subCategory->redirect($home_url);
                        } elseif (empty($_POST['cat_id'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                            Category id field remained blank!!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'addSubCategory.php';
                            $subCategory->redirect($home_url);
                        } else {
                            // Will store data in database with photo
                            $insertedSubCategoryData = $subCategory->store($fields, $table);
                            if ($insertedSubCategoryData) {
                                $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                <strong> WOW !</strong>Sub category data inserted successfully !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'subCategoryIndex.php';
                                $subCategory->redirect($home_url);
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
                        $id = $subCategory->validate($_POST['sub_cat_id']);
                        $sub_cat_name = $subCategory->validate($_POST['sub_cat_name']);

                        $fields = [
                            'sub_cat_id' => $id,
                            'sub_cat_name' => $sub_cat_name
                        ];
                        if (!empty($sub_cat_name)) {
                            $sub_cat_name = filter_var($sub_cat_name, FILTER_SANITIZE_STRING);
                        }
                        if (empty($_POST['sub_cat_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Sub category name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'editSubCategory.php';
                            $subCategory->redirect($home_url);
                        } else {
                            // Will update data with the existing photo
                            $subCategoryUpdated = $subCategory->update($fields, $id, $table);
                            if ($subCategoryUpdated) {
                                $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Sub category data updated successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'subCategoryIndex.php';
                                $subCategory->redirect($home_url);
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
                        $id = $subCategory->validate($_POST['sub_cat_id']);
                        $dataDeleted = $subCategory->destroy($id, $table);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong>Sub category data has been deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'subCategoryIndex.php';
                            $subCategory->redirect($home_url);
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
