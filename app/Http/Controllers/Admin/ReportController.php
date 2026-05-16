<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        $books = Book::withCount(['orders' => function($query) {
            $query->where('status', 'confirmed')->orWhere('status', 'delivered');
        }])->withSum(['orders' => function($query) {
            $query->where('status', 'confirmed')->orWhere('status', 'delivered');
        }], 'total_price')->get();

        $total_revenue = Order::where('status', 'confirmed')->orWhere('status', 'delivered')->sum('total_price');
        $total_orders = Order::where('status', 'confirmed')->orWhere('status', 'delivered')->count();

        return view('admin.reports.index', compact('books', 'total_revenue', 'total_orders'));
    }
}
