<!-- ##### Header Area Start ##### -->
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="/"><img src="{{ asset('assets/user/img/core-img/logo.png') }}" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="#">Buku</a>
                            <ul class="dropdown">
                                <!-- Loop through categories -->
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('category.showdetail', $category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                    <form action="{{ route('user.search') }}" method="GET" class="d-flex ml-3" style="flex: 1; max-width: 400px;">
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

        <div class="header-buttons">
            <a href="/login" type="button" class="btn btn-outline-dark">Login</a>
            <a href="/register" type="button" class="btn btn-dark" style="color:white">Register</a>
        </div>

    </div>
</header>
<!-- ##### Header Area End ##### -->
