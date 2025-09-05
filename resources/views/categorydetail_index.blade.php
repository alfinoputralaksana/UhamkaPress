<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title  -->
    <title>UhamkaPress</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/user/img/core-img/favicon.png') }}">
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">

    <style>
        /* Style for card layout */
        .product-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-img img {
            width: 100%;
            height: auto;
        }

        .product-card-body {
            padding: 15px;
            text-align: center;
        }

        .product-card-body span {
            display: block;
            font-size: 14px;
            color: gray;
            text-align: left;
        }

        .product-card-body h6 {
            color: #333;
    font-size: 16px;
    margin-top: 5px;
    text-align: left;
        }

        .product-card-body .product-price {
            font-size: 16px;
            text-align: left;
            color:rgb(0, 0, 0);
            font-weight: bold;
        }

        .product-card-body .add-to-cart-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .product-card-body .add-to-cart-btn a:hover {
            background-color: #0056b3;
        }

        /* Sidebar Styling */
        .shop_sidebar_area {
            border-right: 1px solid #ddd;
            padding-right: 20px;
        }

        .widget-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .catagories-menu ul li {
            list-style: none;
            margin-bottom: 10px;
        }

        .catagories-menu ul li a {
            color: gray;
            text-decoration: none;
            font-size: 14px;
        }

        .catagories-menu ul li a:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    @section('header')
        @include('partial.header')
    @show

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('assets/user/img/bg-img/breadcumb.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{ $category->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">
                        <div class="widget catagory mb-50">
                            <h6 class="widget-title">Buku</h6>
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                    <div class="product-card">
                                        <div class="product-img">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->judul }}">
                                        </div>
                                        <div class="product-card-body">
                                            <span>{{ $product->pengarang }}</span>
                                            <a href="{{ route('book.detail', $product->id) }}">
                                                <h6>{{ $product->judul }}</h6>
                                            </a>
                                            <p class="product-price">Rp.{{ number_format($product->harga, 0, ',', '.') }}</p>
                                            <div class="add-to-cart-btn">
                                                <a href="{{ route('book.detail', $product->id) }}">Lihat Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    @section('footer')
        @include('partial.footer')
    @show

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('assets/user/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/user/js/classy-nav.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/active.js') }}"></script>
</body>

</html>
