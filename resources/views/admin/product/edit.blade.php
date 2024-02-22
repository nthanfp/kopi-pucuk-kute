@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item" aria-current="page">Admin</li>
            <li class="breadcrumb-item"><a href="">Kelola Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-warning text-white">
            Edit Produk
        </div>
        <div class="card-body">
            <!-- Form untuk mengubah detail produk -->
            <form action="{{ route('admin.product.update', $product->id_product) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <!-- Tambahkan input untuk harga atau atribut lainnya yang ingin Anda edit -->

                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-header bg-warning text-white">
            Kelola Variant Produk
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <!-- Form untuk menambah variant produk -->
                    <form action="{{ route('admin.variant.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">

                        <div class="mb-3">
                            <label for="variant_name" class="form-label">Nama Variant</label>
                            <input type="text" class="form-control" id="variant_name" name="variant_name"
                                placeholder="Masukkan nama variant">
                        </div>

                        <div class="mb-3">
                            <label for="variant_price" class="form-label">Harga Variant</label>
                            <input type="text" class="form-control" id="variant_price" name="variant_price"
                                placeholder="Masukkan harga variant">
                        </div>

                        <div class="mb-3">
                            <label for="variant_stock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="variant_stock" name="variant_stock"
                                placeholder="Masukkan stok variant">
                        </div>

                        <div class="mb-3">
                            <label for="variant_weight" class="form-label">Berat</label>
                            <input type="text" class="form-control" id="variant_weight" name="variant_weight"
                                placeholder="Masukkan berat variant">
                        </div>

                        <!-- Tambahkan input untuk atribut variant lainnya jika ada -->

                        <button type="submit" class="btn btn-success">Tambah Variant</button>
                    </form>
                </div>
                <div class="col-md-9">
                    <!-- Tampilkan daftar variant produk -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Variant</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Berat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->name }}</td>
                                    <td>Rp {{ Number::format($variant->price, locale: 'id') }}</td>
                                    <td>{{ $variant->stock }}</td>
                                    <td>{{ $variant->weight }}</td>
                                    <td>
                                        <a href="{{ route('admin.variant.edit', $variant->id_variant) }}"
                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ route('admin.variant.destroy', $variant->id_variant) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus variant ini?')"><i
                                                    class="fas fa-trash-alt"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
