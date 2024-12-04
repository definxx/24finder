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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'condition' => 'required|string',
            'swap_preferences' => 'required|string|max:255', 
            'images' => 'required|array|max:6', 
            'images.*' => 'mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $item = new Item();
        $item->title = $request->title;
        $item->category = $request->category;
        $item->description = $request->description;
        $item->condition = $request->condition;
        $item->swap_preferences = $request->swap_preferences;
        $item->user_id = Auth::user()->id;
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('item_images', 'public');
            }
            $item->images = json_encode($images);
        }
        $item->save();
        return redirect()->route('sawp_item')->with('success', 'Item posted successfully!');
    }

}
