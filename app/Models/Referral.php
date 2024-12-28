<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    // Allow mass assignment for these attributes
    protected $fillable = ['user_id', 'referred_by', 'completed'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }
}
