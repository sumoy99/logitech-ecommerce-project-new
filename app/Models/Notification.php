<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'id', 'type', 'notifiable_id', 'notifiable_type', 'data', 'read_at', 'created_at'
    ];
}
