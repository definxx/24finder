<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\{
    User,
    Referral,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $user_id =  $user->id;

    // Get the number of users referred by the authenticated user
    $referredCount = Referral::where('referred_by', $user_id)->count();

    $items = Item::where('user_id', $user_id)
                 ->where('status', 1) // Correct condition for status
                 ->get(); // Use `get` to get all records

    $postCount = $items->count();

    return view('profile', compact('user', 'items', 'postCount', 'referredCount'));
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
