<!-- resources/views/emails/item_commented.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Item Has Been Commented On</title>
</head>
<body>
    <h1>Hello, {{ $item->user->name }}</h1>
    <p>Your item titled "<strong>{{ $item->title }}</strong>" has received a new comment from {{ $user->name }}.</p>
    
    <p><strong>Comment:</strong></p>
    <blockquote>
        "{{ $comment->comment }}"
    </blockquote>

    <p>To view the comment and engage with the user, please log in to your account.</p>

    <p>Thank you for using our platform!</p>
</body>
</html>
