<?php

namespace App\Models; 
 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 
 
class Product extends Model 
{ 
    use HasFactory; 
 
    protected $table = 'product'; // Sesuaikan dengan nama tabel kalian 
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, foreignKey: 'product_caregory_id');
    }
} 