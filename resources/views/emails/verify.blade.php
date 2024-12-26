<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Verification</title>
    <style>
        /* Tailwind CSS is not directly available in emails, so we'll need to include inline styles */
        .btn {
            background-color: #F97316;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #ea580c;
        }
    </style>
</head>
<body style="background-color: #f3f4f6; font-family: Arial, sans-serif; color: #333; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 24px; font-weight: bold; color: #F97316; text-align: center; margin-bottom: 20px;">
            Verify Your Email Address
        </h1>

        <p style="font-size: 16px; line-height: 1.5; color: #555;">
            Hello {{ $userName }},
        </p>
        <p style="font-size: 16px; line-height: 1.5; color: #555;">
            Thank you for registering with us! To complete your registration, please verify your email address by clicking the button below.
        </p>

        <p style="text-align: center; margin-top: 20px;">
            <a href="{{ $verificationUrl }}" class="btn">
                Verify Email Address
            </a>
        </p>

        <p style="font-size: 16px; line-height: 1.5; color: #555; margin-top: 30px;">
            If you did not create an account with us, please ignore this email.
        </p>

        <p style="font-size: 16px; line-height: 1.5; color: #555;">
            Best regards,<br>
            The 24Finder Team
        </p>
    </div>

</body>
</html>
