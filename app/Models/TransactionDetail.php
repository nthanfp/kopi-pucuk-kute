<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $primaryKey = 'id_transaction_detail';

    protected $fillable = [
        'id_transaction', 'id_product', 'id_variant', 'quantity', 'price', 'subtotal'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant');
    }
}
