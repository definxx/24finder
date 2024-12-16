<?php
namespace App\Http\Controllers;

use App\Models\Item; // Ensure you import the Item model
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;
class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve search query
        $search = $request->input('search');

        // Filter items based on search query
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



    public function sendProductEmails()
    {
        // Fetch all items from database
        $items = Item::all();
        
        // Fetch all users
        $users = User::all();

        foreach ($items as $item) {
            foreach ($users as $user) {
                // Queue mail to notify each user about each product
                Mail::to("$user->email")->send(new ProductMail($item));

            }
        }

        return redirect()->back()->with('success', 'Emails have been queued successfully.');
    }

}
