<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="24Finder is your go-to platform for buying, selling, and swapping items.">

    <!-- Favicon -->
    <link rel="icon" href="https://example.com/favicon.ico">

    <!-- External CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Scripts -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById("mobile-menu");
            menu.classList.toggle("hidden");
        }

        document.addEventListener("DOMContentLoaded", function () {
            let lastActivityTime = Date.now();

            function sendActivityData() {
                const currentTime = Date.now();
                const timeSpent = Math.floor((currentTime - lastActivityTime) / 1000);
                lastActivityTime = currentTime;

                fetch("/user/activity", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({ time_spent: timeSpent }),
                });
            }

            setInterval(sendActivityData, 30000);
            document.addEventListener("mousemove", sendActivityData);
        });
    </script>

    <!-- Custom Styles -->
    <style>
        .input-orange {
            color: black;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-orange-600 p-2 text-white">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <!-- Logo -->
            <a href="/">
                <img src="{{ asset('logo.jpg') }}" alt="24Finder Logo" width="50" height="50">
            </a>

            <!-- Search Form Section -->
            <div class="hidden md:block p-4">
                <form action="{{ route('search') }}" method="POST" class="flex bg-white border border-gray-200 rounded-md p-2 shadow-sm" role="search">
                    @csrf
                    <input
                        class="w-full flex-1 p-3 border border-gray-300 rounded-l-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 input-orange"
                        type="search"
                        placeholder="Search by location, price, or property type"
                        aria-label="Search">
                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-r-md focus:outline-none flex items-center">
                        <i class="fas fa-search mr-2"></i> Search
                    </button>
                </form>
            </div>

            <!-- Hamburger Button -->
            <button class="md:hidden text-2xl" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-4 text-sm">
                @if (Route::has('login'))
                    @auth
                    <li>
                        <h2 class="flex items-center text-white">
                            <i class="fas fa-wallet mr-2 text-white"></i>
                            @php
                                $userPoints = Auth::check() ? Auth::user()->points : 0;
                            @endphp
                            Your Earn: {{ $userPoints }}
                        </h2>
                    </li>
                    
                        <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
                        <li><a href="{{ route('profile') }}" class="hover:underline">Profile</a></li>
                        <li><a href="{{ route('inbox') }}" class="hover:underline">Inbox</a></li>
                        <li><a href="{{ route('swap') }}" class="hover:underline">Swap</a></li>
                        <li><a href="{{ route('swap_request') }}" class="hover:underline">Swap Request</a></li>
                        <li><a href="{{ route('sell_item') }}" class="hover:underline">Sell Item</a></li>
                        <li><a href="{{ route('sawp_item') }}" class="hover:underline">Swap Item</a></li>
                        <li><a href="{{ route('my_order') }}" class="hover:underline">My Order</a></li>
                        <li><a href="{{ route('compliant') }}" class="hover:underline">Complaints</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                    @endauth
                @endif
            </ul>
        </div>

        <!-- Mobile Menu -->
        <ul id="mobile-menu" class="hidden flex-col space-y-2 bg-orange-700 p-4 rounded mt-2">
            @if (Route::has('login'))
                @auth
                <li>
                    <h2 class="flex items-center text-white">
                        <i class="fas fa-wallet mr-2 text-white"></i>
                        @php
                            $userPoints = Auth::check() ? Auth::user()->points : 0;
                        @endphp
                        Your Earn: {{ $userPoints }}
                    </h2>
                </li>
                
                    <li><a href="{{ route('dashboard') }}" class="hover:underline text-sm">Home</a></li>
                    <li><a href="{{ route('profile') }}" class="hover:underline text-sm">Profile</a></li>
                    <li><a href="{{ route('swap') }}" class="hover:underline text-sm">Swap</a></li>
                    <li><a href="{{ route('swap_request') }}" class="hover:underline text-sm">Swap Request</a></li>
                    <li><a href="{{ route('sell_item') }}" class="hover:underline text-sm">Sell Item</a></li>
                    <li><a href="{{ route('sawp_item') }}" class="hover:underline text-sm">Swap Item</a></li>
                    <li><a href="{{ route('my_order') }}" class="hover:underline text-sm">My Order</a></li>
                    <li><a href="{{ route('compliant') }}" class="hover:underline text-sm">Complaints</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:underline text-sm">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline text-sm">Register</a></li>
                @endauth
            @endif
        </ul>
    </nav>
</body>

</html>
