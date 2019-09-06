<?php
require_once '../app/start.php';
use Codecourse\Repositories\User as User;
use Codecourse\Repositories\Session as Session;

Session::init();

$user = new User();
if ($user->is_logged_in() != '') {
    $user->redirect('home.php');
}

if (isset($_POST['btn-submit'])) {
    $email = $_POST['txtemail'];
    $stmt = $user->runQuery('SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1');
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() == 1) {
        $id = base64_encode($row['userID']);
        $code = md5(uniqid(rand()));
        $stmt = $user->runQuery('UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email');
        $stmt->execute(array(':token' => $code, 'email' => $email));
        $message = "Hello , $email
        <br/><br/>
        We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,
        <br/><br/>
        Click Following Link To Reset Your Password
        <br /><br />
        <a href='http://localhost/pro_master/admin/login/resetpass.php?id=$id&code=$code'>
        click here to reset your password</a>
        <br /><br />
        thank you :)
        ";
        $subject = 'Password Reset';
        $user->send_mail($email, $message, $subject);
        $msg = "<div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        We've sent an email to $email.
        Please click on the password reset link in the email to generate new password.
        </div>";
    } else {
        $msg = "<div class='alert alert-danger'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Sorry!</strong>  this email not found.
        </div>";
    }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Forgot password | Pro_master</title>
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
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .login-box-body {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                border-radius: 5px;
                background-color: #52a8ff;
            }

            body {
                background-image: url(../images/patterns/pattern13.jpg);
            }

            .login-box {
                margin-top: 20px;
            }

            .login-logo a {
                text-shadow: 1px 2px 4px #000;
            }

            .login-logo {
                margin-bottom: 5px;
            }



            .hr-color {
                background-color: #DDD;
                height: 2px;
                ;
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
                color: #DDD;
            }

            .login-box-message {
                color: #FFF;
                text-align: center;
            }

            input[type=email] {
                background-color: #DDD;
            }
        </style>
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <div class="login-logo">
                    <div class="login-logo">
                        <a href="#"><span class="text-color"><b>Project Master</b> Recover password</a></span>
                        <hr class="hr-color">
                    </div>
                </div>
                <div class="text-center text-color">
                    <p>Reset your password</p>
                </div>
                <form class="form" method="post">
                    <?php
                if (isset($msg)) {
                    echo $msg;
                } else {
                    ?>
                    <div class='alert alert-info'>
                        Please enter your email address. You will receive a link to create a new password via email !
                    </div>
                    <?php
                } ?>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email address" name="txtemail" required />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <hr class="hr-color"><br>

                    <button class="btn btn-sm btn-danger" type="submit" name="btn-submit"><i class="fa fa-lock"></i>
                        Generate a new Password</button>

                    <span class="pull-right">
                        <a href="index.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-user"></i> Log
                            in</a>
                    </span>
                </form>
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
