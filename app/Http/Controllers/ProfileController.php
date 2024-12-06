<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        // Fetch all items posted by the authenticated user
   
        $user = Auth::user();

        // Pass the user data to the view
        return view('profile', compact('user'));
    }


    
   
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        try {
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $fileName = Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
                
                $filePath = $file->storeAs('profile_pictures', $fileName, 'public');
                $user = Auth::user();
                if ($user) {
                    $user->profile_photo_path = $filePath;
                    $user->save();
                } else {
                    return back()->with('error', 'User not authenticated. Please login first.');
                }
            }
            return back()->with('success', 'Profile picture updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error updating your profile picture. Please try again later.');
        }
    }
    
}
