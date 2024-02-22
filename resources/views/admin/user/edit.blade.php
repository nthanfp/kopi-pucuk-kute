<!-- resources/views/admin/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-header bg-warning text-white">
            Edit Pengguna
        </div>
        <div class="card-body">
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
            <form action="{{ route('admin.user.update', $user->id_user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Alamat</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                </div>

                <div class="form-group mb-3">
                    <label for="province">Provinsi</label>
                    <input type="text" name="province" id="province" class="form-control" value="{{ $user->province }}">
                </div>

                <div class="form-group mb-3">
                    <label for="city">Kota</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ $user->city }}">
                </div>

                <div class="form-group mb-3">
                    <label for="district">Kecamatan</label>
                    <input type="text" name="district" id="district" class="form-control" value="{{ $user->district }}">
                </div>

                <div class="form-group mb-3">
                    <label for="village">Desa</label>
                    <input type="text" name="village" id="village" class="form-control" value="{{ $user->village }}">
                </div>

                <div class="form-group mb-3">
                    <label for="zip_code">Kode Pos</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ $user->zip_code }}">
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection