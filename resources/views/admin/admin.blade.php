
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin process</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        />
    </head>

    <body class="bg-gray-50 flex flex-col min-h-screen">
        <!-- Navbar -->
        <nav class="bg-orange-600 p-4 text-white">
            <div class="flex justify-between items-center max-w-6xl mx-auto">
                <h1 class="text-2xl font-bold">Admin process</h1>
                <ul class="flex space-x-6">
                    <li><a href="{{route('home')}}" class="hover:underline">Home</a></li>
                    <li><a href="{{route('compliant.view')}}" class="hover:underline">compliant</a></li>
                    <li>  <form action="{{ route('logout') }}" method="POST">
                        @csrf <!-- CSRF token for security -->
                        <button type="submit" class="bg-red-500 text-white p-2 rounded-lg">Logout</button>
                    </form></li>
                    
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow max-w-6xl mx-auto p-6">
            <h2 class="text-3xl font-bold text-gray-700 mb-6">
                process Overview
            </h2>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Users Card -->
                

                <!-- Rooms Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-orange-100 p-4 rounded-full">
                            <i
                            class="fas fa-users text-orange-600 text-2xl"
                        ></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-800">
                                Total users
                            </h3>
                            <p class="text-gray-500">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Bookings Card -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-orange-100 p-4 rounded-full">
                            <i class="fas fa-book text-orange-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-800">
                                Total item
                            </h3>
                            <p class="text-gray-500">{{ $totalItems }}</p>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Management Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Users Management -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">
                        Manage Users
                    </h3>
                    <ul class="space-y-3">
                        <ul>
                            @forelse ($users as $user)
                            <li class="flex justify-between items-center">
                                <span>{{ $user->name }}  - Items Posted: {{ $user->items_count }} - points {{$user->points}}</span>
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:underline">
                                        Edit
                                    </button>
                                    <button class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </div>
                            </li>
                            @empty
                            <li>No users found.</li>
                            @endforelse
                        </ul>
                        
                        
                      
                        <!-- Add more users as needed -->
                    </ul>
                </div>

          
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white p-4">
            <div class="text-center">
                &copy; 2024 24Finder. All rights reserved.
            </div>
        </footer>
    </body>
</html>
