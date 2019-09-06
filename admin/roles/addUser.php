<?php
include_once '../app/start.php';
use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\User as User;
use Codecourse\Repositories\Profile as Profile;

Session::init();
$profile = new Profile;
$user_home = new User();

if (!$user_home->is_logged_in()) {
    $user_home->redirect('../login/index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btn-signup'])) {
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $email = trim($_POST['txtemail']);
        $upass = trim($_POST['txtpass']);
        $vupass = trim($_POST['vtxtpass']);
        $code = md5(uniqid(rand()));
        $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
        $stmt->execute(array(':email_id' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            $msg = "<div class='alert alert-error'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>SORRY !</strong> email allready exists.Try another.
            </div>";
        } else {
            if ($user_home->registerAdmin($firstName, $lastName, $email, $upass, $vupass, $code)) {
                $id = $user_home->lasdID();
                $key = base64_encode($id);
                $id = $key;
                $message = "
                    Hello $firstName $lastName,<br/><br/>
                    Welcome to Project Master! <br/>
                    To complete your registration  please , just click following link <br/><br/><br/>
                    <a href='http://localhost/pro_master/admin/login/verify.php?id=$id&code=$code'>
                    Click HERE to Activate :)</a>
                    <br /><br />
                    Thanks,";
                $subject = 'Confirm Registration';
                $user_home->send_mail($email, $message, $subject);
                $msg = "
                    <div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong>  We have sent an email to $email.
                        Please click on the confirmation link in the email to create your account.
                    </div>";
            } else {
                echo 'SORRY !!! Query could not be executed...';
            }
        }
    }
}
?>
<?php include_once '../partials/_head.php'; ?>
<!-- Site wrapper -->
<div class="wrapper">
    <?php include_once '../partials/_header.php'; ?>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <?php include_once '../partials/_leftSidebar.php'; ?>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add new user
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <a href="userIndex.php" class="btn btn-sm btn-primary"><i
                            class="glyphicon glyphicon-fast-backward"></i> User Index</a>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"> <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <div class="col-sm-6 col-sm-offset-3">
                        <h2><a style="color:#555;" href="#"><span class="text-color"><b>Register new user</b>
                                </span></a></h2>
                        <hr class="hr-color">
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
                                <input type="password" name="txtpass" class="form-control"
                                    placeholder="Password (special symbols, letters, numbers)">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="vtxtpass" class="form-control"
                                    placeholder="Retype password (special symbols, letters, numbers)">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <button type="submit" class="btn btn-primary btn-md" name="btn-signup">
                                    <i class="fa fa-user"></i> Register</button>
                            </div>
                        </form>
                        <!-- /.form-box -->
                    </div>
                    <!-- /.register-box -->
                </div>
                <!-- Code above -->

                <!-- /.box-body -->
                <div class="box-footer">Footer</div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once '../partials/_footer.php '; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>