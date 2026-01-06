<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;

class OrderPrintController extends Controller
{
    public function print(CustomerOrder $order)
    {
        return view('orders.print', compact('order'));
    }
}