<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Process</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-orange-600 p-4 text-white">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold">Admin Process</h1>
            <ul class="flex space-x-6">
                <li><a href="{{route('home')}}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('compliant.view') }}" class="hover:underline">Compliant</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white p-2 rounded-lg">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-6xl mx-auto p-6">
        <div class="space-y-6">
            <!-- Compliant Cards -->
            @foreach ($compliants as $compliant)
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Complaint #{{ $compliant->id }}</h3>
                        <p class="text-gray-600 text-sm">{{ $compliant->description }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-orange-600 font-medium text-sm flex items-center">
                            <i class="fas fa-calendar-alt mr-1"></i>{{ $compliant->created_at }}
                        </span>
                        <span class="text-gray-600 font-medium text-sm flex items-center">
                            <i class="fas fa-edit mr-1"></i>{{ $compliant->updated_at }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-gray-700 text-sm">Total Price: <span class="font-bold">$600</span></p>
                    <p class="text-green-600 text-sm font-semibold">Status: Confirmed</p>
                </div>
            </div>
            @endforeach

            <!-- No Complaints Message -->
            @if($compliants->isEmpty())
            <p class="text-center text-gray-500">No complaints found.</p>
            @endif
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
