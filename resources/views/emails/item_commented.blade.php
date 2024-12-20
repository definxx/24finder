<!DOCTYPE html>
<html lang="en">

<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>item titled "<strong>{{ $item->title }}</strong>" has received a new comment from {{ $user->name }}.</p>
    
    <p><strong>Comment:</strong></p>
    <blockquote>
        "{{ $comment->comment }}"
    </blockquote>

    <p>To view the comment and engage with the user, please log in to your account.</p>

    <p>Thank you for using our platform!</p>
</body>
</html>
