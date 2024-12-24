<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    CompliantController,
    ProfileController,
    SwapController,
    OrderController,
    ProductController,
    ItemController,
    SellitemController,
    SwapitemController,
    ListingController,
    SwapRequestController,
    MessageController,
    SearchController,
    UserActivityController,
    EmailController,
    DashboardController
};

use App\Http\Controllers\UserController;



use App\Models\{
    User,
    Item
};
use App\Models\Category;
use Illuminate\Support\Facades\Auth;



Route::get('/send-email', [EmailController::class, 'sendWelcomeEmail']);
Route::get('/send-product-emails', [ItemController::class, 'sendProductEmails']);
Route::post('/search', [SearchController::class, 'index'])->name('search');

Route::get('/', [DashboardController::class, 'showWelcome'])->name('home');

Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
Route::post('compliant.store', [CompliantController::class, 'store'])->name('compliant.store');
Route::get('compliant', [CompliantController::class, 'compliant'])->name('compliant');
Route::get('/terms', function () { 
    return view('terms');
})->name('terms');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::post('/item/like/{id}', [ItemController::class, 'like'])->name('item.like');
    Route::post('/item/dislike/{id}', [ItemController::class, 'dislike'])->name('item.dislike');
    Route::post('/item/comment/{id}', [ItemController::class, 'comment'])->name('item.comment');
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::post('/profile/update', [ProfileController::class, 'updateProfilePicture'])->name('profile.update');
Route::post('/user/activity', [UserActivityController::class, 'logActivity']);
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/message', [MessageController::class, 'index'])->name('message');
Route::get('/swap', [SwapRequestController::class, 'index'])->name('swap');
Route::get('/swap-request', [SwapRequestController::class, 'swap_request'])->name('swap_request');
Route::get('/listing', [ListingController::class, 'index'])->name('listing');
Route::get('/sell_item', [SellitemController::class, 'index'])->name('sell_item');
Route::post('/store_items', [SellitemController::class, 'store'])->name('items.store');
Route::put('/swap-requests/{swapRequest}', [SwapRequestController::class, 'update_swap_status'])->name('swap_requests.update');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::delete('/order/{id}', [OrderController::class, 'cancelOrder'])->name('order.cancel');
Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
Route::get('/message/{user_id}', [MessageController::class, 'create'])->name('message.create');
Route::post('/messages/send/{user_id}', [MessageController::class, 'send'])->name('message.send');
Route::get('/my_order', [OrderController::class, 'my_order'])->name('my_order');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/sawp_item', [SwapitemController::class, 'index'])->name('sawp_item');
Route::post('/create_sawp_item', [SwapitemController::class, 'store'])->name('create.sawp.item');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::get('/my-listings', [ItemController::class, 'index'])->name('items.index');
Route::get('/productview/{id}', [ProductController::class, 'show'])->name('product.view');
Route::delete('/swap/{id}', [SwapRequestController::class, 'destroy'])->name('swap.destroy');
Route::get('/user/profile/{id}', [UserController::class, 'show'])->name('user.profile');
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
Route::get('/chat/{user_id}', [MessageController::class, 'create'])->name('chat.create');
Route::post('/chat/{user_id}/send', [MessageController::class, 'send'])->name('chat.send');
Route::post('/swap', [SwapController::class, 'store'])->name('swap.store');
Route::get('/send-product-emails', [ItemController::class, 'sendProductEmails']);
});
