<!-- resources/views/user/detail_buku.blade.php -->
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SweetAlert2 CSS (opsional, SweetAlert2 sudah mengurus style secara internal) -->
    <!-- Bisa juga menggunakan CDN JS langsung seperti di bawah -->
</head>

<body>
    <!-- Header -->
    @section('header')
        @include('user.partial.header')
    @show

    <!-- Single Product Details Area -->
    <section class="single_product_details_area d-flex align-items-center">
        <!-- Product Image -->
        <div class="single_product_thumb clearfix">
            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
        </div>

        <!-- Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{ $book->pengarang }}</span>
            <h2>{{ $book->judul }}</h2>
            <p class="product-price">Rp. {{ number_format($book->harga) }}</p>
            <p class="product-desc">{{ $book->deskripsi }}</p>

            <!-- Quantity Selector -->
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                    </div>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                    </div>
                </div>
            </div>

            <!-- Purchase Buttons -->
            <div class="button-container">
                <!-- Tombol Beli Sekarang memunculkan modal -->
                <button type="button" class="btn essence-btn" data-toggle="modal" data-target="#buyNowModal">Beli
                    Sekarang</button>

                <!-- Form Tambahkan ke Keranjang menggunakan AJAX -->
                <form action="{{ route('cart.store') }}" method="POST" class="mt-0 cart-form">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" id="cartQuantity" value="1">
                    <button type="submit" class="btn keranjang-btn">Tambahkan ke Keranjang</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Purchase Modal -->
    <div class="modal fade" id="buyNowModal" tabindex="-1" role="dialog" aria-labelledby="buyNowModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyNowModalLabel">Beli Sekarang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="purchaseForm" method="POST" action="{{ route('pembelian.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="quantity" id="modalQuantity" value="1">

                        <div class="form-group">
                            <label for="bookName">Nama Buku:</label>
                            <input type="text" id="bookName" name="book_name" class="form-control"
                                value="{{ $book->judul }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="totalPrice">Total Harga:</label>
                            <input type="text" id="totalPrice" name="total_price" class="form-control"
                                value="Rp. {{ number_format($book->harga) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap:</label>
                            <input type="text" id="nama" name="full_name" class="form-control"
                                placeholder="Masukkan Nama Lengkap" required>
                        </div>

                        <div class="form-group">
                            <label for="notlp">No Telpon:</label>
                            <input type="number" id="notlp" name="phone_number" class="form-control"
                                placeholder="Masukkan No Telpon" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat Pengiriman:</label>
                            <textarea id="address" name="address" class="form-control" rows="3"
                                placeholder="Masukkan alamat pengiriman" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="bankName">Nama Bank:</label>
                            <input type="text" id="bankName" name="bank_name" class="form-control"
                                placeholder="Masukkan nama bank" required>
                        </div>

                        <div class="form-group">
                            <label for="paymentProof">Upload Bukti Transfer:</label>
                            <p>Bank BCA <br> No. Rekening : 2950602379 <br> a.n. Mahfudin </p>
                            <input type="file" id="paymentProof" name="payment_proof" class="form-control-file" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <!-- Tombol submit pembelian via AJAX -->
                    <button type="button" class="btn btn-primary" onclick="submitPurchase()">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @section('footer')
        @include('user.partial.footer')
    @show

    <!-- jQuery, Popper, Bootstrap dan Plugin JS -->
    <script src="{{ asset('assets/user/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/user/js/classy-nav.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/active.js') }}"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Script untuk Quantity, AJAX Pembelian & Cart -->
    <script>
        let unitPrice = {{ $book->harga }};

        function increaseQuantity() {
            let quantity = parseInt(document.getElementById('quantity').value);
            let newQuantity = quantity + 1;
            document.getElementById('quantity').value = newQuantity;
            document.getElementById('cartQuantity').value = newQuantity;
            document.getElementById('modalQuantity').value = newQuantity;
            updateTotalPrice();
        }

        function decreaseQuantity() {
            let quantity = parseInt(document.getElementById('quantity').value);
            if (quantity > 1) {
                let newQuantity = quantity - 1;
                document.getElementById('quantity').value = newQuantity;
                document.getElementById('cartQuantity').value = newQuantity;
                document.getElementById('modalQuantity').value = newQuantity;
                updateTotalPrice();
            }
        }

        function updateTotalPrice() {
            let quantity = parseInt(document.getElementById('quantity').value);
            let totalPrice = quantity * unitPrice;
            document.getElementById('totalPrice').value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        }

        function submitPurchase() {
            let form = document.getElementById('purchaseForm');
            let formData = new FormData(form);

            fetch("{{ route('pembelian.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tutup modal pembelian
                        $('#buyNowModal').modal('hide');
                        // Tampilkan SweetAlert pop up sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembelian Berhasil',
                            text: 'Terima kasih telah melakukan pembelian. Kami akan segera memproses pesanan Anda.',
                        }).then(() => {
                            // Opsional: Reload halaman untuk memperbarui tampilan
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembelian Gagal',
                            text: 'Pembelian gagal. Silakan coba lagi.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                });
        }

        // AJAX untuk form Tambahkan ke Keranjang
        $(document).ready(function() {
            $('.cart-form').on('submit', function(e) {
                e.preventDefault(); // Cegah submit form default
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Buku berhasil ditambahkan ke keranjang.'
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal menambahkan ke keranjang. Silakan coba lagi.'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>