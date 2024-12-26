<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compliant;
class CompliantController extends Controller
{
    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'description' => 'required|string|max:255',
       
    ]);


    $compliant = new Compliant();
    $compliant->description = $request->input('description');
    $compliant->save();
    return view('success');
}

public function compliant(){
    return view('compliant');
}

public function view(){
    $compliants = Compliant::all();
    return view('admin.compliant_view', compact('compliants'));
}
}