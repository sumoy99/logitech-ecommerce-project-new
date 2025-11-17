<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'product_id', 'thumbnail', 'hover_image', 'gallery_image', 'videos', 'video_thumbnail', 'youtube_link', 'pdf', 'updated_at', 'created_at'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
