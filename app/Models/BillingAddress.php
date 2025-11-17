<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;
/**
    * The attributes that are mass assignable.
    *
       * @var array
       */
   protected $fillable = [
       'id','user_id', 'name', 'phone', 'house', 'region', 'area', 'custom_area', 'city', 'address', 'colony', 'email', 'updated_at', 'created_at'
   ];

}
