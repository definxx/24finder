<!-- resources/views/emails/item_commented.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Item Has Been Commented On</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        blockquote {
            font-style: italic;
            color: #555;
            background: #f9f9f9;
            padding: 10px;
            border-left: 4px solid #4CAF50;
            margin: 10px 0;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        .cta-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Hello, {{ $item->user->name }}</h1>
    
    <p>Your item titled "<strong>{{ $item->title }}</strong>" has received a new comment from <strong>{{ $user->name }}</strong>.</p>
    
    <p><strong>Comment:</strong></p>
    <blockquote>
        "{{ $comment->comment }}"
    </blockquote>

    <p>To view the comment and engage with the user, please log in to your account:</p>

    <p><a href="{{ route('login') }}" class="cta-button">Log In Now</a></p>

    <p>Thank you for using our platform!</p>
</body>
</html>
