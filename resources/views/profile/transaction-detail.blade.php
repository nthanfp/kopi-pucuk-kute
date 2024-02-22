@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Detail Transaksi</h2>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h4>ID Transaksi: {{ $transaction->id_transaction }}</h4>
                    </div>
                    <div class="card-body">
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
                                <span class="badge bg-primary">CANCELED</span>
                            @endif
                        </p>
                        <p><strong>Status Pembayaran:</strong>
                            @if ($transaction->payment_status == 'paid')
                                <span class="badge bg-success text-white">PAID</span>
                            @else
                                <span class="badge bg-primary">UNPAID</span>
                            @endif
                        </p>
                        <hr>
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
                        <hr>
                        <p><strong>Total Keseluruhan:</strong> Rp
                            {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
