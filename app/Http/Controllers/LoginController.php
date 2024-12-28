<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerify;
use App\Mail\ForgotPassword;
use App\Models\User;

class LoginController extends Controller
{
    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                if (!$user->email_verification_sent_at || $user->email_verification_sent_at < now()->subMinutes(10)) {
                    $user->email_verification_sent_at = now();
                    $user->save();

                    Mail::to($user->email)->send(new EmailVerify($user));
                }

                Auth::logout();
                return back()->with('status', 'Your email is not verified. Please check your email to verify before logging in.');
            }

            return redirect()->route('home');
        }

        return back()->with('status', 'Incorrect email or password.');
    }

    public function forget()
    {
        return view('auth.forget');
    }

 
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Generate a reset token
            $token = Str::random(64);
    
            // Store the token in the `password_resets` table
            DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => now(),
                ]
            );
    
            // Send the reset email
            Mail::to($user->email)->send(new ForgotPassword($user, $token));
    
            return back()->with('status', 'Password reset link has been sent to your email.');
        }
    
        return back()->with('status', 'No user found with this email.');
    }
    


    public function showResetForm(Request $request)
    {
        // Get the token from the query parameters
        $token = $request->query('token');
        
        // Retrieve the email associated with the token
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();
    
        if (!$passwordReset) {
            return redirect()->route('login')->with('error', 'Invalid or expired token.');
        }
    
        // Return the reset password view with the token and associated email
        return view('resetpass', [
            'token' => $token,
            'email' => $passwordReset->email, // Pass the email to the view
        ]);
    }
    


public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed', // `confirmed` ensures password confirmation field matches
    ]);

    $passwordReset = PasswordReset::where('email', $request->email)
                                   ->where('token', $request->token)
                                   ->first();

    if (!$passwordReset) {
        return back()->with('error', 'Invalid or expired token.');
    }

    // Update the user's password
    $user = User::where('email', $request->email)->first();
    if ($user) {
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete the token after password reset
        $passwordReset->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully.');
    }

    return back()->with('error', 'User not found.');
}

}
// Compare this snippet from app/Http/Controllers/ProfileController.php: