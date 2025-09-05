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

    <!-- Custom fonts for this template -->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">

    <style>
        .card {
    margin-bottom: 20px;
    display: flex;
    flex-direction: row;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card-body {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 20px;
    width: 100%;
}

.card img {
    width: 150px;
    height: 190px;
    object-fit: cover;
    margin-right: 20px;
    border-radius: 8px;
}

.card-body .info {
    flex: 1;
}

.card-body .info p {
    margin: 5px 0;
    font-size: 16px;
}

.card-body .info strong {
    font-weight: bold;
    color: #333;
}

.card-body .action {
    margin-top: auto;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.card-body .action button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.card-body .action button:hover {
    background-color: #218838;
}

.container {
    padding: 30px;
}

h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 30px;
    color: #333;
    text-align: center;
}

.text-center {
    text-align: center;
}

    </style>
</head>


<body>
    @section('header')
        @include('user.partial.header')
    @show

    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Pesanan Anda</h2>

        <!-- Cek jika ada pesanan -->
        @if($pesanan->isEmpty())
            <p class="text-center">Anda belum memiliki pesanan.</p>
        @else
            <div class="row">
                @foreach($pesanan as $key => $order)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                               
                                @if ($order->book)
                                    <img src="{{ asset('storage/' . $order->book->image) }}" alt="{{ $order->book->judul }}">
                                @else
                                    <!-- Tampilkan gambar default atau informasi lain ketika tidak ada relasi book -->
                                    <img src="{{ asset('assets/user/img/core-img/buku.png') }}" alt="No Image Available">
                                @endif

                                <div class="info">
                                    <p><strong>Nama Buku:</strong> {{ $order->book_name }}</p>
                                    <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                                    <p><strong>Total Harga:</strong> {{ $order->total_price}}</p>
                                    <p><strong>Bukti Pembayaran:</strong>
                                        @if($order->payment_proof)
                                            <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" style="color:blue;">Lihat Bukti Pembayaran</a>
                                        @else
                                            <span>Tidak ada bukti pembayaran</span>
                                        @endif
                                    </p>
                                    <p><strong>Status:</strong> {{ $order->status }}</p>
                                    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="action">
                                    <form action="{{ route('pesanan.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-block">Tandai Diterima</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br>

    @section('footer')
        @include('user.partial.footer')
    @show

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
