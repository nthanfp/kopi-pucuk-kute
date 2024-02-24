@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.transactions.index') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header bg-warning text-white">
                Detail Transaksi #{{ $transaction->id_transaction }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Informasi Pengguna</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama Pengguna:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email Pengguna:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <!-- Sisipkan informasi pengguna lainnya jika diperlukan -->
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5>Informasi Transaksi</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tanggal Pesanan:</td>
                                    <td>{{ $transaction->transaction_date }}</td>
                                </tr>
                                <tr>
                                    <td>Total Harga:</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>
                                        @if ($transaction->status == 'pending')
                                            <span class="badge bg-warning text-white">PENDING</span>
                                        @elseif ($transaction->status == 'completed')
                                            <span class="badge bg-success">COMPLETED</span>
                                        @elseif ($transaction->status == 'process')
                                            <span class="badge bg-info">PROCESS</span>
                                        @elseif ($transaction->status == 'shipping')
                                            <span class="badge bg-info">SHIPPING</span>
                                        @else
                                            <span class="badge bg-danger">CANCELED</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pembayaran:</td>
                                    <td>
                                        @if ($transaction->payment_status == 'paid')
                                            <span class="badge bg-success text-white">PAID</span>
                                        @else
                                            <span class="badge bg-primary">UNPAID</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5>Barang yang Dibeli</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->details as $detail)
                                <tr>
                                    <td>{{ $detail->product->id_product }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
