<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table = 'currency';

    protected $fillable = [ 'id','name', 'code','symbol','flutterwave_supported','created_at','updated_at' ];

}
