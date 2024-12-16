<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Follow extends Model
{

    use HasFactory;

    protected $fillable = ['follower_user_id', 'followed_user_id'];
   
}
