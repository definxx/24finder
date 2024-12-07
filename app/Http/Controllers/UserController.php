<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function show($id)
{
    // Fetch the user based on their ID
    $user = User::findOrFail($id);

    // Fetch items belonging to this user
    $items = Item::where('user_id', $user->id)->get();

    return view('user', compact('user', 'items'));
}

}
