<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttributeValue;

class Attribute extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        protected $fillable = [
            'id', 'name', 'slug', 'type', 'created_at', 'updated_at'
        ];

        public function values()
        {
            return $this->hasMany(AttributeValue::class);
        }

       
}
