<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Pondok KangNaryo')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Kang Naryo Logo" style="height: 50px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" style="color: black !important;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('menu.page')  }}" style="color: black !important;">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery.page') }}" style="color: black !important;">Galeri</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>


    <footer id="footer" class="footer bg-dark text-light mt-auto py-5">
        <div class="container">
            <div class="row gy-4">

                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logoputih.png') }}" alt="Kang Naryo Logo" style="height: 40px; margin-right: 10px;">
                        <span class="fs-4 text-white">Pondok KangNaryo</span>
                    </a>
                    <p>Destinasi andalan Anda untuk menikmati sajian kuliner favorit yang lezat, beragam, dan ramah di kantong.</p>
                   <div class="social-links d-flex mt-4">
                        <a href="https://wa.me/6281327383242" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4 class="footer-heading">Tautan</h4>
                    <ul>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('menu.page') }}">Menu</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('gallery.page') }}">Galeri</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-12 footer-contact text-center text-md-start">
                    <h4 class="footer-heading">Hubungi Kami</h4>
                    <p>
                        Jl. Dongkelan No.1287, Krapyak Kulon<br>
                        Panggungharjo, Sewon, Bantul<br>
                        Daerah Istimewa Yogyakarta 55188 <br><br>
                        <strong>Telepon:</strong> +62 813-2738-3242<br>
                        <strong>Email:</strong> info@kangnaryo.com<br>
                    </p>
                </div>

            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright text-center">
                &copy; Copyright <strong><span>Pondok Makan KangNaryo</span></strong>. All Rights Reserved
            </div>
            <div class="credits text-center small text-white-50">
                Designed by Mahasiswa Informatika
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
    </body>
</html>
