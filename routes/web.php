<?php

use App\Http\Controllers\OrderPrintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders/{order}/print', [OrderPrintController::class, 'print'])->name('orders.print');
