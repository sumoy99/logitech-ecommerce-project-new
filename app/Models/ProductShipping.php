<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model
{
    use HasFactory;

    protected $fillable = [
       'id', 'product_id', 'shipping_type', 'cash_on_delivery', 'shipping_cost', 'shipping_days', 'note', 'updated_at', 'created_at'
   ];
   
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
