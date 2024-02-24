@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-warning text-white">Filter Laporan</div>
                    <div class="card-body">
                        <form action="{{ route('admin.reports.inventory') }}" method="GET">
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
                    <div class="card-header bg-warning text-white">Laporan Inventaris Produk</div>
                    <div class="card-body">
                        <div class="mt-2">
                            {{-- @if ($salesReport->isEmpty())
                                <p>Tidak ada data penjualan produk untuk ditampilkan.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Transaksi</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salesReport as $transactionDetail)
                                                <tr>
                                                    <td>{{ $transactionDetail->transaction->id_transaction }}</td>
                                                    <td>{{ $transactionDetail->product->name }}</td>
                                                    <td>{{ $transactionDetail->quantity }}</td>
                                                    <td>Rp {{ number_format($transactionDetail->price, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($transactionDetail->subtotal, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
