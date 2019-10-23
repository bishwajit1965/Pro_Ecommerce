<?php
include_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;

$message = Session::get('message');
if (!empty($message)) {
    echo $message;
    Session::set('message', null);
}