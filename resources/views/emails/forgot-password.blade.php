<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>You requested a password reset. Click the link below to reset your password:</p>
    <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
