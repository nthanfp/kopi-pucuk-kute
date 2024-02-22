@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item active" aria-current="page">Kelola Profil Website Perusahaan</li>
        </ol>
    </nav>

    <div class="card mb-3">
        <div class="card-header bg-warning text-white">
            Kelola Profil Perusahaan
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
            <form action="{{ route('admin.web-profile.update', 1) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $web_profile->title }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description">{{ $web_profile->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo">
                </div>

                <div class="mb-3">
                    <label for="favicon" class="form-label">Favicon</label>
                    <input type="file" class="form-control" id="favicon" name="favicon">
                </div>

                <!-- Tambahkan bidang-bidang tambahan -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $web_profile->email }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $web_profile->phone }}">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $web_profile->address }}">
                </div>

                <div class="mb-3">
                    <label for="province" class="form-label">Provinsi</label>
                    <input type="text" class="form-control" id="province" name="province"
                        value="{{ $web_profile->province }}">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ $web_profile->city }}">
                </div>

                <div class="mb-3">
                    <label for="district" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="district" name="district"
                        value="{{ $web_profile->district }}">
                </div>

                <div class="mb-3">
                    <label for="village" class="form-label">Desa/Kelurahan</label>
                    <input type="text" class="form-control" id="village" name="village"
                        value="{{ $web_profile->village }}">
                </div>

                <div class="mb-3">
                    <label for="zip_code" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                        value="{{ $web_profile->zip_code }}">
                </div>
                <!-- End tambahan bidang-bidang tambahan -->

                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
