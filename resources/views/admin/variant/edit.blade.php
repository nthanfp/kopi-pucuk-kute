@extends('layouts.app')

@section('content')
    <div class="card mt-3 mb-3">
        <div class="card-header bg-warning text-white">
            Edit Variant Produk
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

            <form action="{{ route('admin.variant.update', $variant->id_variant) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_product" class="form-label">ID Produk</label>
                    <input type="text" class="form-control" id="id_product" name="id_product"
                        value="{{ $variant->id_product }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="variant_name" class="form-label">Nama Variant</label>
                    <input type="text" class="form-control" id="variant_name" name="variant_name"
                        value="{{ $variant->name }}">
                </div>

                <div class="mb-3">
                    <label for="variant_price" class="form-label">Harga Variant</label>
                    <input type="text" class="form-control" id="variant_price" name="variant_price"
                        value="{{ $variant->price }}">
                </div>

                <div class="mb-3">
                    <label for="variant_stock" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="variant_stock" name="variant_stock"
                        value="{{ $variant->stock }}">
                </div>

                <div class="mb-3">
                    <label for="variant_weight" class="form-label">Berat</label>
                    <input type="text" class="form-control" id="variant_weight" name="variant_weight"
                        value="{{ $variant->weight }}">
                </div>

                <!-- Tambahkan input untuk atribut variant lainnya jika ada -->

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
