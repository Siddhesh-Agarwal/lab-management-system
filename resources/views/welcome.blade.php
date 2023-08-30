<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SKCET</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ url('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ url('dist/css/adminlte.min.css') }}>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alkatra&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Merriweather&display=swap');

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
                opacity: .7;
            }
        }

        .text-center {
            user-select: none;
        }

        .banner .navbar {
            font-family: 'Alkatra', cursive;
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
            text-decoration: none;
            transition: 0.25s ease;
            margin: 10px;
        }

        .banner .info {
            margin-top: 5%;
            transform: translateY(-15%);
        }

        .about-banner h1 {
            font-size: 2.5em;
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
            font-family: 'Bruno Ace SC', cursive;
            font-size: 50px;
            /* margin-top: 250px; */
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
            font-family: 'Alkatra', cursive;
            transform: translateX(-50%);
            /* background-color: #F5A518; */
            padding: 10px 20px;
            font-size: 1.6em;
            font-weight: 600px;
        }

        .banner .info .animated-text {
            background-image: -webkit-linear-gradient(#0098db 50%, #F99C1B 50%);
            background-size: 100% 50px;
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-animation: stripes 3s ease-in-out infinite;
            animation: stripes 3s ease-in-out infinite;
            font-size: 40px;
        }

        .navbar-brand a {
            color: #ffffff;
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

        .about-banner {
            height: 160vh;
            width: 100%;
            background-image: url('dist/img/stud-login1.jpg');
            background-position: top;
            background-size: cover;
            background-repeat: no-repeat;
        }


        /* CSS */

        .button-home {
            appearance: none;
            background-color: transparent;
            border: 2px solid #1A1A1A;
            border-radius: 15px;
            box-sizing: border-box;
            color: #CBCBCB;
            cursor: pointer;
            display: block;
            font-family: Roobert, -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            font-weight: 600;
            line-height: normal;
            min-height: 60px;
            width: 240px;
            margin: 0;
            margin-inline: auto;
            padding: 16px 24px;
            text-align: center;
            text-decoration: none;
            outline: none;
            transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            will-change: transform;
        }

        .button-home:disabled {
            pointer-events: none;
        }

        .button-home:hover {
            color: #f5f5f5;
            background-color: #1A1A1A;
            box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
            transform: translateY(-2px);
        }

        /* styles.css */

        .custom-carousel {
            width: 300px;
            /* Adjust the width as desired */
            margin: 0 auto;
        }

        .carousel-inner {
            border-radius: 0;
            /* Make the carousel square */
        }

        .carousel-inner .carousel-item {
            text-align: center;
            /* Center slide content */
            /* padding: 20px; */
            height: 300px;
            /* Set the slide height */
        }

        .carousel-inner .carousel-item img {
            max-width: 100%;
            max-height: 100%;
            margin: 0 auto;
            /* Center the image */
        }

        .carousel-indicators {
            bottom: -40px;
            /* Adjust the position of the indicators */
        }
    </style>
</head>

<body>
    <div class="container-fluid banner">
        <div class="row">
            {{-- <div class="col-md-12">
                <nav class="navbar">
                    <div class="navbar-brand">
                        <span style="margin-right:20px">
                            <img src="dist/img/landingpage_logo.jpg" height="55px" />
                        </span>
                        <a href="https://www.skcet.ac.in/" target="_blank">
                            SKCET
                        </a>
                    </div>
                </nav>
            </div> --}}
            <div class="col-md-8 offset-md-2 info">
                <h1 class="text-center animated-text">COMPUTER SCIENCE AND ENGINEERING</h1>
            </div>

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
                style="width:500px;display:block; margin:0 auto;">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="dist/img/lab-home1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="dist/img/lab-home1.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="dist/img/lab-home1.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="dist/img/lab-home1.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="dist/img/lab-home1.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="dist/img/lab-home1.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only" style="color:black">Next</span>
                </a>
            </div>

            {{-- <div class="col-md-8 offset-md-2 info">
                <h1 class="text-center animated-text">SKCET LAB</h1>
                <p class="text-center" style="color: #e9e9e9; font-family: 'Merriweather', sans-serif;">
                    Think Placement Think SKCET !
                </p>
                <a href="{{ route('login') }}">
                    <button onclick={{ route('login') }}" class="button-home">GET STARTED</button>
                </a>
            </div> --}}
        </div>
        <a href="{{ route('login') }}">
            <button class="button-home" style="margin-top: 40px;">GET STARTED</button>
        </a>

    </div>

</body>

</html>
