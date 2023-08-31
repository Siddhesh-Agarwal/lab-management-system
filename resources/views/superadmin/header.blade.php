 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href={{ route('superadmin.dashboard') }} class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href={{ route('superadmin.contact') }} class="nav-link">Contact</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href={{ route('superadmin.logout') }} class="nav-link"
                 onclick="return confirm('Are you sure want to log out ?');">Logout</a>
         </li>
     </ul>
     <div style="display: flex; justify-content:flex-end; width:100%; align-items:baseline">
         <ol class="breadcrumb">
             <li class="breadcrumb-item">
                 <a href="#">ALL</a>
             </li>
             <li class="breadcrumb-item" style="color:black">Super Admin</li>
         </ol>
     </div>
 </nav>
 <!-- /.navbar -->
