<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href={{ url('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ url('dist/css/adminlte.min.css') }}>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');

        * {
            font-family: 'Varela Round', sans-serif;
        }

        th {
            font-weight: 900;
            background: -webkit-linear-gradient(#c69cf4, #9cc2f4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .blinking {
            animation: blink 2s infinite;
        }

        .stylish-text {
            font-weight: 900;
            background: -webkit-linear-gradient(#c69cf4, #9cc2f4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        @keyframes gradient {
            0% {
                background-position: 0 0
            }

            100% {
                background-position: 100% 0
            }
        }

        #webflow-style-input {
            position: relative;
            display: flex;
            flex-direction: row;
            width: 50%;
            border-radius: 2px;
            background: rgba(57, 63, 84, 0.8);

            &:after {
                content: "";
                position: absolute;
                left: 0px;
                right: 0px;
                bottom: 0px;
                z-index: 999;
                height: 2px;
                border-bottom-left-radius: 2px;
                border-bottom-right-radius: 2px;
                background-position: 0% 0%;
                background: linear-gradient(to right, #B294FF, #57E6E6, #FEFFB8, #57E6E6, #B294FF, #57E6E6);
                background-size: 500% auto;
                animation: gradient 3s linear infinite;
            }
        }

        #rollno {
            flex-grow: .5;
            color: #BFD2FF;
            font-size: 1.8rem;
            line-height: 2.4rem;
            vertical-align: middle;

            &::-webkit-input-placeholder {
                color: #7881A1;
            }
        }
    </style>
</head>

<body
    class="hold-transition dark-mode sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src={{ url('dist/img/Logo.jpg') }} alt="AdminLTELogo" height="100"
                width="100" style="border-radius: 20%;">
        </div>

        @include('admin.header')

        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 80px">
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        @include('admin.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src={{ url('plugins/jquery/jquery.min.js') }}></script>
    <!-- Bootstrap -->
    <script src={{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- overlayScrollbars -->
    <script src={{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ url('dist/js/adminlte.js') }}></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src={{ url('plugins/jquery-mousewheel/jquery.mousewheel.js') }}></script>
    <script src={{ url('plugins/raphael/raphael.min.js') }}></script>
    <script src={{ url('plugins/jquery-mapael/jquery.mapael.min.js') }}></script>
    <script src={{ url('plugins/jquery-mapael/maps/usa_states.min.js') }}></script>
    <!-- ChartJS -->
    <script src={{ url('plugins/chart.js/Chart.min.js') }}></script>

    <!-- AdminLTE for demo purposes -->
    <script src={{ url('dist/js/demo.js') }}></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src={{ url('dist/js/pages/dashboard2.js') }}></script>

    <script>
        const navLinks = document.querySelectorAll('.nav-link'); // Select all tab links

        // Add click event listener to each tab link
        navLinks.forEach((link, index) => {
            link.addEventListener('click', function() {
                // Remove 'active' class from all links
                navLinks.forEach(navLink => {
                    navLink.classList.remove('active');
                });

                // Add 'active' class to the clicked link
                this.classList.add('active');

                // Store the index of the active tab in localStorage
                localStorage.setItem('activeTabIndex', index);
            });
        });

        // Retrieve and apply active tab on page load
        const activeTabIndex = localStorage.getItem('activeTabIndex');
        if (activeTabIndex !== null) {
            navLinks[activeTabIndex].classList.add('active');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('rollno').focus();
        });
    </script>

</body>

</html>
