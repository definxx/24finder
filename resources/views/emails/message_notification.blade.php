<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Message</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <h1 style="color: #333333;">Hello, {{ $recipientName }}!</h1>
        <p style="color: #555555; line-height: 1.6;">
            You have received a new message. Here is the content:
        </p>
        <blockquote style="background-color: #f8f8f8; padding: 10px; border-left: 4px solid #ff9800; color: #333;">
            {{ $messageContent }}
        </blockquote>
        <p style="color: #555555; line-height: 1.6;">
            You can log in to your account to view and respond to the message.
        </p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="24finder.ng/inbox"
               style="background-color: #ff9800; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-weight: bold;">View Inbox</a>
        </div>
    </div>
</body>
</html>
