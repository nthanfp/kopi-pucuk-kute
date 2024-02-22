@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-warning text-white">Create Payment Method
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.payment.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="account_number" class="form-label">Account Number</label>
                    <input type="text" class="form-control" id="account_number" name="account_number"
                        value="{{ old('account_number') }}">
                </div>
                <div class="mb-3">
                    <label for="account_name" class="form-label">Account Name</label>
                    <input type="text" class="form-control" id="account_name" name="account_name"
                        value="{{ old('account_name') }}">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="on" id="status" name="status"
                        {{ old('status') === 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">
                        Activate Payment Method
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
