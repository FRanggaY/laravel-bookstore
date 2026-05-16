<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('book')->get();
        $total = $cartItems->sum(function($item) {
            return $item->book->price * $item->quantity;
        });
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Book out of stock.');
        }

        $cartItem = Cart::where('user_id', Auth::id())->where('book_id', $bookId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Book added to cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        
        if ($cartItem->book->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
