<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Load Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Load Vite assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/simplex-bootstrap.min.css'])
</head>

<body style="background-color: #f8f7f7">
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning" style="border-style: none;">
        <div class="container-fluid container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('product') ? 'active' : '' }}"
                            href="{{ route('product.list') }}"><i class="fas fa-box"></i> Produk</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    {{--  --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('account/login') ? 'active' : '' }}"
                                href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('account/register') ? 'active' : '' }}"
                                href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Daftar
                            </a>
                        </li>
                    @else
                        @if (Auth::user()->role === 'admin')
                            {{-- Tampilkan menu dropdown untuk admin --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownAdmin" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Admin <i class="fas fa-cogs"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                                    <a class="dropdown-item" href="#">Dashboard Admin</a>
                                    <a class="dropdown-item" href="{{ route('admin.products.index') }}">Kelola Produk</a>
                                    <a class="dropdown-item" href="#">Kelola Pengguna</a>
                                    <a class="dropdown-item" href="{{ route('admin.web-profile') }}">Kelola Profil Perusahaan</a>
                                    {{-- Tambahkan item dropdown lainnya sesuai kebutuhan --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Pengaturan</a>
                                </div>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profil</a>
                                <a class="dropdown-item" href="#">Ganti Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>


    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>
