@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-white">Halaman Utama Laporan</div>

                    <div class="card-body">
                        <p>Silakan pilih jenis laporan yang ingin Anda lihat:</p>

                        <div class="list-group">
                            <a href="{{ route('admin.reports.sales') }}" class="list-group-item list-group-item-action">Laporan Penjualan</a>
                            {{-- <a href="{{ route('admin.reports.inventory') }}" class="list-group-item list-group-item-action">Laporan Inventaris</a> --}}
                            {{-- <a href="{{ route('admin.reports.customer') }}" class="list-group-item list-group-item-action">Laporan Pelanggan</a> --}}
                            <!-- Tambahkan link ke laporan tambahan jika diperlukan -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
