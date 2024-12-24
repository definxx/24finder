<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Comment on an Item</title>
</head>
<body>
    <h1>Hello,</h1>
    <p>We wanted to let you know that the item titled "<strong>{{ $item->title }}</strong>" has received a new comment.</p>
    
    <p><strong>Comment:</strong></p>
    <blockquote>
        "{{ $comment->comment }}"
    </blockquote>

    <p>To view the comment and engage with the user, please log in to your account.</p>

    <p>Thank you for using our platform!</p>
</body>
</html>
