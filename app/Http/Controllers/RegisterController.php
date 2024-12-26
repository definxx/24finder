<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerify; // Ensure you have the EmailVerify mailable


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');  // Show the registration form
    }

   
    public function processRegister(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255', 'unique:users,tel'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referral' => ['nullable', 'exists:users,id'],  // Ensure referral is an existing user ID or null
        ]);
    
        // Handle referral logic
        $referredBy = null; // Default to null
    
        if ($request->has('referral') && is_numeric($request->input('referral'))) {
            $referrer = User::find($request->input('referral')); // Find the referrer by user ID
            if ($referrer) {
                $referredBy = $referrer->id; // Store the referrer ID
                // Optionally, add points or other rewards for the referrer
                $referrer->increment('points', 10); // Example: 10 points for each successful referral
            }
        }
    
        // Create the new user with a unique referral code and the referrer information
        $newUser = User::create([
            'name' => $request->input('name'),
            'lname' => $request->input('lname'),
            'tel' => $request->input('tel'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'referred_by' => $referredBy, // Save the referral information (who referred the user)
        ]);
    
        // Store the referral relationship in the Referral table
        if ($referredBy) {
            Referral::create([
                'user_id' => $newUser->id,        // Store the new user's ID
                'referred_by' => $referredBy,     // Store the referrer's ID
            ]);
        }
    
        // Send email verification link to the newly registered user
        $newUser->sendEmailVerificationNotification();
    
        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please check your email to verify your account.');
    }
    
}
