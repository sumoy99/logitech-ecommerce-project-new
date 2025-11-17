<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'attribute_id', 'value', 'created_at', 'updated_at'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
