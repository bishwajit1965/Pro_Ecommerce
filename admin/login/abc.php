<?php
require_once '../app/start.php';
use Codecourse\Repositories\User as User;
use Codecourse\Repositories\Session as Session;

Session::init();
$user_home = new User();


echo '<a href="../gallery/addGallery.php">Link</a>';
