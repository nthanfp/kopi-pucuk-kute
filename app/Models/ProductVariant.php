<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'id_variant';

    protected $fillable = [
        'id_product', 'name', 'price', 'stock', 'weight'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'id_variant');
    }
}
