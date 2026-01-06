<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $fillable = [
        'customer_order_id', 'amount', 'payment_method', 'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    public function customerOrder()
    {
        return $this->belongsTo(CustomerOrder::class);
    }
}