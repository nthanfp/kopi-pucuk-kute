<!-- produk/detail.blade.php -->
@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
            <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->image_url }}" class="img-fluid rounded-2" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p style="text-align: justify">{{ $product->description }}</p>
                <p><strong class="text-warning">Harga: Rp
                        {{ Number::format($product->variants->min('price'), locale: 'id') }} - Rp
                        {{ Number::format($product->variants->max('price'), locale: 'id') }}</strong></p>

                <!-- Pilihan variant -->
                <div class="mb-3">
                    <label for="variant" class="form-label">Pilih variasi produk:</label>
                    <select class="form-select" id="variant">
                        @foreach ($product->variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->name }} - Rp
                                {{ Number::format($variant->price, locale: 'id') }} - Stok: {{ $variant->stock }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                        <div class="mb-3 d-flex justify-content-center align-items-center ">
                            <button type="button" class="btn btn-primary text-white btn-outline-secondary"
                                onclick="decreaseQuantity()">-</button>
                            <input type="number" class="form-control mx-2" id="quantity" value="1">
                            <button type="button" class="btn btn-warning text-white btn-outline-secondary"
                                onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <button type="button" class="btn btn-warning btn-block">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var newValue = parseInt(quantityInput.value) - 1;
            quantityInput.value = newValue > 0 ? newValue : 1;
        }
    </script>
@endsection
