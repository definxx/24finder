<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::all(); // Fetch all categories from the database
        return view('your-view-name', compact('categories'));
    }
    
}
