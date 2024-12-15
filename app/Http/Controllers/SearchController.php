<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query', ''); // Get search input safely
    
        // Search logic: only return the first matched item
        $result = Item::where('title', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('price', 'like', "%$query%")
            ->first(); // Fetch only the first match
    
        return view('search', compact('result'));
    }
    
    
    
}
