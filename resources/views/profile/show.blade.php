@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-white">{{ __('User Profile') }}</div>

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

                        <form method="POST" action="{{ route('account.profile.update') }}">
                            @csrf
                            @method('PUT')


                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ Auth::user()->phone }}">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">{{ Auth::user()->address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="{{ Auth::user()->province }}">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ Auth::user()->city }}">
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="district" name="district"
                                    value="{{ Auth::user()->district }}">
                            </div>
                            <div class="mb-3">
                                <label for="village" class="form-label">Kelurahan/Desa</label>
                                <input type="text" class="form-control" id="village" name="village"
                                    value="{{ Auth::user()->village }}">
                            </div>
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    value="{{ Auth::user()->zip_code }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
