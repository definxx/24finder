<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    // The table associated with the model
    protected $table = 'password_resets';

    // Disable timestamps if not needed (Laravel doesn't automatically set timestamps for this table)
    public $timestamps = false;

    // Define the fields that are mass assignable
    protected $fillable = ['email', 'token', 'created_at'];
}
