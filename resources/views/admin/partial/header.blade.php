 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
    <img src="{{ asset('assets/user/img/core-img/favicon.png') }}" style="width:40px;" alt="" srcset="">
    </div>
    <div class="sidebar-brand-text mx-3">UhamkaPress.</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>


 <!-- Divider -->
 <hr class="sidebar-divider">

 <!-- Heading -->
 <div class="sidebar-heading">
     Admin
 </div>

 <!-- Nav Item - Pages Collapse Menu -->
 <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Admin</span>
    </a>
</li>


   

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Barang
</div>

<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.kategori.index') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>Kategori</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.buku') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>Buku</span>
    </a>
</li>


  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.penjualan') }}">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>Penjualan</span></a>
</li>



<!-- Divider -->
<hr class="sidebar-divider">



</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

       

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

           


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admin')->user()->name }}</span>
                    <img class="img-profile rounded-circle"
                        src="{{ asset('assets/undraw_profile.svg') }}">
                </a>
               <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <!-- Logout Form -->
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </form>
                </div>

            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->