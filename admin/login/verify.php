<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Verify | Pro_master</title>
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

            .login-box {
                margin-top: 30px;
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
        </style>
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <div class="login-logo">
                    <a href="#"><span class="text-color"><b>Project Master</b> Account Verification</a></span>
                    <hr class="hr-color">
                </div>
                <div class="text-center text-color">
                    <h4>Wait for a few secnds to be redirected !!!</h4>
                </div>
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
                    $statusY = 'Y';
                    $statusN = 'N';
                    $stmt = $user->runQuery('SELECT userID, userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1');
                    $stmt->execute(array(':uID' => $id, ':code' => $code));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount() > 0) {
                        if ($row['userStatus'] == $statusN) {
                            $stmt = $user->runQuery('UPDATE tbl_users SET userStatus=:status WHERE userID=:uID');
                            $stmt->bindparam(':status', $statusY);
                            $stmt->bindparam(':uID', $id);
                            $stmt->execute();
                            $msg = "<div class='alert alert-success'>
                                    <button class='close' data-dismiss='alert'>&times;
                                    </button><strong>WOW !</strong> Your Account is Now Activated !!!
                                    </div>
                                    <div><a href='index.php' class='btn btn-sm btn-success'>Click to Login</a></div>";
                            header('Refresh:3, index.php');
                        } else {
                            $msg = "<div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;
                                    </button><strong>SORRY !</strong> Your Account is allready Activated !!!
                                    </div>
                                    <div><a href='index.php' class='btn btn-sm btn-success'><i class='fa fa-login'>
                                    </i> Click to Login</a></div>";
                            header('Refresh:3, index.php');
                        }
                    } else {
                        $msg = "<div class='alert alert-warning'>
                                <button class='close' data-dismiss='alert'>&times;
                                </button><strong>SORRY !</strong>No Account Found !!!
                                </div>
                                <div><a href='signup.php' class='btn btn-sm btn-warning'><i class='fa fa-user'>
                                </i> Signup here</a></div>";
                        header('Refresh:3, signup.php');
                    }
                } ?>
                <?php
                if (isset($msg)) {
                    echo $msg;
                } ?>
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
