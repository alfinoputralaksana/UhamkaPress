<!-- resources/views/admin/penjualan.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UhamkaPress</title>

    <link rel="icon" href="{{ asset('assets/user/img/core-img/favicon.png') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @section('header')
            @include('admin.partial.header')
        @show

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Penjualan</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Judul Buku</th>
                                    <th>Total Pembelian</th>
                                    <th>Total Harga</th>
                                    <th>Nama</th>
                                    <th>No Telpon</th>
                                    <th>Alamat</th>
                                    <th>Nama Bank</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $index => $purchase)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $purchase->book_name}}</td> <!-- Menggunakan ?? untuk mencegah error jika relasi tidak ada -->
                                        <td>{{ $purchase->quantity }}</td>
                                        <td>{{ $purchase->total_price }}</td>
                                        <td>{{ $purchase->full_name }}</td>
                                        <td>{{ $purchase->phone_number }}</td>
                                        <td>{{ $purchase->address }}</td>
                                        <td>{{ $purchase->bank_name }}</td>
                                        <td>
                                            @if($purchase->payment_proof)
                                                <a href="{{ Storage::url($purchase->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a>
                                            @else
                                                <span>Tidak ada bukti pembayaran</span>
                                            @endif
                                        </td>

                                        <td>{{ $purchase->status }}</td>
                                        <td>
                                            <form action="{{ route('admin.purchase.update', $purchase->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-control">
                                                    <option value="belum di proses" {{ $purchase->status == 'belum di proses' ? 'selected' : '' }}>Belum Diproses</option>
                                                    <option value="proses" {{ $purchase->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="sedang dikirim" {{ $purchase->status == 'sedang dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                                    <option value="ditolak" {{ $purchase->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

     
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @section('footer')
            @include('admin.partial.footer')
        @show
        
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/js/demo/chart-pie-demo.js') }}"></script>
</body>

</html>
