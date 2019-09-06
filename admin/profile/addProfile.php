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
                Add profile data
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
                    <h3 class="box-title">Title</h3>

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
                        <?php
                        use Codecourse\Repositories\Profile as Profile;

                        $profile = new Profile();

                        // Fetching data to match only
                        $profileData = $profile->dataExists();
                        if (!empty($profileData)) {
                            foreach ($profileData as $value) {
                                #.... No coding is needed
                            }
                        }
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['btn-insert'])) {
                                $about_me = $_POST['about_me'];
                                $pro_social = $_POST['pro_social'];
                                $sess_id = $_POST['userID'];
                                $permitted    = ['jpg', 'jpeg', 'png', 'gif'];
                                $file_name    = $_FILES['photo']['name'];
                                $file_size    = $_FILES['photo']['size'];
                                $file_temp    = $_FILES['photo']['tmp_name'];
                                $div          = explode('.', $file_name);
                                $file_ext     = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                                $photo = "uploads/" . $unique_image;

                                // Sanitizing string data
                                if (!empty($file_name)) {
                                    $fields = [
                                    'about_me' => $about_me,
                                    'pro_social' => $pro_social,
                                    'photo' => $photo,
                                    'userID' => $sess_id
                                    ];

                                    if (!empty($about_me) && !empty($pro_social)) {
                                        $about_me = filter_var($about_me, FILTER_SANITIZE_STRING);
                                        $pro_social = filter_var($pro_social, FILTER_SANITIZE_STRING);
                                    }

                                    if (empty($_POST['about_me'])) {
                                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                        <strong> SORRY !</strong> Name field was left blank !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    } elseif (empty($_POST['pro_social'])) {
                                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                        <strong> SORRY !</strong> Description field was left blank !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    } elseif (empty($file_name)) {
                                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                        <strong> SORRY !</strong> Photo field was left blank !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    } elseif ($file_size > 1048567) {
                                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <strong id= "strong"#9C0A0A>WARNING!!! File size is larger than 1 MB!
                                        </strong>&nbsp &nbsp
                                        </div>';
                                    } elseif (in_array($file_ext, $permitted) === false) {
                                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <strong id= "strong"#9C0A0A> You can upload only  . implode(', ', $permitted).
                                        </strong>&nbsp &nbsp
                                        </div>';
                                    } else {
                                        // If one user's profile data exists no data will be inserted
                                        if ($_SESSION['userSession'] == $value->userID) {
                                            echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                            <strong> SORRY !</strong> Your profile data is already inserted !!!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                                        } else {
                                            // Will store data in database with picture
                                            $profile->store($fields);
                                            move_uploaded_file($file_temp, $photo);
                                        }
                                    }
                                } else {
                                    $fields = [
                                    'about_me' => $about_me,
                                    'pro_social' => $pro_social,
                                    'userID' => $sess_id
                                    ];
                                    if (!empty($name) && !empty($description)) {
                                        $name = filter_var($name, FILTER_SANITIZE_STRING);
                                        $description = filter_var($description, FILTER_SANITIZE_STRING);
                                    }

                                    if (empty($_POST['about_me'])) {
                                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                        <strong> SORRY !</strong> About me field was left blank !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    } elseif (empty($_POST['pro_social'])) {
                                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                        <strong> SORRY !</strong> Social site field was left blank !!!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    } else {
                                        // If one user's profile data exists no data will be inserted
                                        if ($_SESSION['userSession'] == $value->userID) {
                                            echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                            <strong> SORRY !</strong> Your profile data is already inserted !!!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                                        } else {
                                            // Will store data in database without picture
                                            $profile->store($fields);
                                        }
                                    }
                                }
                            }
                        }
                        ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name"> About me:</label>
                                <input type="text" name="about_me" class="form-control"
                                    placeholder="Insert about me data...."
                                    value="<?php echo isset($_POST['about_me']) ? $_POST['about_me']: '';?>">
                            </div>
                            <div class="form-group">
                                <label for="name"> Social:</label>
                                <input type="text" name="pro_social" class="form-control"
                                    placeholder="Insert social link data...."
                                    value="<?php echo isset($_POST['pro_social']) ? $_POST['pro_social']: ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo:</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>

                            <input type="hidden" name="userID" class="form-control"
                                value="<?php echo $_SESSION['userSession']; ?>">

                            <button type="submit" name="btn-insert" class="btn btn-sm btn-primary"><i
                                    class="fa fa-upload"></i> Upload</button>

                            <a href="profileIndex.php" class="btn btn-sm btn-warning">
                                <i class="fa fa-fast-backward"></i> Profile Index</a>
                        </form>
                    </div>
                    <!-- Code above -->
                </div>
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
