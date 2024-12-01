<?php

namespace App\Http\Controllers;

use App\Models\{Swap,Item,};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SwapRequestController extends Controller
{
    public function index()
    {
        // Fetch swap requests associated with the logged-in user
        $swaps = Swap::with('item', 'user')
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->paginate(10);

        return view('swaps', compact('swaps'));
    }
    public function swap_request(Request $request)
    {
        $user = Auth::user();
        $userItems = Item::where('user_id', $user->id)->get();
        $swapRequests = [];
        $item = null;  // Assuming a single item or some specific logic for `$item`
    
        foreach ($userItems as $userItem) {
            $swaps = Swap::where('item_id', $userItem->id)->get();
            if ($swaps->isNotEmpty()) {
                $swapRequests[] = [
                    'item' => $userItem,
                    'swaps' => $swaps
                ];
                $item = $userItem;  // You may want to assign one of the items or choose another logic
            }
        }
    
        return view('swap_requests', compact('swapRequests', 'item'));
    }
    
    public function update_swap_status(Request $request, $swapRequestId)
    {
        // Validate the request data (optional, but recommended)
        $request->validate([
            'status' => 'required|in:approved,declined',
        ]);
    
        // Find the SwapRequest by its ID
        $swapRequest = Swap::findOrFail($swapRequestId);
    
        // Update the status of the SwapRequest based on the user's action
        $swapRequest->status = $request->input('status');
    
        // Save the changes to the database
        $swapRequest->save();
    
        // Optionally, you can add a success message to the session
        session()->flash('success', 'Swap request status updated successfully.');
    
        // Redirect back or to a specific route (e.g., the swap requests listing page)
        return redirect()->back();
    }
}
