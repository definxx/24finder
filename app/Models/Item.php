<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
 
    protected $fillable = [
        'title', 'category', 'description', 'condition', 'price', 'images', 'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    
}
