<?php
ob_start();
include_once '../../admin/app/start.php';
// Classes included for global use
use Codecourse\Repositories\Brand as Brand;
use Codecourse\Repositories\Cart as Cart;
use Codecourse\Repositories\Category as Category;
use Codecourse\Repositories\CustomerProfile as CustomerProfile;
use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\LoginCustomer as LoginCustomer;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\SubCategory as SubCategory;

// Starts session
Session::init();

// Checks if logged in or not
Session::checkLogin();

// Verifies if the customer logged in or not
Session::checkSession();

// Session id for individual customer
$sessionId = session_id();

// Session based individual customer Id
$customerId = Session::get('customerId');

// Detecte file name
$current_page = basename($_SERVER['SCRIPT_FILENAME'], '.php');

// Class objects instantiated
$brand = new Brand();
$cart = new Cart();
$category = new Category;
$customerProfile = new CustomerProfile();
$helpers = new Helpers();
$loginCustomer = new LoginCustomer();
$products = new Products();
$subCategory = new SubCategory;

// Tables listed for use where necessary
$tableBrand = 'tbl_brand';
$tableCart = 'tbl_cart';
$tableCategory = 'tbl_category';
$tableSubCategory = 'tbl_sub_category';
$tableCustomer = 'tbl_customer';
$tablePeoducts = 'tbl_products';
$tableOrders = 'tbl_orders';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ecommerce site</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/favicon/favicon1.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap4.min.css">
    <!-- Font awesome kit-->
    <script src="https://kit.fontawesome.com/1b551efcfa.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css">
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
