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
    <div class="container">
        <!-- Contact form -->
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6 sm-offset-3">
                <h1 class="page-heading text-center">Contact us </h1>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
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
                </div>
                <style>
                form,
                form>a {
                    display: inline;
                }
                </style>
                <div class="foprm-area mb-4 mt-4">
                    <form action="processContactUs.php" class="" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="" class="form-control form-control-sm"
                                        placeholder="First name...." value="<?= isset($firstName) ? $firstName : ''; ?>"
                                        aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="last_name" id="" class="form-control form-control-sm"
                                        placeholder="Last name...." value="<?= isset($lastName) ? $lastName : ''; ?>"
                                        aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="" class="form-control form-control-sm"
                                        placeholder="Email...." value="<?= isset($email) ? $email : ''; ?>"
                                        aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" id="" class="form-control form-control-sm"
                                        placeholder="Phone no...." value="<?= isset($phone) ? $phone : ''; ?>"
                                        aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="" rows="3"
                                        placeholder="Message...."><?= isset($messageData) ? $messageData : ''; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="action" value="verify">

                        <input type="hidden" name="customer_session" value="<?= $customerId; ?>">

                        <input type="hidden" name="customer_id" value="<?= $sessionId; ?>">

                        <button type="submit" name="submit" value="contact-us" class="btn btn-sm btn-success"><i
                                class="fas fa-envelope"></i> Contact us</button>

                        <input type="hidden" name="action" value="verify">

                        <input type="hidden" name="session_id" value="<?= $sessionId; ?>">
                    </form>
                    <form action="#" method="post" class="mb-">
                        <button type="submit" class="btn btn-sm btn-info" onClick="history.go();"><i
                                class="fas fa-sync-alt"></i> Refresh </button>
                    </form>
                    <form action="contactIndex.php" method="post">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-home"></i>
                            Contact Home</button>
                    </form>
                </div>

            </div>
        </div>
        <!-- Contact form -->
    </div><!-- /Content area ends -->

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