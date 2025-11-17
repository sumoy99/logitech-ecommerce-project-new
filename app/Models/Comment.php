<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'user_id', 'feadback', 'parent_id', 'is_seen', 'is_replied'
    ];

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies.user', 'user');
    }

    public function latestReply()
    {
        return $this->hasOne(Comment::class, 'parent_id')->latestOfMany();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
