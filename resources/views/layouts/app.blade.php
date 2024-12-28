<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '24Finder.ng') }}  | Your One-Stop Shop for Electronics, Gadgets, and More</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <meta name="description" content="Find the best electronics and POS machines on 24finder.ng. Affordable prices and fast delivery.">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
        
            <!-- Title -->
            
        
            <!-- Meta Description -->
            <meta name="description" content="24Finder.ng is your ultimate one-stop shop for electronics, gadgets, home appliances, fashion, and more. Affordable prices and fast delivery across Nigeria. Shop online today!">
        
            <!-- Keywords -->
            <meta name="keywords" content="buy electronics Nigeria, online shopping Nigeria, affordable gadgets, home appliances Nigeria, POS machines, fashion items Nigeria, 24Finder, best online store Nigeria">
        
            <!-- Author -->
            <meta name="author" content="24Finder Team">
        
            <!-- Open Graph Meta Tags (For Social Media Sharing) -->
            <meta property="og:title" content="24Finder.ng | Shop Electronics, Gadgets, and More Online">
            <meta property="og:description" content="Shop top-quality electronics, gadgets, home appliances, fashion, and more at unbeatable prices on 24Finder.ng. Fast nationwide delivery!">
            <meta property="og:image" content="https://24finder.ng/images/24finder-banner.png"> <!-- Replace with your actual banner image -->
            <meta property="og:url" content="https://24finder.ng">
            <meta property="og:type" content="website">
        
            <!-- Twitter Card Meta Tags -->
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:title" content="24Finder.ng | Shop Electronics, Gadgets, and More Online">
            <meta name="twitter:description" content="Discover electronics, gadgets, home appliances, fashion, and more on 24Finder.ng. Affordable prices and fast delivery across Nigeria.">
            <meta name="twitter:image" content="https://24finder.ng/images/24finder-banner.png"> <!-- Replace with your banner/logo -->
        
            <!-- Canonical Tag -->
            <link rel="canonical" href="https://24finder.ng">
        
            <!-- Favicon -->
            <link rel="icon" href="/favicon.ico" type="image/x-icon">
        
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
            <!-- Structured Data (Schema.org) for SEO -->
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "name": "24Finder.ng",
                "url": "https://24finder.ng",
                "description": "24Finder.ng is your ultimate one-stop shop for electronics, gadgets, home appliances, fashion, and more. Affordable prices and fast delivery across Nigeria.",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": "https://24finder.ng/search?q={search_term_string}",
                    "query-input": "required name=search_term_string"
                }
            }
            </script>
      
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <x-footer />
        @stack('modals')

        @livewireScripts
    </body>
</html>
