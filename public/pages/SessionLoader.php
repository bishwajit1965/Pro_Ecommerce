<?php
include_once '../../admin/app/start.php';

use Codecourse\Repositories\Session as Session;

Session::init();
// Starts session
Session::init();

// Verifies if logged in or not
Session::checkSession();

// Session id for individual customer
$sessionId = session_id();