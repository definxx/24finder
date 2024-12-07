<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function show($id)
{
    $product = Item::where('id',$id)->get(); 
    if (!$product) {
        return redirect()->route('product.index')->with('error', 'Product not found');
    }

    return view('product', compact('product'));
}

public function index(){
    return view('product.index');
}

public function destroy($id)
{
    // Fetch the item by id
    $item = Item::findOrFail($id);

    // Check if the currently logged-in user is the owner
    if ($item->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to delete this item.');
    }

    // Delete the item
    $item->delete();

    return redirect()->back()->with('success', 'Item deleted successfully.');
}
}
    

