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

<body>
    @section('header')
        @include('partial.header')
    @show
    
    
    <div class="contact-area d-flex align-items-center">

        <div class="map-container" style="margin-left: 10%;">
        <br><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1624904890996!2d106.78542117475067!3d-6.242304893746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1ca76b091dd%3A0x8af42dc035b1ae24!2sUHAMKA%20GANDARIA!5e0!3m2!1sid!2sid!4v1726218313624!5m2!1sid!2sid" width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
        </div>

        <div class="contact-info">
            <h2>Lokasi Kami</h2>

            <div class="contact-address mt-50">
                <p><span>address:</span> Jl. Gandaria IV, Kramat Pela, Kebayoran Baru, Jakarta Selatan, 12130.</p>
                <p><span>telephone:</span> (021) 7398898</p>
                <p><a href="mailto:contact@essence.com">uhamkapress@yahoo.co.id</a></p>
            </div>
        </div>

    </div>
    <br>

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
