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
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 16px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert-success {
            margin-top: 20px;
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .form-container .form-group input {
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .form-container .form-group input:focus {
            border-color: #007bff;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    @section('header')
        @include('user.partial.header')
    @show

    <div class="container">
        <h2 class="text-center mb-4">Pengaturan Akun</h2>

        <div class="form-container">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('account.updatePassword') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                    @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Password</button>
            </form>
        </div>
    </div>

    <br><br><br>

    <!-- Footer -->
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
