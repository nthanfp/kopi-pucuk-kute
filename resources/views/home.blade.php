@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Selamat Datang di {{ $webProfile->title }}</h1>
            <p class="lead">{{ $webProfile->description }}</p>
            <hr class="my-4">
            <p>Kami menyajikan berbagai macam jenis kopi dari berbagai daerah yang diproses dengan teknik yang canggih untuk
                memberikan rasa dan aroma yang khas.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('product.list') }}" role="button">Eksplor Produk</a>
        </div>
    </div>
@endsection
