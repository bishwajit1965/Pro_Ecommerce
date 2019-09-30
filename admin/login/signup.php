<?php

require_once '../app/start.php';

use Codecourse\Repositories\User as User;
use Codecourse\Repositories\Session as Session;

Session::init();
$reg_user = new User();

if ($reg_user->is_logged_in() != '') {
    $reg_user->redirect('home.php');
}

if (isset($_POST['btn-signup'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtpass']);
    $vupass = trim($_POST['vtxtpass']);
    $code = md5(uniqid(rand()));
    $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
    $stmt->execute(array(':email_id' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        $msg = "<div class='alert alert-error'>
			<button class='close' data-dismiss='alert'>&times;</button>
			<strong>SORRY !</strong> email allready exists.Try another one.
		</div>";
    } else {
        if ($reg_user->register($firstName, $lastName, $email, $upass, $vupass, $code)) {
            $id = $reg_user->lasdID();
            $key = base64_encode($id);
            $id = $key;
            $message = "
				Hello $firstName $lastName,<br/><br/>
				Welcome to Project Master! <br/>
				To complete your registration  please , just click following link <br/><br /><br />
                <a href='http://localhost/pro_master/admin/login/verify.php?id=$id&code=$code'>
                Click HERE to Activate :)</a>
				<br /><br />
				Thanks,";
            $subject = 'Confirm Registration';
            $reg_user->send_mail($email, $message, $subject);
            $msg = "
				<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Success!</strong>  We have sent an email to $email.
                    Please click on the confirmation link in the email to create your account.
		  		</div>";
        } else {
            echo 'sorry , Query could not be executed...';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pro_master | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .register-box-body {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;
            background-color: #52a8ff;
        }

        .register-logo a {
            text-shadow: 1px 2px 4px #000;
        }

        .register-logo {
            margin-bottom: 5px;
        }

        body {
            background-image: url(../images/patterns/pattern13.jpg);
        }

        .register-box {
            margin-top: 20px;
        }

        .hr-color {
            background-color: #DDD;
            height: 2px;
            border-radius: 5px;
            margin-top: 5px;
            margin-bottom: 0px;
        }

        .text-color {
            color: #FFF;
        }

        .text-color a {
            color: #FFF;
        }

        .text-color a:hover {
            color: #333;
            font-size: 16px;
            font-weight: bold;
        }

        .login-box-message {
            color: #FFF;
            text-align: center;
        }

        input[type=text],
        input[type=password],
        #abc {
            background-color: #DDD;
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-box-body">
            <div class="register-logo">
                <a href="#"><span class="text-color"><b>Proj Master</b> Register</span></a>
                <hr class="hr-color">
            </div>
            <div class="text-center text-color">
                <p>Register a new membership</p>
            </div>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            if (isset($_GET['fnError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> First name was left empty !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                echo $error;
            }
            if (isset($_GET['fnLenError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> First name needs at least 3 chars !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                echo $error;
            }
            if (isset($_GET['fnPtnError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> First name spaces & letters only !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                echo $error;
            }
            if (isset($_GET['lnError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> Last name was left empty.
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

                echo $error;
            }
            if (isset($_GET['lnLenError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> Last name needs at least 3 chars !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                echo $error;
            }
            if (isset($_GET['lnPtnError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong>  Last name spaces & letters only !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                echo $error;
            }


            if (isset($_GET['mailError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> Email field was left empty!
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

                echo $error;
            }
            if (isset($_GET['mailPtnError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> Invalid email pattern supplied !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

                echo $error;
            }
            if (isset($_GET['uPassEmptyError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                        <strong> SORRY !</strong> First name was left empty.
                        <button type = "button" class="close" data-dismiss="alert" aria-label ="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';

                echo $error;
            }
            if (isset($_GET['vPassEmptyError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> First name was left empty.
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';

                echo $error;
            }
            if (isset($_GET['upassStrLengthError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong>SORRY !</strong> Password should be at least 6 chars !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                echo $error;
            }
            if (isset($_GET['vpassStrLengthError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong>SORRY !</strong> Verify password should be at least 6 chars !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';

                echo $error;
            }
            if (isset($_GET['passMisMatchError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> Two Passwords do not match !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                echo $error;
            }
            if (isset($_GET['passError'])) {
                $error =
                    '<div class ="alert alert-danger alert-dismissible" role="alert" >
                    <strong> SORRY !</strong> Alphanumeric & spl chrs for pswd !
                    <button type = "button" class="close" data-dismiss="alert" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                echo $error;
            }
            ?>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="firstName" class="form-control" placeholder="First name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="lastName" class="form-control" placeholder="Last name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="txtemail" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="txtpass" class="form-control" placeholder="Password (special symbols, letters, numbers)">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="vtxtpass" class="form-control" placeholder="Retype password (special symbols, letters, numbers)">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="checkbox icheck pull-left text-color">
                            <label>
                                <input type="checkbox"> I agree to the &nbsp;<a href="terms.php">
                                    <i class="fa fa- fa-list"></i> Terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-signup">
                            <i class="fa fa-user"></i> Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat "><i class="fa fa-facebook"></i> Sign up using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                    Google+</a>
                </div> -->

            <div class="text-center text-color">
                <a href="index.php" class="text-center"><strong> Already have a membership ! Click to log
                        in.</strong></a>
            </div>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
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
