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

    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ url('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ url('dist/css/adminlte.min.css') }}>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alkatra&display=swap');

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
            margin-top: 12%;
            transform: translateY(-15%);
        }

        .about-banner h1 {
            font-size: 2.5em;
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
            font-family: 'Bruno Ace SC', cursive;
            font-size: 100px;
            margin-top: 250px;
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
            font-size: 100px;
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
    </style>
</head>

<body>
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-12">
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
            </div>
            <div class="col-md-8 offset-md-2 info">
                <h1 class="text-center animated-text">SKCET LAB</h1>
                <p class="text-center" style="color: #e9e9e9; font-family: 'Varela Round', sans-serif;">
                    Think Placement... Think SKCET !!
                </p>
                <a href="{{ route('login') }}">
                    <button onclick={{ route('login') }}" class="button-home">GET STARTED</button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
