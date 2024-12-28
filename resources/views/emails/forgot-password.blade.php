<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        /* Tailwind CSS styles inline */
        .text-center { text-align: center; }
        .text-blue-500 { color: #3b82f6; }
        .font-bold { font-weight: 700; }
        .font-medium { font-weight: 500; }
        .text-lg { font-size: 1.125rem; }
        .bg-blue-500 { background-color: #3b82f6; }
        .bg-gray-100 { background-color: #f3f4f6; }
        .rounded { border-radius: 0.375rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .max-w-md { max-width: 28rem; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .text-white { color: #fff; }
        .shadow-lg { box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); }
        .underline { text-decoration: underline; }
        .mt-4 { margin-top: 1rem; }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-md mx-auto bg-white rounded shadow-lg p-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Hello, {{ $user->name }}</h1>
            <p class="text-lg text-gray-700 mb-4">You requested a password reset. Click the button below to reset your password:</p>
            
            <!-- Reset link -->
            <a href="{{ $resetLink }}" 
               class="bg-blue-500 text-white font-medium text-lg py-2 px-6 rounded shadow-lg hover:bg-blue-600 transition duration-200">
               Reset Password
            </a>

            <p class="text-sm text-gray-600 mt-4">
                If you did not request this, please ignore this email.
            </p>
        </div>
    </div>
</body>
</html>
