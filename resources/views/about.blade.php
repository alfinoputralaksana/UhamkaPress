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
    
    <!-- ##### Blog Wrapper Area Start ##### -->
    <div class="single-blog-wrapper">

        <!-- Single Blog Post Thumb -->
        <div class="single-blog-post-thumb">
            <img src="{{ asset('assets/user/img/bg.png') }}" style="width:100%;" alt="">
        </div>

        <!-- Single Blog Content Wrap -->
        <div class="single-blog-content-wrapper d-flex">

            <!-- Blog Content -->
            <div class="single-blog--text">
                <h2>TENTANG UHAMKA PRESS</h2>
                <p>UHAMKA PRESS merupakan Unit Pelaksana Teknis (UPT) Penerbitan dan Percetakan yang bernaung di bawah Universitas Muhammadiyah Prof. DR. HAMKA (UHAMKA), Jakarta. Melalui karya tulis, UHAMKA PRESS berusaha maksimal untuk mendokumentasikan dan mempublikasikan karya tulis guna mendukung eksistensi dan perkembangan UHAMKA sebagai salah satu pilar peradaban, serta berkontribusi bagi pengembangan ilmu pengetahuan secara luas.</p>

                <h2>Visi & Misi UHAMKA PRESS</h2>
                <p>Visi:
                    Menjadi lembaga penerbitan yang mandiri dan profesional dalam rangka mendorong terwujudnya budaya literasi di tengah masyarakat.</p>
                    <p>Misi
                        Menumbuhkan kegemaran dan kebiasaan membaca, menulis dan berkarya.
                        Menyelenggarakan pelatihan, seminar, dan bedah buku.
                        Membentuk komunitas penulis.Menjalin kerjasama dengan pihak-pihak terkait.</p>
            </div>

            

        </div>
    </div>
    <!-- ##### Blog Wrapper Area End ##### -->

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
