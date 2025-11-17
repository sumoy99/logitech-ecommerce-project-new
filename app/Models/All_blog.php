<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog_category;

class All_blog extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
        protected $fillable = [
            'id', 'blog_title', 'blog_subtitle', 'blog_category', 'blog_description', 'blog_keywords', 'blog_date', 'blog_thumbnail', 'updated_at', 'created_at'
        ];

        public function category()
    {
        return $this->belongsTo(Blog_category::class, 'blog_category');
    }
}
