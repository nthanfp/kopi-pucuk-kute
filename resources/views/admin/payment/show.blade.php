@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}">Kelola Metode Pembayaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Metode Pembayaran</li>
        </ol>
    </nav>

    <div class="card mb-3">
        <div class="card-header bg-warning text-white">
            Detail Metode Pembayaran
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $payment->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor Rekening</th>
                            <td>{{ $payment->account_number }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Pemilik Rekening</th>
                            <td>{{ $payment->account_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>{{ $payment->status ? 'ON' : 'OFF' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
@endsection
