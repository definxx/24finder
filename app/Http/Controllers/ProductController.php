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
    
        $product = Item::where('id', $id)
        ->where('status', 1) // Correct condition for status
        ->get(); // Use `first` to get a single record


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
    $product = Item::find($id);
    $userid = Auth::user()->id;
    if ($product && $product->user_id === $userid) {
        $product->status = 0; 
        $product->save();  

        return back()->with('message', 'Product status updated successfully.');
    }
    if (!$product) {
        return back()->with('error', 'Product not found.');
    }
    return back()->with('error', 'Unauthorized action.');
}

    
    

}
    

