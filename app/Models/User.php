<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeEmail;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lname',
        'points',
        'tel',
        'email',
        'password',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function booted()
{
    static::created(function ($user) {
        try {
            // Send welcome email automatically after user creation
            Mail::to($user->email)->send(new \App\Mail\WelcomeEmail(
                'Welcome to 24finder!',
                'Welcome to 24finder',
                $user->name,
                $user->lname
            ));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }
    });

    static::updated(function ($user) {
        // Trigger the UserAction event if the email has been verified
        if ($user->isDirty('email_verified_at') && $user->email_verified_at !== null) {
            event(new \App\Events\UserAction($user));
        }
    });
}

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'sender_id', 'id')
            ->orWhere('recipient_id', $this->id)
            ->latest('created_at');
    }

public function items()
{
    return $this->hasMany(Item::class);
}




public function follows()
{
    return $this->hasMany(Follow::class, 'follower_user_id');
}

public function followers()
{
    return $this->hasMany(Follow::class, 'followed_user_id');
}
public function likes()
{
    return $this->hasMany(Like::class);
}



public function referrals()
{
    return $this->hasMany(Referral::class, 'referred_by');
}

}
