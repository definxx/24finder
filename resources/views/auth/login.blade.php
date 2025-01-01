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
            <h2 class="text-2xl font-bold text-orange-600 text-center mb-6">
                Login to Your Account
            </h2>

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

            <form method="POST" action="{{ route('process.login') }}">
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

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="w-full px-2 py-2 focus:outline-none @error('password') border-red-500 @enderror" required />
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded" />
                        <label for="remember" class="ml-2 block text-gray-900">Remember me</label>
                    </div>
                    <div>
                        <a href="{{route('forget')}}" class="text-orange-600 hover:underline text-sm">Forgot password?</a>
                    </div>
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 flex justify-center items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
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