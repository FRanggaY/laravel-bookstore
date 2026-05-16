<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:cod,transfer',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if ($item->book->stock < $item->quantity) {
                return redirect()->back()->with('error', 'Insufficient stock for book: ' . $item->book->title);
            }

            Order::create([
                'user_id' => $user->id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
                'total_price' => $item->book->price * $item->quantity,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'order_date' => now(),
            ]);

            // Reduce stock
            $item->book->decrement('stock', $item->quantity);
        }

        // Clear cart
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('orders.history')->with('success', 'Order placed successfully.');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('book')->latest()->get();
        return view('orders.history', compact('orders'));
    }

    public function payment($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('orders.payment', compact('order'));
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        $path = $request->file('payment_proof')->store('payments', 'public');
        $order->payment_proof = $path;
        $order->status = 'pending'; // Reset status or keep as pending for admin to confirm
        $order->save();

        return redirect()->route('orders.history')->with('success', 'Payment proof uploaded successfully.');
    }
}
