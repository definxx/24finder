<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = ['item_id', 'user_id', 'comment'];

    /**
     * Define the relationship with the Item model
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Define the relationship with the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Booted method to listen for the "created" event and trigger actions.
     */
    protected static function booted()
    {
        static::created(function ($comment) {
            // Fire UserAction event when a new comment is created
            event(new \App\Events\UserAction($comment->user));
        });
    }
}
