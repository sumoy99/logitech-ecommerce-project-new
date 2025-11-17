<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\All_blog;

class Blog_category extends Model
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

        public function blogs()
        {
            return $this->hasMany(All_blog::class, 'blog_category');
        }
}
