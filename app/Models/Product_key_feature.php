<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_key_feature extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'id', 'product_id', 'feature_name', 'feature_value', 'updated_at', 'created_at'
   ];

   public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
