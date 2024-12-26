<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function family()
{
    return $this->belongsTo(User::class, 'referred_by');
}

}
