<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
        protected $fillable = [
            'id', 'item_id', 'user_id', 'rating', 'rating_reason', 'feedback', 'updated_at', 'created_at'
        ];

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

    
}
