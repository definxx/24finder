<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Dislike extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'user_id'];
    
}
