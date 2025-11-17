<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\User;

class PaymentHistory extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
       * @var array
       */
   protected $fillable = [
       'id', 'item_id', 'user_id', 'ammount', 'purchase_code', 'payment_type', 'transaction_id', 'transaction_number', 'payment_status', 'download_status', 'image', 'coupon', 'coupon_discount', 'referral_payout_status', 'updated_at', 'created_at'
   ];

   public function item()
    {
        return $this->belongsTo(Item::class, 'item_id'); // update class name if needed
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
