<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'product_id', 'color_id', 'images', 'updated_at', 'created_at'
    ];

    protected $casts = [
        'images' => 'array', 
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
