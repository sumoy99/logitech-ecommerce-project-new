<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class CartItem extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'id', 'item_id', 'user_id', 'quantity', 'updated_at', 'created_at'
    ];

    // In CartItem.php model
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
