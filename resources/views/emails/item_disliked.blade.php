<!-- resources/views/emails/item_disliked.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Item Has Been Disliked</title>
</head>
<body>
    <h1>Hello, {{ $item->user->name }}</h1>
    <p>We wanted to inform you that your item titled "<strong>{{ $item->title }}</strong>" has been disliked by {{ $user->name }}.</p>
    
    <p>If you'd like to respond or take further action, please log in to your account to view more details.</p>

    <p>Thank you for using our platform!</p>
</body>
</html>
