<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar d-flex align-items-center justify-content-between w-100" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="/">
                <img src="{{ asset('assets/user/img/core-img/logo.png') }}" alt="" style="max-height: 50px;">
            </a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu w-100">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav d-flex align-items-center justify-content-between w-100">
                    <ul class="d-flex align-items-center">
                        <li><a href="/home">Home</a></li>
                        <li><a href="#">Buku</a>
                            <ul class="dropdown">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('user.about') }}">About</a></li>
                        <li><a href="{{ route('user.contact') }}">Contact</a></li>
                    </ul>
                    <!-- Search Bar -->
                    <form action="{{ route('books.search') }}" method="GET" class="d-flex ml-3" style="flex: 1; max-width: 400px;">
                        <input 
                            type="text" 
                            name="query" 
                            class="form-control" 
                            placeholder="Cari buku..." 
                            style="width: 100%; border-radius: 20px; padding: 8px;"
                        >
                        <button type="submit" class="btn btn-primary ml-2" style="border-radius: 20px; padding: 8px 15px;">
                            Cari
                        </button>
                    </form>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Dropdown - User Information -->
        <div class="user-info d-flex align-items-center">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" style="width: 40px;" src="{{ asset('assets/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('cart.show') }}">
                    <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keranjang
                </a>
                <a class="dropdown-item" href="{{ route('pesanan.index') }}">
                    <i class="fas fa-list-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pesanan Saya
                </a>
                <a class="dropdown-item" href="{{ route('account.settings') }}">
                    <i class="fas fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengaturan Akun
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </div>
</header>
