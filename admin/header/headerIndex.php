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
        <?php
        // Class is instantiated
        use Codecourse\Repositories\Header as Header;
        use Codecourse\Repositories\Helpers as Helper;
        use Codecourse\Repositories\Session as Session;

        $header = new Header();
        $helper = new Helper;
        Session::init();
        $table = 'tbl_header';
        ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Header index page<small>it all starts here</small></h1>
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
                    <h3 class="box-title">
                        <a class="btn btn-sm btn-primary" href="addHeader.php">
                            <i class="fa fa-plus"></i> Add Header data</a>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Code below -->
                    <?php
                    // Will display all the messages vlidation/insert/update/delete
                    $message = Session::get('message');
                    if (!empty($message)) {
                        echo $message;
                        Session::set('message', null);
                    }
                    // Get the delete id
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];
                        $dataDestroyed = $header->destroy($id, $table);
                        if ($dataDestroyed) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                            <strong> WOW !</strong> Header data has been removed from database !!!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            Session::set('message', $message);
                            $home_url = 'headerIndex.php';
                            $header->redirect($home_url);
                        }
                    }
                    ?>
                    <table id="example1" class="table table-bordered table-sm table-condensed table-striped table-compact">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Slogan</th>
                                <th>Established</th>
                                <th>Photo</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $headerData = $header->index($table);
                            if (!empty($headerData)) {
                                $id = 1;
                                foreach ($headerData as $result) {
                                    ?>
                                    <tr>
                                        <td><?php echo $id++; ?>
                                        </td>
                                        <td><?php echo $result->title; ?>
                                        </td>
                                        <td><?php echo $result->slogan; ?>
                                        </td>
                                        <td><?php echo $helper->dateFormat($result->established); ?>
                                        </td>
                                        <td>
                                            <?php if (empty($result->photo)) { ?>
                                                <img src="../gallery/avatar/avatar.png" alt="Alternative Image" style="width:50px;height:50px;">
                                            <?php } else { ?>
                                                <img src="<?php echo $result->photo; ?>" class="img-thumbnail" style="width:50px;height:50px;" alt="Product Photo">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $helper->dateFormat($result->established); ?>
                                        </td>
                                        <td><?php if ($_SESSION['userEmail'] == $user_home->getEmail()) { ?>
                                                <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit data!" href="editHeader.php?edit_id=<?php echo $result->id; ?>"><i class="fa fa-pencil"></i> Edit</a>

                                                <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete data here!" href="headerIndex.php?delete_id=<?php echo $result->id; ?>" onClick="return confirm('Do you really want to delete this data? If deleted it is lost for ever !!!');"><i class="fa fa-trash"></i> Delete</a>

                                                <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="View then delete!" href="deleteHeader.php?delete_id=<?php echo $result->id; ?>">
                                                    <i class="fa fa-trash"></i> View & Delete</a>

                                            <?php } else { ?>
                                                <a class="btn btn-xs btn-primary" href="editHeader.php?edit_id=<?php echo $result->id; ?>">
                                                    <i class="fa fa-eye"></i> View</a><?php } ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Slogan</th>
                                <th>Established</th>
                                <th>Photo</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </tfooter>
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
