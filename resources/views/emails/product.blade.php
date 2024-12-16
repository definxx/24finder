<!DOCTYPE html>
<html>
<head>
    <title>Product Notification</title>
</head>
<body>
    <h1>New Product Available</h1>
    <p><strong>Title:</strong> {{ $item->title }}</p>
    <p><strong>Category:</strong> {{ $item->category }}</p>
    <p><strong>Description:</strong> {{ $item->description }}</p>
    <p><strong>Price:</strong> &#8358;{{ number_format($item->price, 2) }}</p>
    <p>
        <strong>Image:</strong><br>
        <img src="{{ $imagePath }}" alt="Product Image" style="max-width: 400px;">
    </p>
</body>
</html>
