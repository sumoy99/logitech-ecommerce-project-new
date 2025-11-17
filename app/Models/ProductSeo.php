<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSeo extends Model
{
    use HasFactory;

    protected $fillable = [
       'id', 'product_id', 'meta_title', 'meta_description', 'meta_keywords', 'meta_image', 'og_title', 'og_description', 'og_image', 'og_keywords', 'canonical_url', 'index_status', 'follow_status', 'updated_at', 'created_at'
   ];
   
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
