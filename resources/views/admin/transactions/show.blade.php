@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.transactions.index') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Detail Transaksi #{{ $transaction->id_transaction }}
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <p><strong>Tanggal Pesanan:</strong> {{ $transaction->transaction_date }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong>
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
                    </p>
                    <p><strong>Pembayaran:</strong>
                        @if ($transaction->payment_status == 'paid')
                            <span class="badge bg-success text-white">PAID</span>
                        @else
                            <span class="badge bg-primary">UNPAID</span>
                        @endif
                    </p>
                </div>

                <h4>Barang yang Dibeli</h4>
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
