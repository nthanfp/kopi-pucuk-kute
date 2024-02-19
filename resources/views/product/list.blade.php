@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <img src="{{ $product->image_url }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong class="text-warning">Harga: Rp
                                {{ number_format($product->min_price, 0, ',', '.') }}</strong></p>
                        <a href="{{ route('product.show', ['id' => $product->id_product]) }}" class="btn btn-warning">
                            <i class="fas fa-info-circle"></i> Detail Produk
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
