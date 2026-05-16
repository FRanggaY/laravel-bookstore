<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use App\Models\Contact;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'categories' => Category::count(),
            'books' => Book::count(),
            'orders' => Order::count(),
            'users' => User::where('role', 'user')->count(),
            'total_revenue' => Order::where('status', 'confirmed')->orWhere('status', 'delivered')->sum('total_price'),
            'pending_messages' => Contact::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
