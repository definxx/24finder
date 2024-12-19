<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Item Has Been Liked</title>
</head>
<body>
    <h1>Hello, {{ $item->user->name }}</h1>
    <p>Your item "{{ $item->title }}" has been liked by {{ $user->name }}.</p>
</body>
</html>
