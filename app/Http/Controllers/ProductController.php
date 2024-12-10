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
    try {
        $userId  = Auth::user()->id;
        $item = Item::findOrFail($id);
        if ($item->user_id !== $userId) {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this item.']);
        }
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('Error deleting item:',$e->getMessage());

        return redirect()->back()->withErrors(['error' => 'Failed to delete the item. Please try again later.']);
    }
}

}
    

