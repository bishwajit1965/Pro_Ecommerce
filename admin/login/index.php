<?php

require_once '../app/start.php';
use Codecourse\Repositories\User as User;
use Codecourse\Repositories\Session as Session;

Session::init();

$user_login = new User();
if ($user_login->is_logged_in() != '') {
    $user_login->redirect('home.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btn-login'])) {
        $email = trim($_POST['txtemail']);
        $upass = trim($_POST['txtupass']);
        $remember = trim($_POST['remember']);
    }
    if (isset($remember)) {
        $user_login->login($email, $upass, $remember);
        $user_login->redirect('home.php');
    } else {
        if (!isset($remember)) {
            $user_login->login($email, $upass);
            $user_login->redirect('dashboard.php');
        }
    }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Login | Pro_master</title>
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
        <!-- iCheck -->
        <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
        <!-- Google Font -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            body {
                background-image: url(../images/patterns/pattern13.jpg);
            }

            .login-box {
                margin-top: 20px;
            }

            .login-box-body {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                border-radius: 5px;
                background-color: #52a8ff;
            }

            .login-logo a {
                text-shadow: 1px 2px 4px #000;
            }

            .login-logo {
                margin-bottom: 5px;
            }

            .hr-color {
                background-color: #edeff0;
                height: 2px;
                border-radius: 5px;
                margin-top: 5px;
                margin-bottom: 0px;
            }

            .text-color {
                color: #edeff0;
            }

            .text-color a {
                color: #edeff0;

            }

            .text-color a:hover {
                color: #333;
                font-size: 16px;
                font-weight: bold;
            }

            .login-box-message {
                lor: #FFF;
                text-align: center;
            }
        </style>
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <div class="login-logo">
                    <a href="#"><span class="text-color"><b>Project Master</b>Admin Login</a></span>
                    <hr class="hr-color">
                </div>
                <div class="text-center text-color">
                    <p>Sign in to start your session</p>
                </div>
                <?php
                // Validation messages
                if (isset($_GET['blankEmail'])) {
                    ?>
                <div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>SORRY !!! Email field was left blank ! </strong>
                </div>
                <?php
                }
                if (isset($_GET['emptyEmail'])) {
                    ?>
                <div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>SORRY !!! Email address does not match ! </strong>
                </div>
                <?php
                }
                if (isset($_GET['passwordError'])) {
                    ?>
                <div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>SORRY !!! Password does not match ! </strong>
                </div>
                <?php
                }
                if (isset($_GET['inactive'])) {
                    ?>
                <div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>SORRY!!</strong> This Account is not Activated Go to your Inbox and Activate it.
                </div>
                <?php
                }
                ?>
                <form action="" method="post" id="login-form">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="txtemail" id="email" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="txtupass" id="password"
                            placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" value="1" <?php echo isset($_COOKIE['userEmail']) ?'checked' : ''; ?>><span
                                        class="text-color"> Remember Me</span>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-login">
                                <i class="fa fa-user"></i> Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p class="text-color">- OR -</p>

                    <a href="fb_login.php" class="btn btn-block btn-social btn-facebook btn-flat">
                        <i class="fa fa-facebook"></i> Sign in using Facebook</a>

                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus">
                        </i> Sign in using Google+</a>
                </div>
                <!-- /.social-auth-links -->
                <div class="text-center text-color">
                    <a href="fpass.php">I forgot my password</a><br>
                    <a href="signup.php">Register a new membership</a>
                </div>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js"></script>
        <?php
        if (isset($_COOKIE['userEmail']) && isset($_COOKIE['userPass'])) {
            $email = $_COOKIE['userEmail'];
            $pass = $_COOKIE['userPass'];
            echo "
            <script>
                document.getElementById('email').value = '$email';
                document.getElementById('password').value = '$pass';
            </script>";
        }
        ?>
        <!-- Fade out bootstrap alert messages -->
        <script type="text/javascript">
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                        $(this).remove();
                    });
                }, 3000);
            });
        </script>
        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>

</html>