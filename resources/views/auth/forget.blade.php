<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        />
    </head>

    <body class="bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
            <p class="text-2xl font-bold text-orange-600 text-center mb-6">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </p>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="w-full px-2 py-2 focus:outline-none @error('email') border-red-500 @enderror" value="{{ old('email') }}" required />
                    </div>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
            
                <div class="mb-6">
                    <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 flex justify-center items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>    {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-gray-700">
                        Don't have an account?
                        <a href="{{route('register')}}" class="text-orange-600 hover:underline">Sign up here</a>.
                    </p>
                </div>
            </form>
        </div>
    </body>
</html>
