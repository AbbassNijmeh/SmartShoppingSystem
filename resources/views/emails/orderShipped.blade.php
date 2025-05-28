<!-- resources/views/emails/orders/shipped.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Order Shipped</title>
</head>
<body>
    <h1>Your Order Has Been Shipped!</h1>
    <h2>please use this OTP to confirm the delivery</h2>
    <p>Dear Customer,</p>
    <p>We are pleased to inform you that your order has been shipped.</p>
    <p>Your order with ID <strong>{{ $order->id }}</strong> has been shipped. Please use the following OTP to confirm delivery:</p>

    <h2 style="color: #4CAF50;">{{ $otp }}</h2>

    <p>Thank you for shopping with us!</p>
</body>
</html>
