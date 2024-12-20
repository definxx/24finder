<!-- resources/views/emails/new_comment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Comment</title>
</head>
<body>
    <h1>New Comment Posted</h1>
    <p>A new comment has been posted on an item you might be interested in:</p>
    <p><strong>Comment:</strong> {{ $comment->comment }}</p>
    <p><a href="https://24finder.ng/products/{{ $comment->item_id }}">View Item</a></p>
</body>
</html>
