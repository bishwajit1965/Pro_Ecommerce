<?php include_once 'partials/_head.php'; ?>

<body>
    <div class="container-fluid">
        <!-- Header Border -->
        <div class="row bg-dark py-1"></div>
        <!-- /Header Border -->

        <!-- Header -->
        <?php include_once 'partials/_header.php'; ?>
        <!-- /Header ends -->

        <!-- Navbar -->
        <?php include_once 'partials/_navbar.php'; ?>
        <!-- /Navbar ends -->
    </div>
    <!-- Content area begins -->
    <style>
    .page-heading {
        font-size: 45px;
        font-weight: 900;
        color: #333;
        text-shadow: 1px 2px 4px #777;
    }

    hr {
        background-color: #138496;
        padding: 3px;
        margin-top: -5px;
    }

    h1 {
        margin-bottom: 15px;
    }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="page-heading">Contact Index Page</h1>
        </div>
        <div class="row">
            <?php
            include_once '../../admin/app/start.php';

            use Codecourse\Repositories\Session as Session;

            // Validation message
            $message = Session::get('message');
            if (!empty($message)) {
                echo $message;
                Session::set('message', null);
            }
            ?>

        </div>
        <div class="row">
            <div class="table-responsive w-100">
                <table class="table table-sm tablke-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $contactUs->index($tableContactUs);
                        if ($result) {
                            $id = 1;
                            foreach ($result as $contctData) { ?>
                        <tr>
                            <td><?= $id++; ?></td>
                            <td><?= $contctData->first_name; ?></td>
                            <td><?= $contctData->last_name; ?></td>
                            <td><?= $contctData->email; ?></td>
                            <td><?= $contctData->phone; ?></td>
                            <td><?= $helpers->textShorten($contctData->message, 50); ?></td>
                            <td>
                                <a href="editContact.php?edit_id=<?= $contctData->id; ?>"
                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete_id=<?= $contctData->id; ?>" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /Content area ends -->
    </div>
    <!-- Footer area begins -->
    <div class="container-fluid">
        <!-- Footer top -->
        <?php include_once 'partials/_top-footer.php'; ?>
        <!-- /Footer top -->

        <!-- Footer -->
        <?php include_once 'partials/_footer.php'; ?>
        <!-- /Footer ends -->
    </div>
    <!-- /Footer area ends -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once 'partials/_scripts.php'; ?>
</body>

</html>