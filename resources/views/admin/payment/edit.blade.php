@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.payment.index') }}">Kelola Metode Pembayaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Metode Pembayaran</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-warning text-white">
            Edit Metode Pembayaran
        </div>
        <div class="card-body">
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

            <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $payment->name }}">
                </div>

                <div class="mb-3">
                    <label for="account_number" class="form-label">Nomor Rekening</label>
                    <input type="text" class="form-control" id="account_number" name="account_number"
                        value="{{ $payment->account_number }}">
                </div>

                <div class="mb-3">
                    <label for="account_name" class="form-label">Nama Pemilik Rekening</label>
                    <input type="text" class="form-control" id="account_name" name="account_name"
                        value="{{ $payment->account_name }}">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="status" name="status" {{ $payment->status ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Aktifkan Metode Pembayaran</label>
                </div>
                

                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
