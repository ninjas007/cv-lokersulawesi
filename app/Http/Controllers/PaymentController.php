<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pembayaran(Request $request)
    {
        $orderId = $request->order_id;
        $snapToken = $request->snap_token;
        $order = Order::where(['number' => $orderId, 'snap_token' => $snapToken])->first();
        $templates = [
            [
                'id' => 1,
                'image' => "assets/images/templates/template-1.jpg",
                'nama' => 'Template 1'
            ],
            [
                'id' => 2,
                'image' => "assets/images/templates/template-2.jpg",
                'nama' => 'Template 2'
            ]
        ];

        if ($order) {
            return view('menus.order.midtrans', compact('order', 'snapToken', 'templates'));
        }
    }
}
