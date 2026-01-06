<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt - {{ $order->unique_id }}</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.2;
            margin: 0;
            padding: 5mm;
            width: 70mm;
            color: #000;
        }
        .center { text-align: center; }
        .bold { font-weight: bold; }
        .large { font-size: 14px; }
        .separator {
            border-top: 1px dashed #000;
            margin: 8px 0;
            padding-top: 8px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }
        .item-row {
            margin: 4px 0;
        }
        .total-row {
            font-weight: bold;
            font-size: 13px;
            border-top: 1px solid #000;
            padding-top: 4px;
            margin-top: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
        }
        @media print {
            body { margin: 0; padding: 2mm; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="center bold large">AFGHAN TOILER</div>
    <div class="center">Customer Order Receipt</div>
    
    <div class="separator">
        <div class="row">
            <span>Order ID:</span>
            <span class="bold">{{ $order->unique_id }}</span>
        </div>
        <div class="row">
            <span>Date:</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="separator">
        <div class="bold">CUSTOMER INFO:</div>
        <div>{{ $order->customer->name }}</div>
        <div>{{ $order->customer->phone_number }}</div>
    </div>

    <div class="separator">
        <div class="bold">ORDER DETAILS:</div>
        <div class="item-row">
            <div class="row">
                <span>{{ $order->order_item }}</span>
                <span>x{{ $order->quantity }}</span>
            </div>
            <div class="row">
                <span>Price:</span>
                <span>؋{{ number_format($order->price, 2) }}</span>
            </div>
            <div class="row">
                <span>Clothes:</span>
                <span>؋{{ number_format($order->clothes_price, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="separator">
        <div class="row total-row">
            <span>TOTAL:</span>
            <span>؋{{ number_format($order->price + $order->clothes_price, 2) }}</span>
        </div>
        <div class="row">
            <span>PAID:</span>
            <span>؋{{ number_format($order->paid_amount, 2) }}</span>
        </div>
        <div class="row">
            <span>BALANCE:</span>
            <span>؋{{ number_format(($order->price + $order->clothes_price) - $order->paid_amount, 2) }}</span>
        </div>
    </div>

    <div class="separator">
        <div class="row">
            <span>Status:</span>
            <span class="bold">{{ strtoupper(str_replace('_', ' ', $order->delivery_status)) }}</span>
        </div>
        <div class="row">
            <span>Finish Date:</span>
            <span>{{ $order->finish_date->format('d/m/Y') }}</span>
        </div>
    </div>

    @if($order->notes)
    <div class="separator">
        <div class="bold">NOTES:</div>
        <div>{{ $order->notes }}</div>
    </div>
    @endif

    <div class="footer">
        <div>Thank you for your business!</div>
        <div>{{ now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <div class="no-print" style="margin-top: 15px; text-align: center;">
        <button onclick="window.print()" style="padding: 8px 15px; background: #000; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 11px;">PRINT RECEIPT</button>
        <button onclick="window.close()" style="padding: 8px 15px; background: #666; color: white; border: none; border-radius: 3px; cursor: pointer; margin-left: 8px; font-size: 11px;">CLOSE</button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>