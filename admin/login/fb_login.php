<?php
require_once '../app/start.php';
use Codecourse\Repositories\User as User;
use Codecourse\Repositories\Session as Session;

$user = new User();
Session::init();
require_once 'Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '330175074286695', // Replace {app-id} with your app id
    'app_secret' => '397577efc045edb9cf5b3a5be0520075',
    'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/pro_master/admin/login/fb-callback.php', $permissions);

echo '<a href="'.htmlspecialchars($loginUrl).'">Log in with Facebook!</a>';
