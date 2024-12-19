<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use App\Models\Dislike;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display the search results or index page.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('category', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('condition', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('search', compact('items', 'search'));
    }

    /**
     * Send product emails to all users.
     */
    public function sendProductEmails()
    {
        $items = Item::where('status', 1)->orderBy('created_at', 'desc')->get();
        $users = User::all();

        foreach ($items as $item) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new ProductMail($item));
            }
        }

        return redirect()->back()->with('success', 'Emails have been queued successfully.');
    }

    /**
     * Handle the 'like' action by a user.
     */
    public function getLikesDislikes($id) {
        $item = Item::find($id);
    
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
    
        return response()->json([
            'likes' => $item->likes_count,
            'dislikes' => $item->dislikes_count
        ]);
    }
    
 



    public function comment(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'You must log in to comment on an item']);
        }

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $userId = Auth::id();
        $commentText = $request->input('comment');

        Comment::create([
            'item_id' => $id,
            'user_id' => $userId,
            'comment' => $commentText,
        ]);

        return redirect()->back()->with('message', 'Comment added successfully!');
    }




public function like($id)
{
    $item = Item::find($id);

    if (!$item) {
        return redirect()->back()->withErrors(['error' => 'Item not found']);
    }

    $existingLike = Like::where('user_id', Auth::user()->id,)
                        ->where('item_id', $id)
                        ->first();

    if ($existingLike) {
        if ($existingLike->is_like) {
            return redirect()->back()->withErrors(['error' => 'You have already liked this item']);
        }

        // Switch from dislike to like
        $existingLike->update(['is_like' => true]);
        $item->increment('likes_count');
        $item->decrement('dislikes_count');

        return redirect()->back()->with('message', 'You switched your dislike to a like!');
    }

    // New like
    Like::create([
        'user_id' => Auth::user()->id,
        'item_id' => $id,
        'is_like' => true,
    ]);
    $item->increment('likes_count');

    return redirect()->back()->with('message', 'Item liked successfully!');
}
public function dislike($id)
{
    $item = Item::find($id);

    if (!$item) {
        return redirect()->back()->withErrors(['error' => 'Item not found']);
    }

    // Check if the user has already reacted to this item
    $existingLike = Like::where('user_id', Auth::user()->id)
                        ->where('item_id', $id)
                        ->first();

    if ($existingLike) {
        if (!$existingLike->is_like) {
            // User already disliked this item
            return redirect()->back()->withErrors(['error' => 'You have already disliked this item']);
        }

        // Switch from like to dislike
        $existingLike->update(['is_like' => false]);
        $item->increment('dislikes_count');
        $item->decrement('likes_count');

        return redirect()->back()->with('message', 'You switched your like to a dislike!');
    }

    // Add a new dislike
    Like::create([
        'user_id' => Auth::user()->id,
        'item_id' => $id,
        'is_like' => false,
    ]);
    $item->increment('dislikes_count');

    return redirect()->back()->with('message', 'Item disliked successfully!');
}

public function getComments($id)
{
    $item = Item::find($id);

    if (!$item) {
        return response()->json(['error' => 'Item not found'], 404);
    }

    // Fetch comments with user details
    $comments = $item->comments()->with('user:id,name')->latest()->get()->map(function ($comment) {
        return [
            'user_name' => $comment->user->name,
            'comment' => $comment->comment,
            'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
        ];
    });

    return response()->json($comments);
}


}
