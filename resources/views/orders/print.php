<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Print - {{ $order->unique_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .order-info { margin-bottom: 20px; }
        .order-details { border: 1px solid #ddd; padding: 15px; }
        .row { display: flex; justify-content: space-between; margin: 10px 0; }
        .label { font-weight: bold; }
        .total { font-size: 18px; font-weight: bold; color: #2563eb; }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Afghan Toiler</h1>
        <h2>Customer Order</h2>
    </div>

    <div class="order-info">
        <div class="row">
            <span class="label">Order ID:</span>
            <span>{{ $order->unique_id }}</span>
        </div>
        <div class="row">
            <span class="label">Customer:</span>
            <span>{{ $order->customer->name }}</span>
        </div>
        <div class="row">
            <span class="label">Phone:</span>
            <span>{{ $order->customer->phone_number }}</span>
        </div>
        <div class="row">
            <span class="label">Order Date:</span>
            <span>{{ $order->created_at->format('M d, Y') }}</span>
        </div>
    </div>

    <div class="order-details">
        <h3>Order Details</h3>
        <div class="row">
            <span class="label">Item:</span>
            <span>{{ $order->order_item }}</span>
        </div>
        <div class="row">
            <span class="label">Quantity:</span>
            <span>{{ $order->quantity }}</span>
        </div>
        <div class="row">
            <span class="label">Price:</span>
            <span>؋{{ number_format($order->price, 2) }}</span>
        </div>
        <div class="row">
            <span class="label">Clothes Price:</span>
            <span>؋{{ number_format($order->clothes_price, 2) }}</span>
        </div>
        <div class="row total">
            <span class="label">Total Amount:</span>
            <span>؋{{ number_format($order->price + $order->clothes_price, 2) }}</span>
        </div>
        <div class="row">
            <span class="label">Paid Amount:</span>
            <span>؋{{ number_format($order->paid_amount, 2) }}</span>
        </div>
        <div class="row">
            <span class="label">Status:</span>
            <span>{{ ucfirst(str_replace('_', ' ', $order->delivery_status)) }}</span>
        </div>
        <div class="row">
            <span class="label">Finish Date:</span>
            <span>{{ $order->finish_date->format('M d, Y') }}</span>
        </div>
        @if($order->notes)
        <div class="row">
            <span class="label">Notes:</span>
            <span>{{ $order->notes }}</span>
        </div>
        @endif
    </div>

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Order</button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #6b7280; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Close</button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>