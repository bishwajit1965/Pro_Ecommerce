<!doctype html>
<html lang="en">
    <head>
        <title>User log in</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="icon" href="../img/favicon/favicon1.ico" type="image/x-icon" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Font awesome kit-->
        <script src="https://kit.fontawesome.com/1b551efcfa.js"></script>
        <link rel="stylesheet" href="../css/login.css">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 offset-sm-4 login-form p-5 login-form">
                    <form action="processLogin.php" class="" method="post">
                        <div class="row px-2 text-white justify-content-center">
                            <h3>User Login</h3>
                        </div>
                        <hr>
                        <?php
                        if (isset($_GET['logInError'])) {
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
                        ?>

                        <div class="form-group">
                            <!-- <label for="email">Email</label> -->
                            <input type="email" class="form-control form-control-sm" name="email" id=""
                                placeholder="Insert email addres..." required="required">
                        </div>
                        <div class="form-group">
                            <!-- <label for="">Password</label> -->
                            <input type="password" class="form-control form-control-sm" name="password" id=""
                                placeholder="Insert your password..." required="required">
                        </div>
                        <div class="login-register-linkls">
                            <p style="color:#c0c0c0;font-weight:bold;">Alrady registered ! then log-in otherwise
                                register</p>
                            <input type="hidden" name="action" value="verify">
                            <button type="submit" name="submit" value="login" class="btn btn-sm btn-info"><i
                                    class="fas fa-users"></i> Log
                                in</button>
                            <a href="registerForm.php" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fast-backward"></i> Register</a>
                        </div>
                    </form>
                    <a href="abc.php">Forgot password?</a>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
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
