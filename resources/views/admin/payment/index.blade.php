@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Kelola Metode Pembayaran</li>
        </ol>
    </nav>

    <div class="card mb-3">
        <div class="card-header bg-warning text-white">
            Daftar Metode Pembayaran
        </div>
        <div class="card-body">
            <a href="{{ route('admin.payment.create') }}" class="btn btn-success btn-sm mb-3"><i class="fas fa-plus"></i>
                Tambah Metode Pembayaran</a>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Pemilik Rekening</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->account_number }}</td>
                                <td>{{ $payment->account_name }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>
                                    <a href="{{ route('admin.payment.show', $payment->id) }}" class="btn btn-info btn-sm"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.payment.edit', $payment->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.payment.destroy', $payment->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus metode pembayaran ini?')"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{-- {!! $payments->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
