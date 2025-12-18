<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MagangNews - Portal Informasi Terkini</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            transition: all 0.3s;
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            color: #4e73df;
        }

        .nav-link {
            font-weight: 500;
            color: #555 !important;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #4e73df !important;
        }

        .btn-login {
            background-color: #4e73df;
            color: white !important;
            border-radius: 20px;
            padding: 8px 25px !important;
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
        }

        .btn-login:hover {
            background-color: #224abe;
            transform: translateY(-2px);
        }

        /* Footer Styling */
        footer {
            background: #1a1e21;
            color: #adb5bd;
            padding: 60px 0 30px;
        }

        .footer-logo {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: block;
        }

        .footer-link {
            color: #adb5bd;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-link:hover {
            color: white;
            padding-left: 5px;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            background: #4e73df;
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-newspaper me-2 text-primary"></i>MAGANG<span>NEWS</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'text-primary' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm animate__animated animate__fadeInUp" aria-labelledby="navbarDropdown">
                            @forelse($global_kategori as $kat)
                            <li>
                                <a class="dropdown-item" href="{{ url('/kategori/'.$kat->id) }}">
                                    {{ $kat->nama_kategori }}
                                </a>
                            </li>
                            @empty
                            <li><a class="dropdown-item disabled" href="#">Belum ada kategori</a></li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn-login text-white" href="{{ url('/login') }}">
                            <i class="fas fa-user-circle me-1"></i> Login Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <a class="footer-logo" href="#">MAGANG<span>NEWS</span></a>
                    <p>Portal berita terpercaya yang menyajikan informasi terkini seputar dunia magang, teknologi, dan pengembangan karir untuk mahasiswa dan profesional muda.</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h5 class="text-white fw-bold mb-4">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Kategori</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Berita Populer</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h5 class="text-white fw-bold mb-4">Bantuan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Kontak Kami</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="text-white fw-bold mb-4">Newsletter</h5>
                    <p class="small">Dapatkan update berita harian langsung ke email Anda.</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email Anda">
                        <button class="btn btn-primary" type="button">Kirim</button>
                    </div>
                </div>
            </div>
            <hr class="my-5 opacity-25">
            <div class="text-center">
                <p class="small mb-0">&copy; 2025 MagangNews - Latihan Laravel Magang. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>