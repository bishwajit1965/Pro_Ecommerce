<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Password Reset</title>
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

            .login-logo a {
                text-shadow: 1px 2px 4px #000;
            }

            .login-logo {
                margin-bottom: 5px;
            }

            body {
                background-image: url(../images/patterns/pattern13.jpg);
            }

            .login-box {
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
        </style>
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">
                <div class="login-logo">
                    <a href="#"><span class="text-color"><b>Project Master</b> Generate Password</a></span>
                    <hr class="hr-color">
                </div><br>
                <?php

                require_once '../app/start.php';
                use Codecourse\Repositories\User as User;

                $user = new User();

                if (empty($_GET['id']) && empty($_GET['code'])) {
                    $user->redirect('index.php');
                }

                if (isset($_GET['id']) && isset($_GET['code'])) {
                    $id = base64_decode($_GET['id']);
                    $code = $_GET['code'];
                    $stmt = $user->runQuery('SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token');
                    $stmt->execute(array(':uid' => $id, ':token' => $code));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount() == 1) {
                        if (isset($_POST['btn-reset-pass'])) {
                            $pass = $_POST['pass'];
                            $cpass = $_POST['confirm-pass'];
                            if ($cpass !== $pass) {
                                $msg = "<div class='alert alert-danger'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry!</strong>  Passwords do not match.
                                </div>";
                            } else {
                                $password = md5($cpass);
                                $sql = 'UPDATE tbl_users SET userPass=:upass WHERE userID=:uid';
                                $stmt = $user->runQuery($sql);
                                $stmt->execute(array(':upass' => $password, ':uid' => $rows['userID']));

                                $msg = "<div class='alert alert-success'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                Password has been Changed!
                                </div>";
                                header('refresh:2;index.php');
                            }
                        }
                    } else {
                        $msg = "<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        No Account Found, Try again
                        </div>";
                    }
                }?>
                <form class="" method="post">
                    <div class='alert alert-warning'>
                        <strong>Hello ! <?php echo $rows['firstName'].' '.$rows['lastName']; ?></strong>
                        you are here to reset your forgetton password.
                    </div>
                    <!-- <p class="text-color text-center"> Reset your password</p><hr class="hr-color"><br> -->
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }?>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="New Password" name="pass" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Confirm New Password"
                            name="confirm-pass" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <hr class="hr-color"><br>

                    <button class="btn btn-sm btn-success" type="submit" name="btn-reset-pass"><i
                            class="fa fa-lock"></i> Reset Your Password</button>
                    <span class="pull-right">
                        <a href="index.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-user"></i> Log
                            in</a>
                    </span>
                </form>
            </div>
        </div> <!-- /container -->
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
