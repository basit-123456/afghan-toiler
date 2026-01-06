<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomerOrder extends Model
{
    protected $fillable = [
        'unique_id', 'customer_id', 'order_item', 'quantity', 
        'price', 'clothes_price', 'paid_amount', 'delivery_status', 
        'finish_date', 'notes'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'clothes_price' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'finish_date' => 'date'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            if (!$order->unique_id) {
                $order->unique_id = strtoupper(Str::random(6));
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getTotalSpentAttribute()
    {
        return $this->price + $this->clothes_price;
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getRemainingBalanceAttribute()
    {
        return $this->total_spent - $this->total_paid;
    }
}
