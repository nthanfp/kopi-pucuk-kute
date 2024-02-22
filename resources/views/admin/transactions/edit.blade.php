@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ config('app.name', 'Laravel') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.transactions.index') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Transaksi</li>
        </ol>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edit Status Transaksi #{{ $transaction->id_transaction }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transactions.update', $transaction->id_transaction) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="process" {{ $transaction->status == 'process' ? 'selected' : '' }}>Process
                            </option>
                            <option value="shipping" {{ $transaction->status == 'shipping' ? 'selected' : '' }}>Shipping
                            </option>
                            <option value="canceled" {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-control" id="payment_status" name="payment_status">
                            <option value="paid" {{ $transaction->payment_status == 'paid' ? 'selected' : '' }}>Paid
                            </option>
                            <option value="unpaid" {{ $transaction->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
