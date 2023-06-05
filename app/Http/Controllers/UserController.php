<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class UserController extends Controller
{
    public function transaksi(Request $request)
    {
        $order = Order::where('user_id', auth()->user()->id)->first();
        
        return 'Masih dalam pengembangan';
    }
}
