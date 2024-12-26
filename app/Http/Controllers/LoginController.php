<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerify; // Import the custom mailable
use Illuminate\Support\Facades\Mail; // Import the Mail facade

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
            // Pass the user instance to the mailable
            Mail::to($user->email)->send(new EmailVerify($user));

            // Log the user out after sending the verification email
            Auth::logout();
            
            return back()->with('status', 'Your email is not verified. Please check your mail to verify your email before logging in.');
        }

        return redirect()->route('home');
    }

    return back()->with('status', 'Invalid login details');
}
}
