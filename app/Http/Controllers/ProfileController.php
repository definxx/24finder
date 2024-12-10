<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id =  $user->id;
        $items = Item::where('user_id', $user->id)->get();
        $postCount = $items->count();
        return view('profile', compact('user', 'items', 'postCount'));
    }
   
    
    public function updateProfilePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if ($request->hasFile('profile_picture')) {
        $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $user->profile_photo_path = $filePath;
        $user->save();

        return back()->with('success', 'Profile picture updated successfully.');
    }

    return back()->with('error', 'No profile picture uploaded.');
}

}
