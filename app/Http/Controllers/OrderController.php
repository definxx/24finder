<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Item,
    Order,
};
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'offer' => 'nullable|numeric|min:0',
        'item_id' => 'required|string|max:255',
        'qty' => 'required|string|max:255',
       
    ]);

    // Save the offer in the order database
    $order = new Order();
    $order->offer = $request->input('offer');
    $order->item_id = $request->input('item_id');
    $order->qty = $request->input('qty');
    $order->user_id = Auth::user()->id;
    $order->save();

    return route('my_order');
}
public function my_order() 
{
    $myorders = Order::where('user_id', Auth::user()->id)->get();

    // Fetch the items for each order
    $ordersWithItems = $myorders->map(function ($order) {
        $item = Item::find($order->item_id); // Fetch item using item_id
        return [
            'order' => $order,
            'item' => $item,
        ];
    });

    // If no orders are found, pass an empty array for ordersWithItems
    return view('my_order', [
        'ordersWithItems' => $ordersWithItems,
        'message' => $ordersWithItems->isEmpty() ? 'No orders found.' : null
    ]);
}

public function viewProduct($itemId)
{
    $item = Item::find($itemId);
    if (!$item) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    return view('product_details', compact('item'));
}

public function cancelOrder($orderId)
{
    $order = Order::find($orderId);
    if (!$order || $order->user_id != Auth::id()) {
        return redirect()->back()->with('error', 'Order not found or unauthorized.');
    }

    $order->delete();

    return redirect()->back()->with('success', 'Order canceled successfully.');
}

}
