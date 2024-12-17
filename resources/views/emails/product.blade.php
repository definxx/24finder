<!-- resources/views/emails/product-notification.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>24Finder - New Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-orange-600 p-4 text-white">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold">
                <a href="https://24finder.ng">24Finder</a>
            </h1>
        </div>
    </nav>

    <!-- Listings -->
    <main class="flex-grow max-w-6xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="carousel relative w-full overflow-hidden rounded-lg mb-4">
                    <div class="carousel-inner">
                     
                            <div class="carousel-item">
                                <img src="{{ $imagePath }}"
                                     alt="Product Image"
                                     class="w-full h-48 object-cover" />
                            </div>
                     
                    </div>
                </div>
        
                <h3 class="text-xl font-bold text-gray-700">
                    {{ $item->title }}
                </h3>
                <p class="text-gray-500 mb-2">
                    <i class="fas fa-map-marker-alt text-orange-600"></i>
                    {{ $item->category }}
                </p>
                <p class="text-gray-700 font-semibold mb-2">
                    {{ $item->description }}
                </p>
                <p class="text-gray-600 mb-4">
                    {{ $item->condition }}
                </p>
                <p class="text-gray-600 mb-4">
                    &#8358;{{ number_format($item->price, 2) }}
                </p>
                <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                    <a href="{{ url('24finder.ng/product.show', $item->id) }}">
                        <i class="fas fa-info-circle"></i> View Details
                    </a>
                </button>
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
