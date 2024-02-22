<!-- resources/views/admin/users/show.blade.php -->
@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pengguna</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-warning text-white">
            Detail Pengguna
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
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>{{ $user->province }}</td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td>{{ $user->city }}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>{{ $user->district }}</td>
                    </tr>
                    <tr>
                        <td>Desa</td>
                        <td>{{ $user->village }}</td>
                    </tr>
                    <tr>
                        <td>Kode Pos</td>
                        <td>{{ $user->zip_code }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <!-- Tambahkan baris tambahan sesuai kebutuhan -->
                </tbody>
            </table>
            <a href="{{ route('admin.user.edit', $user->id_user) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.user.destroy', $user->id_user) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
            </form>
        </div>
    </div>
@endsection
