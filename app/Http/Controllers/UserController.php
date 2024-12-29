<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        $items = Item::where('user_id', $user->id)->where('status', 1)->get();
        $postCount = $items->count();
        return view('user', compact('user', 'items', 'postCount'));
    }

   
   
    
}
