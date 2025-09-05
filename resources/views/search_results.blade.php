<!-- user/home.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>UhamkaPress</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/user/img/core-img/favicon.png') }}">
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">

</head>

<style>
    /* Form Pencarian */
.search-box {
    background:rgb(255, 255, 255);
    border-radius: 15px;
    border: 1px solid #ddd;
}



/* Produk */
.single-product-wrapper {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

.single-product-wrapper:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.product-img img {
    width: 100%;
    height: auto;
    transition: all 0.3s ease-in-out;
}

.product-img img:hover {
    transform: scale(1.1);
}

.product-description {
    background: #ffffff;
    padding: 15px;
    text-align: center;
}

.product-description h6 {
    color: #333;
    font-size: 16px;
    margin-top: 10px;
}

.product-price {
    color: #007bff;
    font-weight: bold;
}

/* Tombol */
.btn.essence-btn {
    background: #007bff;
    color: #fff;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn.essence-btn:hover {
    background: #0056b3;
    color: #fff;
}

/* Koleksi Area */
.section-heading h2 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.section-heading p {
    font-size: 14px;
    color: #666;
    margin-top: 10px;
}

</style>

<body>
    @section('header')
        @include('partial.header')
    @show

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url('{{ asset('assets/user/img/bg-img/bg-1.png') }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Add any additional content here -->
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

   

<div class="container mt-5">
    <h2>Hasil Pencarian untuk "{{ $query }}"</h2>

    @if($books->isEmpty())
        <p>Tidak ada buku yang ditemukan.</p>
    @else
    <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    @foreach ($books as $book)
                    <!-- Single Product -->
                    <div class="single-product-wrapper">
                        <div class="product-img">
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                        </div>
                        <div class="product-description text-center">
                            <span>{{ $book->pengarang }}</span>
                            <a href="{{ route('book.detail', $book->id) }}">
                                <h6>{{ $book->judul }}</h6>
                            </a>
                            <p class="product-price">Rp.{{ $book->harga }}</p>
                            <div class="add-to-cart-btn mt-3">
                                <a href="{{ route('book.detail', $book->id) }}" class="btn essence-btn">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>


    <!-- ##### Footer Area Start ##### -->
    @section('footer')
        @include('partial.footer')
    @show

    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('assets/user/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('assets/user/js/plugins.js') }}"></script>
     <!-- Classy Nav js -->
     <script src="{{ asset('assets/user/js/classy-nav.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('assets/user/js/active.js') }}"></script>
</body>

</html>
