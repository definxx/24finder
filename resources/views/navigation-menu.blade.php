<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Meta Tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
        <!-- SEO Meta Tags -->
        <meta name="description" content="24Finder is your go-to platform for buying, selling, and swapping items. Find the best deals on electronics, furniture, clothing, and more!" />
        <meta name="keywords" content="buy, sell, swap, items, electronics, furniture, clothing, trade, 24Finder, second-hand, marketplace" />
        <meta name="author" content="24Finder Team" />
    
        <!-- Open Graph Tags (For Social Media Sharing) -->
        <meta property="og:title" content="24Finder - Buy, Sell & Swap Items" />
        <meta property="og:description" content="24Finder is a marketplace where you can buy, sell, or swap items with others. Join today to start trading and finding great deals!" />
        <meta property="og:image" content="https://example.com/path/to/your/image.jpg" />
        <meta property="og:url" content="https://www.24finder.com" />
        <meta property="og:type" content="website" />
    
        <!-- Twitter Card Data (For Twitter Sharing) -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="24Finder - Buy, Sell & Swap Items" />
        <meta name="twitter:description" content="24Finder is a marketplace where you can buy, sell, or swap items with others. Join today to start trading and finding great deals!" />
        <meta name="twitter:image" content="https://example.com/path/to/your/image.jpg" />
    
        <!-- Favicon -->
        <link rel="icon" href="https://example.com/favicon.ico" />
    
        <!-- External CSS and Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
        <!-- Custom Script for Menu Toggle -->
        <script>
            function toggleMenu() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            }
        </script>
    </head>
    

    <body class="bg-gray-50 flex flex-col min-h-screen">
        <!-- Navbar -->
        <nav class="bg-orange-600 p-4 text-white">
            <div class="flex justify-between items-center max-w-6xl mx-auto">
                <a href="/">
                    <img src="{{ asset('logo.jpg') }}" alt="24finder" width="50" height="50">
                
                </a>
                <a href="/">
                    <h1 class="text-2xl font-bold">24Finder</h1>
                
                </a>
               
                <!-- Hamburger Menu for Small Screens -->
                <button
                    class="md:hidden text-2xl"
                    onclick="toggleMenu()"
                >
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Desktop Menu -->
                @if (Route::has('login'))
                <ul class="hidden md:flex space-x-6">
                    @auth
                    <li><a  href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('profile') }}" :active="request()->routeIs('profile')" class="hover:underline">Profile</a></li>
                    <li><a href="{{ route('inbox') }}" :active="request()->routeIs('inbox')" class="hover:underline">Inbox</a></li>
                    <li><a href="{{ route('swap') }}" :active="request()->routeIs('swap')" class="hover:underline">Swap</a></li>
                    <li><a href="{{ route('swap_request') }}" :active="request()->routeIs('swap_request')" class="hover:underline">Swap Request</a></li>
                    <li><a href="{{ route('sell_item') }}" :active="request()->routeIs('sell_item')" class="hover:underline">Sell Item</a></li>
                    <li><a href="{{ route('sawp_item') }}" :active="request()->routeIs('sawp_item')" class="hover:underline">Swap Item</a></li>
                    <li><a href="{{ route('my_order') }}" :active="request()->routeIs('my_order')" class="hover:underline">My Order</a></li>
                    <li><a href="{{ route('compliant') }}" :active="request()->routeIs('compliant')" class="hover:underline">Compliant</a></li>
                    @else
                    <li><a href="{{ route('compliant') }}" :active="request()->routeIs('compliant')" class="hover:underline">Compliant</a></li>
                    <li><a href="{{ route('login') }}" :active="request()->routeIs('login')" class="hover:underline">Login</a></li>
                    <li><a href="{{ route('register') }}" :active="request()->routeIs('register')" class="hover:underline">Register</a></li>
                    @endauth
                </ul>
             
                @endif
            </div>
            <!-- Mobile Menu -->
         
            @if (Route::has('login'))
            <ul  id="mobile-menu"
            class="hidden flex-col space-y-2 mt-4 md:hidden bg-orange-700 p-4 rounded">
                @auth
                <li><a  href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="hover:underline">Home</a></li>
                <li><a href="{{ route('profile') }}" :active="request()->routeIs('profile')" class="hover:underline">Profile</a></li>
                <li><a href="{{ route('inbox') }}" :active="request()->routeIs('inbox')" class="hover:underline">Inbox</a></li>
                <li><a href="{{ route('swap') }}" :active="request()->routeIs('swap')" class="hover:underline">Swap</a></li>
                <li><a href="{{ route('swap_request') }}" :active="request()->routeIs('swap_request')" class="hover:underline">Swap Request</a></li>
                <li><a href="{{ route('sell_item') }}" :active="request()->routeIs('sell_item')" class="hover:underline">Sell Item</a></li>
                <li><a href="{{ route('sawp_item') }}" :active="request()->routeIs('sawp_item')" class="hover:underline">Swap Item</a></li>
                <li><a href="{{ route('my_order') }}" :active="request()->routeIs('my_order')" class="hover:underline">My Order</a></li>
                <li><a href="{{ route('compliant') }}" :active="request()->routeIs('compliant')" class="hover:underline">Compliant</a></li>
                @else
                <li><a href="{{ route('compliant') }}" :active="request()->routeIs('compliant')" class="hover:underline">Compliant</a></li>
                <li><a href="{{ route('login') }}" :active="request()->routeIs('login')" class="hover:underline">Login</a></li>
                <li><a href="{{ route('register') }}" :active="request()->routeIs('register')" class="hover:underline">Register</a></li>
                @endauth
            </ul>
         
            @endif
        </nav>

    
    </body>
</html>
