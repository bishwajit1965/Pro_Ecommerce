<?php include_once '../partials/_head.php'; ?>

<body>
    <div class="container-fluid">
        <!-- Header Border -->
        <div class="row bg-dark py-1"></div>
        <!-- /Header Border -->

        <!-- Header -->
        <?php include_once '../partials/_header.php'; ?>
        <!-- /Header ends -->

        <!-- Navbar -->
        <?php include_once '../partials/_navbar.php'; ?>
        <!-- /Navbar ends -->

        <!-- Page title -->
        <div class="row text-center bg-info text-white">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h2>Your processed order data here !!!</h2>
            </div>
            <div class="col-sm-2">
                <h3><span class="badge badge-info"><i class="fas fa-cart-plus">&nbsp;</i><sup>3</sup></span
                        class="badge badge-secondary"></h3>
            </div>
        </div>
        <!-- /Page title -->
    </div>
    <!-- Content area begins -->
    <div class="container-fluid bg-light">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8 processed-order">
                <style>
                .processed-order>p {
                    border: 2px solid#DDD;
                    padding: 20px;
                    backgeound-color: #edeff0;
                    font-size: 20px;
                    line-height: 25px;
                    margin-top: 0px;

                }
                </style>

                <?php include_once 'validationMessage.php'; ?>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae nihil dolorum, quibusdam tenetur eum
                    atque qui modi magnam, assumenda dignissimos ab architecto, eius aut consectetur repellendus earum
                    at quisquam fugiat!
                </p>
            </div>
        </div>
    </div>
    <!-- /Content area ends -->

    <!-- Footer area begins -->
    <div class="container-fluid">
        <!-- Footer top -->
        <?php include_once '../partials/_top-footer.php'; ?>
        <!-- /Footer top -->

        <!-- Footer -->
        <?php include_once '../partials/_footer.php'; ?>
        <!-- /Footer ends -->
    </div>
    <!-- /Footer area ends -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include_once '../partials/_scripts.php'; ?>
</body>

</html>