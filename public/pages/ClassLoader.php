<?php
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

// Verifies if the customer logged in or not
Session::checkSession();

// Session id for individual customer
$sessionId = session_id();

// Session based individual customer Id
$customerId = Session::get('customerId');

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
$tableCategory = 'tbl_category';
$tableSubCategory = 'tbl_sub_category';
$tableCustomer = 'tbl_customer';
$tableCart = 'tbl_cart';
$tablePeoducts = 'tbl_products';
$tableOrders = 'tbl_orders';
$tableOrderArchive = 'tbl_order_archive';
