<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'name', 'description', 'image_url'
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'id_product');
    }

    public function details()
    {
        return $this->hasManyThrough(TransactionDetail::class, ProductVariant::class, 'id_product', 'id_variant');
    }

    public function getImageUrlAttribute($value)
    {
        // Jika image_url tidak kosong, kembalikan image_url tersebut
        if ($value) {
            return asset('storage/' . $value);
        } else {
            // Jika image_url kosong, kembalikan URL gambar placeholder sesuai kebutuhan Anda
            return 'https://via.placeholder.com/600x400';
        }
    }
}
