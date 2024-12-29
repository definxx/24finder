<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selling something you don’t need any more on 24Finder.ng</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #7f8c8d;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        .button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #95a5a6;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <table role="presentation">
        <tr>
            <td>
                <h1>Welcome to 24Finder.ng</h1>
                <p>Dear {{ $user->name }},</p>
                <p>We are excited to have you as part of the 24Finder.ng community! <br> 24Finder.ng makes trading effortless, secure, and rewarding.</p>
                
                <p>To get started, visit our platform and explore the numerous opportunities waiting for you:</p>
                <p><a href="https://24finder.ng" class="button">Start Trading Now</a></p>

                <p>If you need assistance or have any questions, feel free to reach out to us at any time.</p>
                
                <p>Thank you for being a valued member of 24Finder.ng!</p>

                <p>Best regards,<br>
                The 24Finder.ng Team</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>You're receiving this email because you signed up for 24Finder.ng. <br>
        If you did not create an account, please ignore this email.</p>
        <p><a href="https://24finder.ng">Visit our website</a> | <a href="mailto:mail@24finder.ng">Contact support</a></p>
    </div>

</body>
</html>
