@extends('layouts.app')

@section('content')
    <div class="my-2">
        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/kpk (1).jpg') }}" alt="Los Angeles" class="d-block rounded-3"
                        style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/kpk (2).jpg') }}" alt="Chicago" class="d-block rounded-3"
                        style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/kpk (3).jpg') }}" alt="New York" class="d-block rounded-3"
                        style="width:100%">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    <div class="mt-2 mb-3">
        <div class="jumbotron">
            {{-- <h3 class="display-4">Selamat Datang di {{ $webProfile->title }}</h3> --}}
            <p class="lead">{{ $webProfile->description }}</p>
            <p class="lead">Kami menyajikan berbagai macam jenis kopi dari berbagai daerah yang diproses dengan teknik
                yang canggih untuk
                memberikan rasa dan aroma yang khas.</p>
            <a class="btn btn-warning btn-lg" href="{{ route('product.list') }}" role="button">Eksplor Produk</a>
        </div>
    </div>
    <div class="py-5">
        <hr>
        <h4 class="display-6 mb-4 text-center">Keunggulan Proses</h4>
        <div class="row g-4 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="feature-icon bg-warning bg-gradient">
                    <i class="fas fa-leaf"></i>
                </div>
                <h2>Pemetikan</h2>
                <p>Pemetikan dilakukan dengan sistem petik dan sortasi buah untuk memilih biji berkualitas.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-warning bg-gradient">
                    <i class="fas fa-users"></i>
                </div>
                <h2>Sortase Manual</h2>
                <p>Sortasi manual bertujuan memisahkan biji cacat dan membedakan jenis biji long berry dengan pea berry.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-warning bg-gradient">
                    <i class="fas fa-water"></i>
                </div>
                <h2>Pencucian</h2>
                <p>Pencucian dilakukan untuk menghilangkan lendir hasil fermentasi dan mengurangi kadar air biji kopi.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-warning bg-gradient">
                    <i class="fas fa-seedling"></i>
                </div>
                <h2>Pengupasan</h2>
                <p>Pengupasan kulit biji kopi bertujuan memisahkan biji dengan kulit tanduk menggunakan alat pengupas.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-warning bg-gradient">
                    <i class="fas fa-seedling"></i>
                </div>
                <h2>Sortase Biji</h2>
                <p>Sortase biji kopi dilakukan untuk memisahkan biji berkualitas sesuai dengan kelas masing-masing.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-warning bg-gradient">
                    <i class="fas fa-box"></i>
                </div>
                <h2>Packaging</h2>
                <p>Pengemasan bertujuan mempertahankan aroma dan kualitas kopi selama disimpan dan dikirim.</p>
            </div>
        </div>
    </div>
@endsection
