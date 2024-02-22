@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
        </ol>
    </nav>

    <div class="row">
        <div class="container">
            <div class="table-responsive">
                <table class="table table bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Pesanan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id_transaction }}</td>
                                <td>{{ $transaction->transaction_date }}</td>
                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
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
                                <td>
                                    @if ($transaction->payment_status == 'paid')
                                        <span class="badge bg-success text-white">PAID</span>
                                    @else
                                        <span class="badge bg-primary">UNPAID</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('transaction.detail', ['id' => $transaction->id_transaction]) }}"
                                        class="btn btn-primary btn-sm">View Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
