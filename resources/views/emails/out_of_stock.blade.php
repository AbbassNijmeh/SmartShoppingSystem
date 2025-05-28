<!DOCTYPE html>
<html>

<head>
    <title>Product Out of Stock</title>
</head>

<body>
    <h1>Product Out of Stock</h1>
    <p>The following product is out of stock:</p>
    <ul>
        <li><strong>Product Name:</strong> {{ $product->name }}</li>
        <li><strong>Product ID:</strong> {{ $product->id }}</li>
    </ul>
</body>

</html>
