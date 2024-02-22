@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
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
                        <option value="">-- Pilih Varian --</option>
                        @foreach ($product->variants as $variant)
                            <option value="{{ $variant->id_variant }}" data-id_product={{ $variant->id_product }}
                                data-id_variant={{ $variant->id_variant }} data-max="{{ $variant->stock }}">
                                {{ $variant->name }} - Rp
                                {{ Number::format($variant->price, locale: 'id') }} - Stok: {{ $variant->stock }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                        <div class="mb-3 d-flex justify-content-center align-items-center ">
                            <button type="button"
                                class="btn btn-primary text-white btn-outline-secondary decrease-quantity-btn">-</button>
                            <input type="number" class="form-control mx-2" id="quantity" value="1" min="1">
                            <button type="button"
                                class="btn btn-warning text-white btn-outline-secondary increase-quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        {{-- <button type="button" class="btn btn-warning btn-block" id="addToCartBtn">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button> --}}

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" id="val_product_id" name="product_id" value="{{ $product->id_product }}">
                            <input type="hidden" id="val_variant_id" name="variant_id" value="">
                            <input type="hidden" id="val_quantity" name="quantity" value="1" >
                            <button type="submit" class="btn btn-warning btn-block" id="addToCartBtn">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                    
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle increase in quantity
            $('.increase-quantity-btn').click(function() {
                increaseQuantity();
            });

            // Function to handle decrease in quantity
            $('.decrease-quantity-btn').click(function() {
                decreaseQuantity();
            });

            // Function to handle adding to cart
            $('#addToCartBtn').click(function() {
                addToCart();
            });

            // Function to update max stock when variant is changed
            $('#variant').change(function() {
                var selectedOption = $(this).find(':selected');
                var maxStock = selectedOption.data('max');
                $('#quantity').val(1);
                $('#quantity').attr('max', maxStock);
                $('#val_variant_id').val(selectedOption.val());
            });

            $('#quantity').change(function() {
                var quantityInput = $('#quantity');
                var maxStock = parseInt(quantityInput.attr('max'));
                var newValue = parseInt(quantityInput.val());
                if (newValue <= maxStock) {
                    quantityInput.val(newValue);
                    $('#val_quantity').val(newValue);
                } else {
                    quantityInput.val(1);
                    alert('Stok tidak cukup.');
                }
            });
        });

        function increaseQuantity() {
            var quantityInput = $('#quantity');
            var maxStock = parseInt(quantityInput.attr('max'));
            var newValue = parseInt(quantityInput.val()) + 1;
            if (newValue <= maxStock) {
                quantityInput.val(newValue);
                $('#val_quantity').val(newValue);
            } else {
                alert('Stok tidak cukup.');
            }
        }

        function decreaseQuantity() {
            var quantityInput = $('#quantity');
            var newValue = parseInt(quantityInput.val()) - 1;
            if (newValue >= parseInt(quantityInput.attr('min'))) {
                quantityInput.val(newValue);
                $('#val_quantity').val(newValue);
            }
        }

        function addToCart() {
            var selectedOption = $('#variant').find(':selected');
            var quantityInput = $('#quantity');
            var selectedQuantity = parseInt(quantityInput.val());
            var selectedVariantId = selectedOption.val();
            var productId = selectedOption.attr('data-id_product');;

            console.log("Variant ID:", selectedVariantId);
            console.log("Product ID:", productId);
            console.log("Quantity:", selectedQuantity);

            // Lakukan logika untuk menambahkan ke keranjang belanja di sini
        }
    </script>
@endsection
