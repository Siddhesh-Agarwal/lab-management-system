<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href={{ url('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ url('dist/css/adminlte.min.css') }}>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .blinking {
            animation: blink 2s infinite;
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
    </style>

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src={{ url('dist/img/Logo.jpg') }} alt="AdminLTELogo" height="100"
                width="100" style="border-radius: 20%;">
        </div>

        @include('admin.header')

        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 100px">
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
