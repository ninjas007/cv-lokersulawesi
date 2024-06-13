<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $orderId = $request->order_id;
        $order = null;
        if ($orderId) {
            $order = Order::where('number', $orderId)->first();
        }

        return view('pages.history.index', compact('order'));
    }
}
