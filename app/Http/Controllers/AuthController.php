<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Check if the user exists
        $user = User::where('email', $request->email)->first();
    
        // If user doesn't exist or the password doesn't match
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        // Generate a token (assuming you are using Passport or Sanctum for API authentication)
        $token = $user->createToken('YourAppName')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }
    
}
