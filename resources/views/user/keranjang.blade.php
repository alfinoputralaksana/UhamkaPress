<!-- resources/views/keranjang.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UhamkaPress</title>
    <link rel="icon" href="{{ asset('assets/user/img/core-img/favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/user/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .card {
            display: flex;
            flex-direction: row;
            align-items: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .card-body {
            flex: 1;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .btn {
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .modal-content {
            border-radius: 10px;
        }

        .form-control {
            border-radius: 5px;
        }

        .text-right h4 {
            font-weight: 600;
        }
    </style>
</head>

<body>
    @section('header')
        @include('user.partial.header')
    @show

    <div class="container mt-5">
        <h2 class="text-center mb-4">Keranjang Belanja</h2>

        @if ($cartItems->isNotEmpty())
            <div class="row">
                @foreach ($cartItems as $item)
                    <div class="col-12 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $item->book->image) }}" class="card-img-left"
                                alt="{{ $item->book->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->book->judul }}</h5>
                                <p class="card-text">
                                    <strong>Harga:</strong> Rp. {{ number_format($item->book->harga, 0, ',', '.') }}
                                    <br>
                                    <strong>Jumlah:</strong> {{ $item->quantity }} <br>
                                    <strong>Total:</strong>
                                    Rp. {{ number_format($item->book->harga * $item->quantity, 0, ',', '.') }}
                                </p>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <!-- Tombol Bayar Sekarang untuk item individual -->
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#buyNowModal"
                                    onclick="setPurchaseModalData('{{ $item->book->judul }}', '{{ $item->book->harga * $item->quantity }}', 'single', '{{ $item->quantity }}', '{{ $item->id }}')">
                                    Bayar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-right">
                <h4>Total Belanja: Rp.
                    {{ number_format($cartItems->sum(function ($item) {
                        return $item->book->harga * $item->quantity;
                    }), 0, ',', '.') }}
                </h4>
                <!-- Tombol Bayar Semua untuk seluruh keranjang -->
                <button class="btn btn-success" data-toggle="modal" data-target="#buyNowModal"
                    onclick="setPurchaseModalData('Total Belanja', '{{ $cartItems->sum(function ($item) { return $item->book->harga * $item->quantity; }) }}', 'all')">
                    Bayar Semua
                </button>
            </div>
        @else
            <p class="text-center">Keranjang belanja Anda kosong.</p>
        @endif
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    @section('footer')
        @include('user.partial.footer')
    @show

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="buyNowModal" tabindex="-1" role="dialog" aria-labelledby="buyNowModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Judul modal akan diubah sesuai tipe pembelian -->
                    <h5 class="modal-title" id="buyNowModalLabel">Beli Sekarang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="purchaseForm" method="POST" action="{{ route('purchase.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Meskipun user_id bisa diambil dari Auth di controller, kita sertakan di sini bila diperlukan -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <!-- Input untuk membedakan tipe pembelian: single atau all -->
                        <input type="hidden" name="purchase_type" id="purchaseType" value="">
                        <!-- Hidden input untuk quantity (berlaku untuk pembelian single) -->
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <!-- Hidden input untuk menyimpan cart item id (hanya untuk tipe single) -->
                        <input type="hidden" name="cart_item_id" id="cartItemId" value="">

                        <div class="form-group">
                            <label for="bookName">Nama Buku:</label>
                            <input type="text" id="bookName" name="book_name" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="totalPrice">Total Harga:</label>
                            <input type="text" id="totalPrice" name="total_price" class="form-control" readonly>
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
                    <button type="button" class="btn btn-primary" onclick="submitPurchase()">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /**
         * Mengatur data modal pembelian.
         *
         * @param {string} bookName - Nama buku (untuk pembelian single) atau label (misalnya "Total Belanja" untuk semua item).
         * @param {number|string} totalPrice - Total harga yang dihitung.
         * @param {string} purchaseType - Tipe pembelian: 'single' atau 'all'.
         * @param {number|string} [quantity=1] - Jumlah item (hanya berlaku untuk pembelian single).
         * @param {number|string} [cartId] - ID item di keranjang (hanya untuk pembelian single).
         */
        function setPurchaseModalData(bookName, totalPrice, purchaseType, quantity = 1, cartId = '') {
            document.getElementById('bookName').value = bookName;
            document.getElementById('totalPrice').value = `Rp. ${new Intl.NumberFormat('id-ID').format(totalPrice)}`;
            document.getElementById('purchaseType').value = purchaseType;
            if (purchaseType === 'single') {
                document.getElementById('quantity').value = quantity;
                document.getElementById('cartItemId').value = cartId;
                document.getElementById('buyNowModalLabel').innerText = 'Beli Sekarang';
            } else {
                // Untuk tipe "all", quantity dan cart_item_id tidak diperlukan
                document.getElementById('buyNowModalLabel').innerText = 'Bayar Semua';
                document.getElementById('cartItemId').value = '';
            }
        }

        function submitPurchase() {
            // Tampilkan pop up konfirmasi sebelum form disubmit (opsional)
            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: "Apakah Anda yakin untuk melanjutkan pembayaran?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Setelah konfirmasi, submit form
                    document.getElementById('purchaseForm').submit();
                }
            });
        }
    </script>

    <!-- jQuery dan JS lainnya -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>
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

    <!-- Tampilkan pop up notifikasi jika ada session success -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Pembayaran Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif
</body>

</html>
