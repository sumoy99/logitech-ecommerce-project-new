<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
       * @var array
       */
   protected $fillable = [
       'id', 'title', 'logo', 'updated_at', 'created_at'
   ];
}
