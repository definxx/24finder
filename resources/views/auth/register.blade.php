<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    </head>

    <body class="bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-orange-600 text-center mb-6">
                Create an Account
            </h2>

            <!-- Display all validation errors -->
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">First Name</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-user"></i></span>
                        <input type="text" id="name" name="name" class="w-full px-2 py-2 focus:outline-none" required value="{{ old('name') }}" />
                    </div>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="lname" class="block text-gray-700 font-medium mb-2">Last Name</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-user"></i></span>
                        <input type="text" id="lname" name="lname" class="w-full px-2 py-2 focus:outline-none" required value="{{ old('lname') }}" />
                    </div>
                    @error('lname')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tel" class="block text-gray-700 font-medium mb-2">Tel</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-phone"></i></span>
                        <input type="text" id="tel" name="tel" class="w-full px-2 py-2 focus:outline-none" required value="{{ old('tel') }}" />
                    </div>
                    @error('tel')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="w-full px-2 py-2 focus:outline-none" required value="{{ old('email') }}" />
                    </div>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="w-full px-2 py-2 focus:outline-none" required />
                    </div>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-2 py-2 focus:outline-none" required />
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-lg font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 flex justify-center items-center">
                        <i class="fas fa-user-plus mr-2"></i> Sign Up
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-gray-700">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-orange-600 hover:underline">Login here</a>.
                    </p>
                </div>
            </form>
        </div>
    </body>
</html>
