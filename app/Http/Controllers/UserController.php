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

    $user = User::findOrFail($id);
    $items = Item::where('user_id', $user->id)->get();
    $postCount = $items->count();
    return view('user', compact('user', 'items','postCount'));
}

}
