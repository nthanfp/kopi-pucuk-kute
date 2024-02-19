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
            <form action="{{ route('admin.web-profile.update', 1) }}" method="POST">
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

                <!-- tambahkan bidang lainnya sesuai kebutuhan -->

                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
