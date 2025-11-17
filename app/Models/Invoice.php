<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invoice extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
       * @var array
       */
   protected $fillable = [
       'id', 'item_id', 'user_id', 'amount', 'product_discount', 'coupon_discount', 'payment_type', 'transaction_id', 'transaction_number', 'image', 'status', 'updated_at', 'created_at'
   ];

   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
