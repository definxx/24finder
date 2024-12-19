<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dislike extends Model
{
    use HasFactory;

    // Specify the fields that are mass assignable
    protected $fillable = ['item_id', 'user_id'];

    // Define the relationship with the Item model
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
