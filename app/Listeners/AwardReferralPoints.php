<?php
namespace App\Listeners;

use App\Models\User;
use App\Models\Referral;
use App\Events\UserAction;

class AwardReferralPoints
{
    /**
     * Handle the event.
     *
     * @param \App\Events\UserAction $event
     */
    public function handle(UserAction $event)
    {
        $referredUser = $event->user;

        // Check if the referred user was referred by someone
        if ($referredUser->referred_by) {
            $referrer = User::find($referredUser->referred_by);

            // Check if the referred user has met the conditions
            $hasVerifiedEmail = $referredUser->email_verified_at !== null;
            $hasPostedItem = $referredUser->items()->exists();
            $hasCommented = $referredUser->comments()->exists();

            if ($hasVerifiedEmail && $hasPostedItem && $hasCommented) {
                // Award points to the referrer
                $referrer->increment('points', 10);

                // Optionally, mark the referral as "completed"
                Referral::where('user_id', $referredUser->id)
                    ->update(['completed' => true]);
            }
        }
    }
}
