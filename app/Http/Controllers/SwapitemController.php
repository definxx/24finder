<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SwapitemController extends Controller
{
    public function index(){
        return view('components.swap');
      }
    
      public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'description' => 'required|string',
        'condition' => 'required|string',
        'swap_preferences' => 'required|string|max:255', 
        'images' => 'required|array|max:5', 
        'images.*' => 'mimes:jpeg,png,jpg|max:2048',
    ]);

    $item = new Item();
    $item->title = $validated['title'];
    $item->category = $validated['category'];
    $item->description = $validated['description'];
    $item->condition = $validated['condition'];
    $item->swap_preferences = $validated['swap_preferences']; // Store swap preferences
    $item->user_id = Auth::user()->id;
    // Handle image uploads
    if ($request->hasFile('images')) {
        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('item_images', 'public');
        }
        $item->images = json_encode($imagePaths);
    }

    $item->save();

    return redirect()->route('sawp_item')->with('success', 'Item posted successfully!');
}

}
