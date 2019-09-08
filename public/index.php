<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Favicon -->
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon" />
        <!-- Font awesome kit-->
        <script src="https://kit.fontawesome.com/1b551efcfa.js"></script>
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">

        <meta name="theme-color" content="#fafafa">

        <style>
            .dropbtn {
                background-color: #343A40;
                color: #999;
                padding: 12px;
                font-size: 14px;
                border: none;
                cursor: pointer;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {
                background-color: #f1f1f1
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropdown:hover .dropbtn {
                background-color: #3e8e41;
            }
        </style>
    </head>

    <body>
        <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

        <!--### Add your site or application conten below ###-->

        <!--  Header background area-->
        <div class="container-fluid  header-background">
            <div class="row bg-dark py-3 mb-3"></div>
            <div class="row">
                <div class="col-sm-2 logo-area text-white">
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a href="#">
                                <img src="img/logo/images21.png" alt="Logo">
                            </a>
                        </li>
                    </ul>
                    <a href="">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam at animi delectus doloribus
                            aperiam eaque quasi quisquam ex molestiae. Ratione!</p>
                    </a>
                </div>
                <div class="col-sm-8 text-white top-navigation mb-2">
                    <ul class="nav justify-content-aropund mb-3">
                        <li class="nav-item">
                            <a href="" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a href="" class="nav-link">About me</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Another</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Another</a>
                        </li>
                    </ul>
                    <div class="blog-heading">
                        <h1>My First Bootstrap 4 Page</h1>
                        <p>Resize this responsive page to see the effect!</p>
                        <p>Working since: 2017 AD</p>
                        <hr class="top-header d-flex justify-content-center">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="top-social-links d-flex justify-content-between mb-2">
                        <a href=""><i class="fab fa-facebook"></i></a>
                        <a href=""><i class="fab fa-linkedin"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-google-plus"></i></a>
                        <a href=""><i class="fab fa-github"></i></a>
                    </div>
                    <div class="important-links text-white">
                        <h5>Important Links :</h5>
                        <p class="info-text"><i class="fas fa-address-card"></i> https://www.nmc.edu.bd</p>
                        <p class="info-text"><i class="fas fa-phone"></i> +88 01712809279</p>
                        <p class="info-text"><i class="fas fa-envelope"></i> paul.bishwajit09@gmail.com</p>

                    </div>

                </div>
            </div>
        </div>
        <!-- ./Header background area-->

        <!-- Nav bar area-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
            <a class="navbar-brand" href="#">Navbar</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Another</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                    <div class="dropdown">
                        <button class="dropbtn">Dropdown <i class="fas fa-sort-down" style="color:#999;"></i></button>
                        <div class="dropdown-content">
                            <a href="#">Link 1</a>
                            <a href="#">Link 2</a>
                            <a href="#">Link 3</a>
                            <a href="#">Link 4</a>
                            <a href="#">Link 5</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">Dropdown <i class="fas fa-sort-down" style="color:#999;"></i></button>
                        <div class="dropdown-content">
                            <a href="#">Link 1</a>
                            <a href="#">Link 2</a>
                            <a href="#">Link 3</a>
                            <a href="#">Link 4</a>
                            <a href="#">Link 5</a>
                        </div>
                    </div>
                </ul>

                ​<form class="search-box">
                    <input type="text" name="search" placeholder="Search..">
                </form>
            </div>
        </nav>
        <!-- ./Nav bar area-->

        <!-- Main content -container- area-->
        <div class="container">
            <div class="row">
                <!-- Left sidebar area-->
                <?php include_once 'partials/_left-sidebar.php';?>
                <!-- ./Left sidebar area-->

                <!-- Middle content area -->
                <div class="col-sm-6 content-area  bg-white pt-3">
                    <div class="top-bar">
                        <h2>Latest blog posts view</h2>
                    </div>
                    <div class="single-post mb-4">
                        <div class="post-details mb-3">
                            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                            <small>Author: Bishwajit Paul</small> ||
                            <small>Published on: 16 June, 2019, 12.00 pm</small> ||
                            <small>Category: </small> <span class="badge badge-secondary"><a href=""> PHP</a>
                            </span>
                        </div>
                        <div class="post-image mb-3">
                            <img src="img/slider_images/banner-img-8.jpg" class="img-fluid rounded" alt="Post Image">
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil perferendis
                            deserunt amet facilis recusandae nisi quasi delectus. Eligendi magni quod doloribus expedita
                            aliquid ab
                            voluptatibus accusamus fugiat ipsum, rem, in, et vero voluptatem iste. Id voluptatibus
                            accusamus fugiat ipsuma ccusamus unde ut omnis voluptatibus accusamus fugiat ipsum...
                        </p>
                        <div class="read-more-button">
                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-book-open"></i> Rear more</a>
                        </div>
                        <hr>
                    </div>
                    <div class="single-post mb-4">
                        <div class="post-details mb-3">
                            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                            <small>Author: Bishwajit Paul</small> ||
                            <small>Published on: 16 June, 2019, 12.00 pm</small> ||
                            <small>Category: </small> <span class="badge badge-secondary"><a href=""> PHP</a>
                            </span>
                        </div>
                        <div class="post-image mb-3">
                            <img src="img/slider_images/banner1.jpg" class="img-fluid rounded" alt="Post Image">
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil perferendis
                            deserunt amet facilis recusandae nisi quasi delectus. Eligendi magni quod doloribus expedita
                            aliquid ab
                            voluptatibus accusamus fugiat ipsum, rem, in, et vero voluptatem iste. Id voluptatibus
                            accusamus fugiat ipsuma ccusamus unde ut omnis voluptatibus accusamus fugiat ipsum...
                        </p>
                        <div class="read-more-button">
                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-book-open"></i> Rear more</a>
                        </div>
                        <!-- <hr class="type_7"> -->
                        <hr>
                    </div>
                    <div class="single-post mb-4">
                        <div class="post-details mb-3">
                            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                            <small>Author: Bishwajit Paul</small> ||
                            <small>Published on: 16 June, 2019, 12.00 pm</small> ||
                            <small>Category: </small> <span class="badge badge-secondary"><a href=""> PHP</a>
                            </span>
                        </div>
                        <div class="post-image mb-3">
                            <img src="img/slider_images/banner2.jpg" class="img-fluid rounded" alt="Post Image">
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil perferendis
                            deserunt amet facilis recusandae nisi quasi delectus. Eligendi magni quod doloribus expedita
                            aliquid ab
                            voluptatibus accusamus fugiat ipsum, rem, in, et vero voluptatem iste. Id voluptatibus
                            accusamus fugiat ipsuma ccusamus unde ut omnis voluptatibus accusamus fugiat ipsum...
                        </p>
                        <div class="read-more-button">
                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-book-open"></i> Rear more</a>
                        </div>
                        <hr>
                    </div>
                    <div class="single-post mb-4">
                        <div class="post-details mb-3">
                            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                            <small>Author: Bishwajit Paul</small> ||
                            <small>Published on: 16 June, 2019, 12.00 pm</small> ||
                            <small>Category: </small> <span class="badge badge-secondary"><a href=""> PHP</a>
                            </span>
                        </div>
                        <div class="post-image mb-3">
                            <img src="img/slider_images/banner3.jpg" class="img-fluid rounded" alt="Post Image">
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil perferendis
                            deserunt amet facilis recusandae nisi quasi delectus. Eligendi magni quod doloribus expedita
                            aliquid ab
                            voluptatibus accusamus fugiat ipsum, rem, in, et vero voluptatem iste. Id voluptatibus
                            accusamus fugiat ipsuma ccusamus unde ut omnis voluptatibus accusamus fugiat ipsum...
                        </p>
                        <div class="read-more-button">
                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-book-open"></i> Rear more</a>
                        </div>
                        <hr>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <hr>
                    <!--./ Pagination -->
                </div><!-- ./Middle content area -->

                <!-- Right sidebar area -->
                <?php include_once 'partials/_right-sidebar.php';?>
                <!-- ./Right sidebar area -->
            </div>
        </div>

        <!--Carousel Wrapper-->
        <div class="container">
            <div class="row">
                <div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2"
                    data-ride="carousel">
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">

                        <!--First slide-->
                        <div class="carousel-item active">

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(38).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(19).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(42).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(8).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                        </div>
                        <!--/.First slide-->

                        <!--Second slide-->
                        <div class="carousel-item">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(53).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(25).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(47).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(26).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                        </div>
                        <!--/.Second slide-->

                        <!--Third slide-->
                        <div class="carousel-item">

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(64).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(51).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(59).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img class="img-fluid"
                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(63).jpg"
                                        alt="Card image cap">
                                </div>
                            </div>

                        </div>
                        <!--/.Third slide-->
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <div class="controls-top d-flex justify-content-center">
                        <a class="black-text" href="#multi-item-example" data-slide="prev"><i
                                class="fas fa-angle-left fa-2x pr-3"></i></a>
                        <a class="black-text" href="#multi-item-example" data-slide="next"><i
                                class="fas fa-angle-right fa-2x pl-3"></i></a>
                    </div>
                    <!--/.Controls-->
                </div>
            </div>
        </div>
        <div class="container-fluid bg-info py-1 photo-gallery text-white d-flex justify-content-center"></div>
        <!--/.Carousel Wrapper-->

        <!-- ./Main content -container- area-->

        <!-- Footer area-->
        <div class="container-fluid top-footer py-2 text-white" style="margin-bottom:0;background:#000;">
            <!-- <div class="container"> -->
            <div class="row">
                <div class="col-sm-4">
                    <h5>Recent posts</h5>
                    <div class="recent-posts">
                        <div class="post-details">
                            <h6></h6>
                            <small>Author: Bishwajit Paul &nbsp;||</small>
                            <small>Publkished on: 20 May 2019 12.00 PM &nbsp;||</small>
                            <small>Category: Php</small>
                        </div>
                        <div class="recent-post-image">
                            <img src="img/slider_images/banner5.jpg"
                                style="width:100px; height:60px;float:left; margin-right:10px;" class="img-fluid"
                                alt="Recent post image">
                        </div>
                        <div class="recent-post-content">
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit totam quibusdam
                                illo.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h5>Social links</h5>
                    <div class="top-social-links d-flex justify-content-between mb-4">
                        <a href=""><i class="fab fa-facebook"></i></a>
                        <a href=""><i class="fab fa-linkedin"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-google-plus"></i></a>
                        <a href=""><i class="fab fa-github"></i></a>
                    </div>
                    <div class="facebook justify-content-around">
                        <a href="">
                            <img src="img/logo/facebookProfile.jpg" class="img-fluid img-thumbnail" alt="Facebook"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h5>Send message to Contact us</h5>
                    <form method="postget" action="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder=" User name...">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
                            </div>
                            <textarea name="" id="name" class="form-control" rows="3"
                                placeholder=" User message..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder=" User email...">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-block btn-secondary" style="">
                                    <i class="fas fa-envelope-square"></i>
                                    Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <!--./ Footer area-->

        <!-- Footer bar -->
        <div class="container-fluid footer-bar bg-dark py-2 text-white d-flex justify-content-center">
            <span>&copy; 2019 All rights reserved to WWW.laraland.com.</span>
        </div><!-- ./Footer bar -->


        <!-- ### Add your site or application conten above ### -->

        <!-- Scripts -->
        <!--Optional JavaScript - jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

        <script src="js/vendor/modernizr-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')
        </script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/scrolltop.js"></script>
        <!-- Sticky nav bar -->
        <script>
            window.onscroll = function() {
                myFunction()
            };

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            function myFunction() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")
                } else {
                    navbar.classList.remove("sticky");
                }
            }
        </script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga = function() {
                ga.q.push(arguments)
            };
            ga.q = [];
            ga.l = +new Date;
            ga('create', 'UA-XXXXX-Y', 'auto');
            ga('set', 'transport', 'beacon');
            ga('send', 'pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async></script>
        <!-- ./Scripts -->
    </body>

</html>