<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'user_id', 'comment'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item the comment belongs to.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
