<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
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

    
}
