@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-warning text-white">Filter Laporan</div>
                    <div class="card-body">
                        <form action="{{ route('admin.reports.sales') }}" method="GET">
                            <div class="form-group mb-3">
                                <label for="start_date">Tanggal Mulai:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="end_date">Tanggal Selesai:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-warning text-white">Laporan Penjualan</div>
                    <div class="card-body">
                        <div class="mt-2">
                            @if ($salesReport->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salesReport as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id_transaction }}</td>
                                                <td>{{ $transaction->transaction_date }}</td>
                                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Tidak ada data laporan penjualan untuk ditampilkan.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
