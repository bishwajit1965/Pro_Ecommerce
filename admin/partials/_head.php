<?php
ob_start();

require_once '../app/start.php';

use Codecourse\Repositories\AboutUs as AboutUs;
use Codecourse\Repositories\Cart as Cart;
use Codecourse\Repositories\CustomerProfile as CustomerProfile;
use Codecourse\Repositories\Header as Header;
use Codecourse\Repositories\Helpers as Helpers;
use Codecourse\Repositories\Invoice as Invoice;
use Codecourse\Repositories\Products as Products;
use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\SocialMedia as SocialMedia;
use Codecourse\Repositories\User as User;

Session::init();

$cart = new Cart();
$customerProfile = new CustomerProfile();
$helpers = new Helpers();
$header = new Header();
$invoice = new Invoice();
$products = new Products();
$socialMedia = new SocialMedia();
$user_home = new User();
$aboutUs = new AboutUs;

// Necessary tables
$tableCustomer = 'tbl_customer';
$table = 'tbl_products';
$tableOrders = 'tbl_orders';
$tableOrdersArchive = 'tbl_order_archive';
$tableHeader = 'tbl_header';
$tableSocialMedia = 'tbl_social_sites';
$tableInvoice = 'tbl_invoice';
$tableAboutUs = 'tbl_about_us';

// Checks if logged in or not
if (!$user_home->is_logged_in()) {
  $user_home->redirect('../login/index.php');
}
$stmt = $user_home->runQuery('SELECT * FROM tbl_users WHERE userID=:uid');
$stmt->execute(array(':uid' => $_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project Master</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Favicon -->
  <link rel="icon" href="../images/favicon/favicon1.ico" type="image/x-icon" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Custom stylesheet -->
  <link rel="stylesheet" type="text/css" href="../css/app.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
