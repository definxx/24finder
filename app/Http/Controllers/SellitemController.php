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
          'price' => 'required|numeric|min:0|max:1000000000', // Max price set to 1 billion
          'images' => 'required|array|min:1|max:6',
          'images.*' => 'mimes:jpg,jpeg,png,webp|max:4240', // Add 'webp' to allowed image formats
      ], [
          'price.max' => 'The price is too high. Please enter a realistic value.',
          'images.*.max' => 'One or more images exceed the maximum size limit of 4MB.',
          'images.*.mimes' => 'Only JPG, JPEG, PNG, and WEBP images are allowed.', // Update error message
      ]);
  
      if ($validator->fails()) {
          if ($request->ajax()) {
              return response()->json(['errors' => $validator->errors()], 422);
          }
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
  
      if ($request->ajax()) {
          return response()->json(['success' => 'Item posted successfully!'], 200);
      }
  
      return redirect()->route('sell_item')->with('success', 'Item posted successfully!');
  }
  
  
  
}
