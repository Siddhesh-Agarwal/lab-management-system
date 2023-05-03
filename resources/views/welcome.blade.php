<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SKCET</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ url('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ url('dist/css/adminlte.min.css') }}>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alkatra&display=swap');
        body {
            /* background-image: url('dist/img/lab-home1.jpg'); */
            /* background-size: cover; */
            background-color: #111010
        }

        .banner {
            height: 100vh;
            width: 100%;
            background-image: url('dist/img/lab-home1.jpg');
            background-position: top;
            background-size: cover;
            background-repeat: no-repeat;

            &:before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-image: linear-gradient(to bottom right, #002f4b, #424040);
                opacity: .8;
            }
        }

        .banner .navbar {
            margin-top: 2%;
        }

        .banner .navbar-brand {
            color: #fff;
            font-size: 1.8em;
            font-weight: 700;
            margin-left: 10%;
        }

        .banner .nav {
            margin-right: 10%;
        }

        .banner .nav li a {
            color: #fff;
            font-size: 1.2em;
        }

        .banner .info {
            margin-top: 12%;
            transform: translateY(-15%);
        }

        .banner .info h1 {
            font-size: 2.5em;
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
            font-family: 'Bruno Ace SC', cursive;
        }

        .banner .info p {
            font-size: 2em;
            font-family: 'Alkatra', cursive;
            font-weight: 500;
            color: #918d8d;
            letter-spacing: 2px;
        }

        .banner .info a {
            margin-left: 50%;
            transform: translateX(-50%);
            background-color: #F5A518;
            padding: 10px 20px;
            font-size: 1.6em;
            font-weight: 600px;
        }

        .banner .info a:hover {
            background-color: #F59923;
        }

        .banner .info .animated-text {
            background-image: -webkit-linear-gradient(rgb(4, 139, 197) 50%, #ffd800 50%);
            background-size: 100% 50px;
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-animation: stripes 3s ease-in-out infinite;
            animation: stripes 3s ease-in-out infinite;
            font-size: 100px;

        }

        @-webkit-keyframes stripes {
            100% {
                background-position: 0 50px;
            }
        }

        @keyframes stripes {
            100% {
                background-position: 0 50px;
            }
        }

        .login-banner {
            height: 100vh;
            width: 100%;
            background-image: url('dist/img/stud-login1.jpg');
            background-position: top;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body>
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar">
                    <div class="navbar-brand">
                        SKCET
                    </div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8 offset-md-2 info">
                <h1 class="text-center animated-text">SKCET LAB</h1>
                <p class="text-center">
                    Think placement... Think SKCET !!
                </p>
                <a href="#" class="btn btn primary">GET STARTED</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row align-items-start text-center">
            <div class="col-md-6">
                <h1>hel</h1>
            </div>
            <div class="col-md-4">
                <h1>hel</h1>
            </div>
            <div class="col-md-2">
                <h1>hel</h1>
            </div>
        </div>
    </div>

    {{--
        <div class="container-lg container-fluid bg-red">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card" style="390px">
                        <div class="card-header">
                            <h3 class="card-title">Carousel</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"
                                            src="https://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap"
                                            alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="https://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap"
                                            alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="https://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap"
                                            alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row --> --}}



    <!-- jQuery -->
    <script src={{ url('plugins/jquery/jquery.min.js') }}></script>
    <!-- Bootstrap 4 -->
    <script src={{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ url('dist/js/adminlte.min.js') }}></script>
</body>

</html>
