<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency_progress extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
    * @var array
    */
    protected $fillable = [
        'id', 'agency_progress_title', 'total_agency_progress', 'agency_progress_icon', 'status', 'updated_at', 'created_at'
    ];
 
}
