<?php
namespace App\Actions\Fortify;

use App\Models\Family;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use App\Models\Referral;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
  

    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255', 'unique:users,tel'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        
        // Handle referral logic
        $referredBy = null; // Default to null
    
        if (!empty($input['referral']) && is_numeric($input['referral'])) {
            $referrer = User::find($input['referral']); // Find the referrer by user ID
            if ($referrer) {
                $referredBy = $referrer->id; // Store the referrer ID
                // Optionally, add points or other rewards for the referrer
                $referrer->increment('points', 10); // Example: 10 points for each successful referral
            } 
        } 
        // Create the new user with a unique referral code and the referrer information
        $newUser = User::create([
            'name' => $input['name'],
            'lname' => $input['lname'],
            'tel' => $input['tel'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'referred_by' => $referredBy, // Save the referral information (who referred the user)
        ]);
    
        // Store the referral relationship in the Referral table
        if ($referredBy) {
            Referral::create([
                'user_id' => $newUser->id,        // Store the new user's ID
                'referred_by' => $referredBy,     // Store the referrer's ID
            ]);
        }
    
        return $newUser;
    }
    
    
    
}
