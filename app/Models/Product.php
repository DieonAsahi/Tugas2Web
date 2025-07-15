<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelCart\Cartable;

class Product extends Model implements Cartable
{
    // relasi
    public function category()
    {
        return $this->belongsTo(Categories::class, 'product_category_id');
    }

    // harga (cartable)
    public function getPrice(): float
    {
        return $this->price;
    }

    // kita tidak butuh accessor image_url lagi
}
