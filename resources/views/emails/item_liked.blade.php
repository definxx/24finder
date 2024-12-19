<!-- resources/views/emails/item_liked.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Item Has Been Liked</title>
</head>
<body>
    <h1>Hello, {{ $item->user->name }}</h1>
    <p>Good news! Your item titled "<strong>{{ $item->title }}</strong>" has been liked by {{ $user->name }}.</p>

    <p>If you'd like to view the like or take any action, please log in to your account.</p>

    <p>Thank you for using our platform!</p>
</body>
</html>
