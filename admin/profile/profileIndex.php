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
            <h1>Profile index page<small>it all starts here</small></h1>
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
                    <!-- <h3 class="box-title">List of all users</h3> -->
                    <a href="addProfile.php" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Profile
                        Data</a>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <?php
                    if (isset($_GET['pupdated']) && isset($_GET['pupdated']) == 1) {
                        echo '<div class="alert alert-success alert-dismissible " role="alert">
                        <strong> WOW !</strong> Profile data updated successfully with new selected photo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    if (isset($_GET['updated']) && isset($_GET['updated']) == 1) {
                        echo '<div class="alert alert-success alert-dismissible " role="alert">
                        <strong> WOW !</strong> Profile data updated successfully with existing photo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    if (isset($_GET['deleted']) && isset($_GET['deleted']) == 1) {
                        echo '<div class="alert alert-warning alert-dismissible " role="alert">
                        <strong> DELETED !</strong> Profile data deleted successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                    ?>
                    <div class="table-responsive">
                        <table id="example1" class="table table-responsive table-striped table-condensed table-primary">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>About me</th>
                                    <th>Social</th>
                                    <th>Profile Photo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                use Codecourse\Repositories\Profile as Profile;

                                $profile = new Profile();
                                // Will delete profile data
                                if (isset($_GET['delete_id'])) {
                                    $id = $_GET['delete_id'];
                                    $profile->destroy($id);
                                }

                                use Codecourse\Repositories\User as User;

                                $user = new User;

                                // Will ldisp;ay all the profile data
                                $profileData = $profile->index();

                                if (!empty($profileData)) {
                                    $id = 1;
                                    foreach ($profileData as $profile) {
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $id++; ?>
                                    </td>
                                    <td>
                                        <?php echo $profile->about_me; ?>
                                    </td>
                                    <td>
                                        <?php echo $profile->pro_social; ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo $profile->photo; ?>" alt="Profile photo"
                                            class="img-thumbnail img-responsive" style="width:90px;hight:80px;">
                                    </td>
                                    <td>
                                        <?php
                                        if ($_SESSION['userEmail'] == $user->getEmail()) {
                                            ?>
                                        <a href="addProfile.php" class="btn btn-xs btn-primary"><i
                                                class="fa fa-plus"></i> Add Profile</a>

                                        <a class="btn btn-xs btn-primary"
                                            href="editProfile.php?edit_id=<?php echo $profile->pro_id; ?>"><i
                                                class="fa fa-pencil"></i> Edit</a>

                                        <a class="btn btn-xs btn-danger"
                                            href="profileIndex.php?delete_id=<?php echo $profile->pro_id; ?>"
                                            onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');">
                                            <i class="fa fa-trash"></i> Delete</a>
                                            <?php
                                        } elseif ($_SESSION['userEmail'] == $user->getEditorEmail()) {
                                            ?>
                                        <a href="addProfile.php" class="btn btn-xs btn-primary"><i
                                                class="fa fa-plus"></i> Add Profile</a>
                                        <a class="btn btn-xs btn-primary"
                                            href="editProfile.php?edit_id=<?php echo $profile->pro_id; ?>"><i
                                                class="fa fa-pencil"></i> Edit</a>

                                            <?php
                                        } elseif ($_SESSION['userEmail'] == $user->getAuthorEmail()) {
                                            ?>
                                        <a href="addProfile.php" class="btn btn-xs btn-primary"><i
                                                class="fa fa-plus"></i> Add Profile</a>
                                        <a class="btn btn-xs btn-primary"
                                            href="editProfile.php?edit_id=<?php echo $profile->pro_id; ?>"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                            <?php
                                        } else {
                                            ?>
                                        <a class="btn btn-xs btn-primary"
                                            href="editProfile.php?edit_id=<?php echo $profile->pro_id; ?>">
                                            <i class="fa fa-eye"></i> View</a>
                                            <?php
                                        } ?>
                                    </td>

                                </tr>

                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>Id</th>
                                    <th>About me</th>
                                    <th>Social</th>
                                    <th>Profile Photo</th>
                                    <th>Actions</th>
                                </tr>
                            </tfooter>
                        </table>
                        </table>
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
    <?php include_once '../partials/_footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include_once '../partials/_scripts.php'; ?>
</body>

</html>
