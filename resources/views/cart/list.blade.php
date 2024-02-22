@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- List of items in the cart -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Keranjang Saya</h5>
                        <hr>
                        @if ($cart && count($cart) > 0)
                            @foreach ($cart as $item)
                                <div class="row mb-3">
                                    <!-- Product Image -->
                                    <div class="col-3">
                                        <img src="{{ $item['image'] }}" class="img-fluid" alt="Product Image">
                                    </div>
                                    <!-- Product Name -->
                                    <div class="col-6">
                                        <h5 class="card-title">{{ $item['name'] }} - {{ $item['variant_name'] }}</h5>
                                        <!-- Quantity -->
                                        <div class="input-group" style="width: 180px;">
                                            <button type="button" class="btn btn-outline-secondary decrease-quantity-btn"
                                                onclick="updateQuantity({{ $item['variant_id'] }}, 'decrease')">-</button>
                                            <input type="number" class="form-control text-center quantity-input"
                                                id="quantity_{{ $item['variant_id'] }}" value="{{ $item['quantity'] }}">
                                            <button type="button" class="btn btn-outline-secondary increase-quantity-btn"
                                                onclick="updateQuantity({{ $item['variant_id'] }}, 'increase')">+</button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-primary delete-item-btn"
                                                onclick="deleteCartItem({{ $item['variant_id'] }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Total Price -->
                                    <div class="col-3 align-items-middle">
                                        <p class="card-text text-end align-items-middle">
                                            <strong>Rp {{ number_format($item['total_price'], 0, ',', '.') }}</strong>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Keranjang Anda kosong.</p>
                        @endif
                    </div>
                </div>
                <!-- Update Cart Button -->
                <button class="btn btn-primary mb-3" onclick="updateCart()">Update Cart</button>
            </div>

            <div class="col-md-4">
                <!-- Checkout summary -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
                        @php
                            $totalItems = 0;
                            $totalPrice = 0;
                            if ($cart && count($cart) > 0) {
                                foreach ($cart as $item) {
                                    $totalItems += $item['quantity'];
                                    $totalPrice += $item['total_price'];
                                }
                            }
                        @endphp
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Total Items</th>
                                    <td>{{ $totalItems }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total Price</th>
                                    <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-block">Proceed to Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQuantity(variantId, action) {
            var quantityInput = document.getElementById('quantity_' + variantId);
            var newValue;
            if (action === 'increase') {
                newValue = parseInt(quantityInput.value) + 1;
            } else {
                newValue = parseInt(quantityInput.value) - 1;
                if (newValue < 1) newValue = 1;
            }
            quantityInput.value = newValue;
        }

        function updateCart() {
            var cartItems = [];
            var quantityInputs = document.getElementsByClassName('quantity-input');
            for (var i = 0; i < quantityInputs.length; i++) {
                var variantId = quantityInputs[i].id.replace('quantity_', '');
                var quantity = quantityInputs[i].value;
                cartItems.push({
                    variant_id: variantId,
                    quantity: quantity
                });
            }

            // Kirim data ke controller menggunakan AJAX
            $.ajax({
                url: '{{ route('cart.update') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    cart_items: cartItems
                },
                success: function(response) {
                    if (response.success) {
                        alert('Cart updated successfully.');
                        window.location.reload();
                    } else {
                        alert('Failed to update cart.');
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function deleteCartItem(variantId) {
            // Konfirmasi pengguna sebelum menghapus item dari keranjang
            if (confirm('Are you sure you want to delete this item from your cart?')) {
                // Kirim request ke controller untuk menghapus item dari keranjang
                $.ajax({
                    url: '{{ route('cart.delete') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        variant_id: variantId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Item deleted successfully.');
                            window.location.reload();
                        } else {
                            alert('Failed to delete item.');
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    </script>

@endsection
