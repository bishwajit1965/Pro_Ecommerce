<?php

require_once '../app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\Category as Category;

$category = new Category();
Session::init();
$table = 'tbl_category';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'add') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $cat_name = $category->validate(ucfirst($_POST['cat_name']));
                        $cat_name = filter_var($cat_name, FILTER_SANITIZE_STRING);
                        $brand_id = filter_var($brand_id, FILTER_SANITIZE_STRING);

                        $fields = [
                            'cat_name' => $cat_name,
                            'brand_id' => $brand_id,
                        ];
                        // This code will check and prevent duplicate entry of data
                        $categoryData = $category->index($table);
                        if (!empty($categoryData)) {
                            foreach ($categoryData as $categoryName) {
                                if ($categoryName->cat_name ==  $cat_name) {
                                    $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                    Category data has already been taken before !!! Please try another one !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    Session::set('message', $message);
                                    $home_url = 'addCategory.php';
                                    $category->redirect($home_url);
                                    exit();
                                }
                            }
                        }
                        if (empty($_POST['cat_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                            Category name field remained blank!!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'addCategory.php';
                            $category->redirect($home_url);
                        } else {
                            // Will store data in database with photo
                            $insertedcategoryData = $category->store($fields, $table);
                            if ($insertedcategoryData) {
                                $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                <strong> WOW !</strong> Data inserted successfully !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                Session::set('message', $message);
                                $home_url = 'categoryIndex.php';
                                $category->redirect($home_url);
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
                        $id = $category->validate($_POST['cat_id']);
                        $cat_name = $category->validate($_POST['cat_name']);

                        $fields = [
                            'cat_id' => $id,
                            'cat_name' => $cat_name
                        ];
                        if (!empty($cat_name)) {
                            $cat_name = filter_var($cat_name, FILTER_SANITIZE_STRING);
                        }
                        if (empty($_POST['cat_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Category name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'editCategory.php';
                            $category->redirect($home_url);
                        } else {
                            // Will update data with the existing photo
                            $categoryUpdated = $category->update($fields, $id, $table);
                            if ($categoryUpdated) {
                                $message = '<div class="alert alert-success alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Category data updated successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'categoryIndex.php';
                                $category->redirect($home_url);
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
                        $id = $category->validate($_POST['cat_id']);
                        $dataDeleted = $category->destroy($id, $table);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong> Category data has been deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'categoryIndex.php';
                            $category->redirect($home_url);
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
