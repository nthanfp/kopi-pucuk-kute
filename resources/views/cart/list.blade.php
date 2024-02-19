<!-- resources/views/cart.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h4>Keranjang Saya</h4> --}}
        <div class="row">
            <div class="col-md-8">
                <!-- List of items in the cart -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Keranjang Saya</h5>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <!-- Product Image -->
                                <img src="https://via.placeholder.com/300x200" class="img-fluid" alt="Product Image">
                            </div>
                            <div class="col-6">
                                <!-- Product Name -->
                                <h5 class="card-title">Product Name</h5>
                                <!-- Quantity -->
                                <div class="input-group" style="width: 120px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                                    <input type="number" class="form-control text-center" id="quantity" value="1">
                                    <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                            <div class="col-3 align-items-middle">
                                <!-- Total Price -->
                                <p class="card-text text-end align-items-middle"><strong>$19.99</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Checkout summary -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <hr>
                        <p>Total Items: <strong>1</strong></p>
                        <p>Total Price: <strong>$19.99</strong></p>
                        <a href="#" class="btn btn-primary btn-block">Proceed to Checkout</a>
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
