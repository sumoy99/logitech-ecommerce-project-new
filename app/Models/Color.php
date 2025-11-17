<?php

namespace App\Models;

// use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'id', 'name', 'hex_code', 'status', 'updated_at', 'created_at'
    ];

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class);
    // }

    public function productColorImages()
    {
        return $this->hasMany(ProductColorImage::class, 'color_id');
    }

}
