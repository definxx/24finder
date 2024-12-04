<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SellitemController extends Controller
{
  public function index(){
    return view('components.sellitem');
  }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'condition' => 'required|string|in:New,Lightly Used,Heavily Used',
            'price' => 'required|numeric|min:0',
            'images' => 'required|array|min:1|max:6',
            'images.*' => 'mimes:jpg,jpeg,png|max:10240', 
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $item = new Item();
        $item->title = $request->title;
        $item->category = $request->category;
        $item->description = $request->description;
        $item->condition = $request->condition;
        $item->price = $request->price;
        $item->user_id = Auth::user()->id;
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('items', 'public');
            }
            $item->images = json_encode($images);
        }
        $item->save();
        return redirect()->route('sell_item')->with('success', 'Item posted successfully!');
    }

}
