<?php
class Process
{
    public function __construct()
    {
        if (isset($_POST['submit'])) {
            $accessor = $_POST['submit'];
            switch ($accessor) {
                case 'add-to-cart':
                    if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
                        if ($_REQUEST['action'] == 'verify') {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (isset($_POST['submit'])) {
                                    echo "I reside in add to cart option";
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
        }
    }
}

if (isset($_POST['submit'])) {
    $process = new Process();
    return $process;
} else {
    $home_url = 'single.php';
    header("Location: $home_url?error");
}
