<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NewItemAdded;
class Item extends Model
{
 
    protected $fillable = [
        'title', 'category','status', 'description', 'condition', 'price', 'images', 'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function booted()
    {
        static::created(function ($item) {
      
            event(new NewItemAdded($item));
        });
    }
    
}
