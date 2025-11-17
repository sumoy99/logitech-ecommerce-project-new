<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SupportChat;

class CustomerSupport extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'item_id', 'user_id', 'support_type', 'purchase_code', 'subject', 'status', 'file', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lastChat()
    {
        return $this->hasOne(SupportChat::class, 'support_id')->latestOfMany();
    }


}
