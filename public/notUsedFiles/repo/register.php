<!doctype html>
<html lang="en">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/1b551efcfa.js"></script>
        <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            /* background-image: url(img/background/background12.jpg);
            background-repeat: no-reprat; */
        }

        .container {
            width: 55%;
            max-height: px;
            margin-top: 100px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;
        }

        h5 {
            text-transform: uppercase;
            text-align: center;
        }

        .form-control {
            border: 1px solid #999;
            border-top: none;
            border-right: none;
            border-left: none;
            display: block;
            width: 100%;
            height: 30px;
            padding-left: 5px;
        }

        :focus {
            outline: none;
        }

        .form-group {
            display: flex;
        }

        .form-group input {
            width: 50%;
        }

        .input-group-text {
            border-bottom: 1px solid#888;
            background-color: #FFF;
            border-right: none;
            border-top: none;
        }
        </style>
    </head>

    <body>
        <div class="container bg-light">
            <div class="row pt-3 pb-3">
                <div class="col-sm-6 image-cover-left">
                    <img class="img-fluid img-responsive" style="width:100%;height:392px;border-radius: 5px;"
                        src="img/background/sunrise.jpeg" alt="">
                </div>
                <div class="col-sm-6 form-input-area">
                    <h5>Registration Form</h5>
                    <?php
                require_once '../../admin/app/start.php';

                use Codecourse\Repositories\Session as Session;

                Session::init();
                if (isset($_GET['registrationError'])) {
                    $message = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                            </button>
                                            <strong>SORRY!</strong> wrong email address or password !!!
                                        </div>';
                    echo $message;
                    header("Refresh:5, login.php");
                }
                $message = Session::get('message');
                if (!empty($message)) {
                    echo $message;
                    Session::set('message', null);
                    header("Refresh:3");
                }

                ?>
                    <form action="processCustomerProfile.php" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="first_name" placeholder="First name">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last name">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="email" placeholder="Your Email">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i> </span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="phone" placeholder="Your phone">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i> </span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="address" placeholder="Your address">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-address-book"></i> </span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="zip_code" placeholder="Your zip code">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-file-archive"></i> </span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="country" placeholder="Your country">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-flag"></i> </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Your password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-lock"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="confirm_password"
                                        placeholder="Confirm password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-lock"></i> </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submot" name="submit" value"register" class="btn btn-large btn-block btn-info"><i
                                class="fas fa-users"></i> Register</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    </body>

</html>