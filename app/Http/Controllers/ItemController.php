<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ProductMail;
use App\Mail\ItemLikedNotification;
use App\Mail\ItemDislikedNotification;
use App\Mail\ItemCommentedNotification;

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
                Mail::to($user->email)->queue(new ProductMail($item));
            }
        }

        return redirect()->back()->with('success', 'Emails have been queued successfully.');
    }

    /**
     * Handle the 'like' action by a user.
     */
    public function like($id)
    {
        $item = Item::find($id);
    
        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Item not found']);
        }
    
        // Check if the user has already liked or disliked the item
        $existingLike = Like::where('user_id', Auth::user()->id)
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
        } else {
            // New like
            Like::create([
                'user_id' => Auth::user()->id,
                'item_id' => $id,
                'is_like' => true,
            ]);
            $item->increment('likes_count');
        }
    
        // Manually fetch the user by user_id
        $userId = $item->user_id; // Fetch the user_id from the item
        if ($userId) {
            // Fetch the user object using the user_id
            $user = User::find($userId);
            if ($user) {
                // Send the email to the user
                Mail::to($user->email)->send(new ItemLikedNotification($item, Auth::user()));
            }
        }
    
        return redirect()->back()->with('message', 'Item liked successfully!');
    }
    

    /**
     * Handle the 'dislike' action by a user.
     */
    public function dislike($id)
    {
        $item = Item::find($id);
    
        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Item not found']);
        }
    
        // Check if the user has already liked or disliked the item
        $existingLike = Like::where('user_id', Auth::user()->id)
                            ->where('item_id', $id)
                            ->first();
    
        if ($existingLike) {
            if (!$existingLike->is_like) {
                return redirect()->back()->withErrors(['error' => 'You have already disliked this item']);
            }
    
            // Switch from like to dislike
            $existingLike->update(['is_like' => false]);
            $item->increment('dislikes_count');
            $item->decrement('likes_count');
        } else {
            // New dislike
            Like::create([
                'user_id' => Auth::user()->id,
                'item_id' => $id,
                'is_like' => false,
            ]);
            $item->increment('dislikes_count');
        }
    
        // Manually fetch the user by user_id
        $userId = $item->user_id; // Fetch the user_id from the item
        if ($userId) {
            // Fetch the user object using the user_id
            $user = User::find($userId);
            if ($user) {
                // Send the email to the user
                Mail::to($user->email)->send(new ItemDislikedNotification($item, Auth::user()));
            }
        }
    
        return redirect()->back()->with('message', 'Item disliked successfully!');
    }
    

    /**
     * Handle the 'comment' action by a user.
     */
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
    
        // Create a new comment
        $comment = Comment::create([
            'item_id' => $id,
            'user_id' => $userId,
            'comment' => $commentText,
        ]);
    
        // Fetch the item
        $item = Item::find($id);
    
        // Manually fetch the user by user_id
        $userId = $item->user_id; // Fetch the user_id from the item
        if ($userId) {
            // Fetch the user object using the user_id
            $user = User::find($userId);
            if ($user) {
                // Send the email to the user
                Mail::to($user->email)->send(new ItemCommentedNotification($item, Auth::user(), $comment));
            }
        }
    
        return redirect()->back()->with('message', 'Comment added successfully!');
    }
    

    /**
     * Fetch likes and dislikes for a specific item.
     */
    public function getLikesDislikes($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json([
            'likes' => $item->likes_count,
            'dislikes' => $item->dislikes_count,
        ]);
    }

    /**
     * Fetch comments for a specific item.
     */
    public function getComments($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

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
