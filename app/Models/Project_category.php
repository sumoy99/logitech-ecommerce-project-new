<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Project_category extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'id', 'category_name', 'updated_at', 'created_at'
    ];

    public function projects()
    {
        return $this->hasMany(Item::class, 'item_category');
    }
}
