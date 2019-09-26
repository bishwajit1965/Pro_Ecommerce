 <div class="row pt-1 header-area">
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <h1 id="heading">Ecommerce site</h1>
        <h3>Your favourite web store</h3>
        <h3> Serving since 1995</h3>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center text-center">
        <div class="search-container">
            <form action="#">
                <input type="text" class="pl-2" placeholder="Search..." name="search">
                <button type="submit" class="bg-warning"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center text-center">
        <form action="">
            <div class="input-group input-group-sm p-1">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning"><i class="fas fa-cart-plus"></i></span>
                </div>
                <input type="text" class="form-control p-0 pl-2" placeholder="Empty cart...">
            </div>
        </form>
    </div>
    <div class="col-sm-3 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-sm-8 social-links">
                <a href=""><i class="fab fa-facebook-square"></i> </a>
                <a href=""><i class="fab fa-linkedin"></i> </a>
                <a href=""><i class="fab fa-twitter"></i> </a>
                <a href=""><i class="fab fa-google-plus"></i> </a>
                <a href=""><i class="fab fa-github"></i> </a>
            </div>
            <div class="col-sm-4 d-flex flex-column justify-content-center log-in">

                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                    data-target="#myModal">
                    Sign in
                </button>

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-info text-white">
                                <h4 class="modal-title">Sign in</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Enter email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input type="password" class="form-control" id="pwd"
                                            placeholder="Enter password" name="pswd">
                                    </div>
                                    <div class="form-group form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer bg-info p-1">
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
