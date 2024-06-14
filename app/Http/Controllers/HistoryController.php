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
            $order = Order::where('number', $orderId)->where('payment_status', 2)->first();
        }

        return view('pages.history.index', compact('order'));
    }
}
