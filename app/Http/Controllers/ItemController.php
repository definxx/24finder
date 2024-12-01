<?php
namespace App\Http\Controllers;

use App\Models\Item; // Ensure you import the Item model
use Illuminate\Http\Request;

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
}
