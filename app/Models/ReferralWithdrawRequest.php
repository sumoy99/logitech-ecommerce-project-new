<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ReferralWithdrawRequest extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
       * @var array
       */
   protected $fillable = [
       'id', 'user_id', 'amount', 'payment_method', 'account_number', 'status', 'updated_at', 'created_at'
   ];

   public function user()
    {
        return $this->belongsTo(User::class);
    }

}
