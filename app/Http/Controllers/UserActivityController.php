<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserActivityController extends Controller
{
    public function logActivity(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        // Get the currently logged-in user's model
        $user = Auth::user();

        if (!$user) {
            return response()->json(['status' => 'user not found'], 404);
        }

        // Retrieve the time spent from the request
        $timeSpent = $request->input('time_spent', 0);

        // Calculate points earned (1 point per every 5 seconds)
        $pointsEarned = floor($timeSpent / 5);

        // Update the user's points and last activity time
        $user->points = ($user->points ?? 0) + $pointsEarned; // Default to 0 if no points exist
        $user->last_active_time = now();
        $user->save();

        return response()->json([
            'status' => 'success',
            'points_earned' => $pointsEarned,
            'total_points' => $user->points
        ]);
    }
}
