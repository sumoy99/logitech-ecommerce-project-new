<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project_category;
use App\Models\PaymentHistory;

class Item extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
        * @var array
        */
    protected $fillable = [
        'id', 'item_title', 'subtitle', 'item_category', 'lebel', 'item_description', 'price', 'item_price', 'item_percent', 'screenshot', 'demo_url', 'item_file', 'item_thumbnail', 'item_id', 'updated_at', 'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Project_category::class, 'item_category');
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'item_id');
    }

}
