<!DOCTYPE html>
<html>

<head>
    <title>Order Status Update</title>
</head>

<body>
    <p>Dear Customer</p>
    <p>We are pleased to inform you that your order #{{ $order->id }} is {{ $order->status }}
    </p>
    <p>Order Details:</p>
    <p>Order Number: {{ $order->id }}</p>
    <p>Total Price: $ {{ number_format($order->total_price,0) }}</p>
    <p>Order Date: {{ $order->created_at }}</p>
    <p>Thank you for shopping with us!</p>
</body>

</html>
