<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\{
    User,
    Item}
    ;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class DashboardController extends Controller
{



    public function showDashboard()
    {
        // Check if the user is logged in
        if (Auth::check()) {
            $userEmail = Auth::user()->email;
            $adminEmail = "joshuadeinne@gmail.com";
    
            // Check if the logged-in user is the admin
            if ($userEmail == $adminEmail) {
                $totalUsers = User::count();
                $totalItems = Item::count();
                $users = User::withCount('items')->get();
                return view('admin.admin', compact('users', 'totalUsers', 'totalItems'));
            } else {
                // For non-admin users
                $categories = Category::all();
                $items = Item::with(['user', 'comments.user'])
                    ->where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $swapItems = $items->whereNotNull('swap_preferences');
                $saleItems = $items->whereNotNull('price');
                return view('dashboard', compact('categories', 'swapItems', 'saleItems'));
            }
        } else {
            // Handle case when the user is not logged in (optional)
            return redirect()->route('login');  // Or any other fallback
        }
    }
    
    public function showWelcome()
    {
        // Check if the user is logged in
        if (Auth::check()) {
            $userEmail = Auth::user()->email;
            $adminEmail = "joshuadeinne@gmail.com";
    
            // Check if the logged-in user is the admin
            if ($userEmail == $adminEmail) {
                $totalUsers = User::count();
                $totalItems = Item::count();
                $users = User::withCount('items')->get();
                return view('admin.admin', compact('users', 'totalUsers', 'totalItems'));
            } else {
                // For non-admin users
                $categories = Category::all();
                $items = Item::with(['user', 'comments.user'])
                    ->where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $swapItems = $items->whereNotNull('swap_preferences');
                $saleItems = $items->whereNotNull('price');
                return view('welcome', compact('categories', 'swapItems', 'saleItems'));
            }
        } else {
            // Handle case when the user is not logged in (optional)
            return redirect()->route('login');  // Or any other fallback
        }
    }
    

    public function getlogout()
    {
        return redirect()->route('logout'); // Or use the URL you want to redirect after logout
    }
    

public function logout()
{
    // Log the user out
    Auth::logout();

    // Redirect to the login page or any other page
    return redirect()->route('login'); // Or use the URL you want to redirect after logout
}

    
    
    
}
