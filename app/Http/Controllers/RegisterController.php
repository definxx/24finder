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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255', 'unique:users,tel'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referral' => ['nullable', 'exists:users,id'], // Ensure referral is an existing user ID or null
        ]);
    
        $referredBy = null; // Default to null
    
        if ($request->has('referral') && is_numeric($request->input('referral'))) {
            $referrer = User::find($request->input('referral')); // Find the referrer by user ID
            if ($referrer) {
                $referredBy = $referrer->id; // Save the referrer ID
            }
        }
    
        // Create the new user
        $newUser = User::create([
            'name' => $request->input('name'),
            'lname' => $request->input('lname'),
            'tel' => $request->input('tel'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'referred_by' => $referredBy, // Save the referral information
        ]);
    
        // Save the referral relationship
        if ($referredBy) {
            Referral::create([
                'user_id' => $newUser->id,
                'referred_by' => $referredBy,
            ]);
        }
    
        // Send email verification link
        $newUser->sendEmailVerificationNotification();
    
        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please check your email to verify your account.');
    }
    
    
}
