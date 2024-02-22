<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'id_user', 'transaction_date', 'total_price', 'status', 'payment_status', 'address', 'province', 'city', 'district', 'village', 'zip_code', 'phone', 'shipping_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaction');
    }
}
