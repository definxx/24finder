<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use App\Models\User;
class EmailController extends Controller
{
    public function sendWelcomeEmail(User $user)
{
    // Ensure email and names exist
    if (!$user || !$user->email) {
        dd('Invalid user or email');
    }

    $toEmail = $user->email; 
    $message = "Welcome to 24finder";
    $subject = "Welcome {$user->name} {$user->lname} to 24finder using 24finder";

    // Debugging - make sure the email is passed correctly
    dd($toEmail);

    // Send the email
    $response = Mail::to($toEmail)->send(new WelcomeEmail($message, $subject, $user->name, $user->lname));

    dd($response); // Inspect the response
}


    
}
