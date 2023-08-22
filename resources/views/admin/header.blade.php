 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href={{ route('admin.dashboard') }} class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href={{ route('admin.contact') }} class="nav-link">Contact</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href={{ route('admin.logout') }} class="nav-link" onclick="return confirm('Are you sure want to log out ?');">Logout</a>
         </li>

         
         
         <!-- /.content-header -->
        </ul>
        <div style="display: flex; justify-content:flex-end; width:100%; align-items:baseline">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">{{ Auth::user()->labname }}</a>
                </li>
                <li class="breadcrumb-item" style="color:black">Admin</li>
            </ol>
        </div>
 </nav>
 <!-- /.navbar -->
