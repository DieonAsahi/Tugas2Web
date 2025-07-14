<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelCart\Cartable;
use Illuminate\Support\Facades\Storage;

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

    // ✅ accessor untuk image_url
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image); // hasilnya /storage/uploads/products/xxx.jpg
        }

        return 'https://via.placeholder.com/100x100?text=No+Image';
    }

    // tambahkan ini jika ingin Laravel otomatis load properti image_url
    protected $appends = ['image_url'];
}
