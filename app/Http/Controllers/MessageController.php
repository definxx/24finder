<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;  // Ensure you import the Message model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function create($user_id)
    {
        // Fetch the user to message (the recipient)
        $recipient = User::findOrFail($user_id);
    
        // Fetch the messages between the authenticated user and the recipient
        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('sender_id', Auth::id())
                  ->where('recipient_id', $user_id);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('sender_id', $user_id)
                  ->where('recipient_id', Auth::id());
        })->get();
    
        // Pass the recipient and messages to the view
        return view('message', compact('recipient', 'messages'));
    }
    
    // Handle sending the message
    public function send(Request $request, $user_id)
    {
        // Validate the message input
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Logic to store the message in the database
        Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $user_id,
            'message' => $request->input('message'),
        ]);

        // Redirect back with a success message
        return redirect()->back();
    }
    public function inbox()
    {
        $users = User::whereIn('id', function ($query) {
                $query->select('recipient_id')
                      ->from('messages')
                      ->where('sender_id', Auth::id())
                      ->distinct();
            })
            ->orWhereIn('id', function ($query) {
                $query->select('sender_id')
                      ->from('messages')
                      ->where('recipient_id', Auth::id())
                      ->distinct();
            })
            ->with(['lastMessage' => function ($query) {
                $query->latest('created_at');
            }])
            ->get();
    
        return view('inbox', compact('users'));
    }
    
    

}
