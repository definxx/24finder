<?php

namespace App\Http\Controllers;

use App\Models\Swap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SwapController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = null;

        if ($request->hasFile('images')) {
            $images = array_map(function ($file) {
                return $file->store('swaps', 'public'); // Store in 'storage/app/public/swaps'
            }, $request->file('images'));
        }

        Swap::create([
            'item_id' => $request->item_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'images' => $images ? json_encode($images) : null,
        ]);

        return redirect()->back()->with('success', 'Swap request submitted successfully.');
    }

    public function destroy($id)
{
    $swap = Swap::findOrFail($id);
    $swap->delete();

    return redirect()->back()->with('success', 'Swap submitted successfully.');
}
}
