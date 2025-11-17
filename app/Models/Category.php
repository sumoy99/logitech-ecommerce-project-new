<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'id', 'name', 'parent_id', 'slug', 'image', 'status', 'meta_title', 'meta_desc', 'seo_desc', 'updated_at', 'created_at'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    // In Category.php model
    // public function allChildren()
    // {
    //     return $this->children()->with('allChildren');
    // }

    // public function children()
    // {
    //     return $this->hasMany(Category::class, 'parent_id');
    // }

}
