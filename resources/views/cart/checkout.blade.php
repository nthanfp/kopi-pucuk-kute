<!-- resources/views/checkout.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mb-4">
        <div class="row">
            <!-- Summary of the order here -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        Ringkasan Pesanan
                    </div>
                    <div class="card-body">
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
                        <p>Total Items: <strong>{{ $totalItems }}</strong></p>
                        <p>Total Price: <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong></p>
                        <!-- Tambahkan informasi tambahan untuk ringkasan pesanan jika diperlukan -->
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <!-- Checkout form for address and shipping information -->
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        Alamat Pengiriman
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required
                                    value="{{ auth()->user()->name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ auth()->user()->phone ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required>{{ auth()->user()->address ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="{{ auth()->user()->province ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Kota/Kabupaten</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ auth()->user()->city ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="district" name="district"
                                    value="{{ auth()->user()->district ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="village" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="village" name="village"
                                    value="{{ auth()->user()->village ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    value="{{ auth()->user()->zip_code ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_payment" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="id_payment" name="id_payment" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tambahan informasi pengiriman lainnya sesuai kebutuhan -->
                            <button type="submit" class="btn btn-primary mb-3">Lanjut ke Pembayaran</button>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
