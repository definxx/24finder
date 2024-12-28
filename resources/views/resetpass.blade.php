<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Change Password</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        />
    </head>

    <body class="bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
           

            <!-- Validation Errors -->
            @if(session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif
    
   
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

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}"> <!-- Email hidden input -->
        
                <div>
                    <p>Email: <strong>{{ $email }}</strong></p> <!-- Display email -->
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-envelope"></i></span>
                        <input type="password" id="password" name="password" class="w-full px-2 py-2 focus:outline-none @error('password') border-red-500 @enderror" value="{{ old('password') }}" required />
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm New Password:</label>
                    <div class="flex items-center border rounded-lg focus-within:ring-2 focus-within:ring-orange-500">
                        <span class="px-3 text-gray-600"><i class="fas fa-envelope"></i></span>
                        <input type="password_confirmation" id="password_confirmation" name="password_confirmation" class="w-full px-2 py-2 focus:outline-none @error('password_confirmation') border-red-500 @enderror" value="{{ old('password_confirmation') }}" required />
                    </div>
                    @error('password_confirmation')
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
                      Go back to login?
                        <a href="{{route('home')}}" class="text-orange-600 hover:underline">Sign in</a>.
                    </p>
                </div>
            </form>
        </div>
    </body>
</html>
