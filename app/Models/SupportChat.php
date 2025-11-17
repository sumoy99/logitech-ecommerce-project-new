<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportChat extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sender_id', 'support_id', 'message', 'attachment', 'is_admin', 'status', 'reply_to_id', 'is_seen', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
