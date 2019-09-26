<?php

class Process
{
    public function __construct()
    {

        if (isset($_POST['submit'])) {
            $accessor = $_POST['submit'];
            switch ($accessor) {
                case 'index':
                    if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                        if ($_REQUEST['action'] == 'verify') {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (isset($_POST['submit'])) {
                                    include_once 'pages/home.php';
                                    if (isset($_POST['page_title'])) {
                                        $page_title = 'Home Page of Peoducts';
                                    }
                                }
                            }
                        }
                    }
                    break;
                case 'cart':
                    if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                        if ($_REQUEST['action'] == 'verify') {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (isset($_POST['submit'])) {
                                    include_once 'pages/cart.php';
                                }
                            }
                        }
                    }
                    break;
                case 'single':
                    if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                        if ($_REQUEST['action'] == 'verify') {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (isset($_POST['submit'])) {
                                    include_once 'pages/single.php';
                                }
                            }
                        }
                    }
                    break;
                default:
                #...
                    break;
            }
            $process = new Process;
        } else {
            if (isset($_POST['home']) && $_POST['home'] == 'dashboard') {
                $data = 'pages/home.php';
                include_once $data;
            } else {
                include_once 'pages/home.php';
            }
        }
    }
}
if (isset($_POST['submit'])) {
    echo 'hellow';
} else {
    echo 'Not set';
}
