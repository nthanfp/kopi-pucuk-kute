@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">Admin</li>
        <li class="breadcrumb-item active" aria-current="page">Kelola Produk</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header bg-warning text-white">
        Detail Produk
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Nama Produk</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Deskripsi</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Gambar</th>
                    <td>
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 200px;">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Harga</th>
                    <td>Rp 
                        @if ($product->variants->isNotEmpty())
                            {{ Number::format($product->variants->min('price'), locale: 'id') }} - Rp
                            {{ Number::format($product->variants->max('price'), locale: 'id') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Pembuatan</th>
                    <td>{{ $product->created_at->format('d M Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Pembaruan</th>
                    <td>{{ $product->updated_at->format('d M Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th scope="row">Variant</th>
                    <td>
                        @if ($product->variants->isNotEmpty())
                            <ul>
                                @foreach ($product->variants as $variant)
                                    <li>{{ $variant->name }} - Rp {{ Number::format($variant->price, locale: 'id') }}</li>
                                @endforeach
                            </ul>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
