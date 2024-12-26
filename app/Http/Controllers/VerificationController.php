<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\User::findOrFail($id);

        // Verify the hash matches the user's email
        if ($user->hasVerifiedEmail() || sha1($user->email) !== $hash) {
            return redirect('/')->with('status', 'Your email is already verified or the verification link is invalid.');
        }

        $user->markEmailAsVerified();

        event(new Verified($user));

        return redirect()->route('home')->with('success', 'Item posted successfully!');
    }
}
