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

        <!-- Page title -->
        <!-- <div class="row text-center bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 pt-2">
                <h2>Your orderedpPrice details</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span class="badge badge-secondary"></h3>
            </div>
        </div> -->
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container">
        <div class="row">
            <style>
            .success-message {
                font-size: 45px;
                font-weight: 900;
                color: #333;
                text-shadow: 1px 2px 4px #777;

            }

            .greeting-message {
                font-size: 18px;
                font-weight: 600;
                color: #444;
                background-color: #F1F9F1;
                border-left: 6px solid#008080;
            }

            .total-amounts {
                font-size: 20px;
                font-weight: 800;
                color: #138496;
            }

            .total-amount-message {
                font-size: 20px;
                background-color: #F1F9F1;
                border-left: 6px solid#ff0000;
            }
            </style>
            <?php
            if (isset($_GET['testimonial_id'])) {
                $id = $_GET['testimonial_id'];
                $result = $frontEnd->viewSingleTestimonial($id, $tableContactUs);
                if ($result) { ?>
            <div class="col-sm-12 d-flex justify-content-center mb-4 mt-4">
                <h1 class="success-message">Hwllo viewers!!! Testimonial !!!</h1>
            </div>

            <div class="total-amount-message col-sm-12 d-flex justify-content-center mb-4 p-4">
                <h2>
                    <?= $result->first_name . ' ' .  $result->last_name . ' '; ?> says -</h2>
            </div>
            <div class="greeting-message px-4 py-4 col-sm-12">
                <p><?= $result->message; ?></p>
                <p>
                    <h2>Testimonial sent on : <?= $helpers->formatDate($result->sent_at); ?></h2>
                </p>
            </div>
            <div class="col-sm-12 links d-flex justify-content-center">
                <a href="orderDetails.php" class="btn btn-sm btn-info mt-4 mr-1 mb-4"><i class="fas fa-eye"></i>
                    View order details</a>

                <a href="../index.php" class="btn btn-sm btn-primary mt-4 mb-4"><i class="fas fa-cart-plus"></i>
                    Continue shopping</a>
            </div>
            <?php
                }
            } else {
                include __DIR__ . 'notFound.php';
            }
            ?>




        </div>
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