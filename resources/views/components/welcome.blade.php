<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Property Listings - Startup</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="description" content="Find the best electronics and POS machines on 24finder.ng. Affordable prices and fast delivery.">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    </head>

    <body class="bg-gray-50 flex flex-col min-h-screen">
        <!-- Navbar -->

        <!-- Listings -->
        <main class="flex-grow max-w-6xl mx-auto p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            
                @php
                $combinedItems = $saleItems->merge($swapItems);
            @endphp
          @foreach($combinedItems as $item)
          <div class="bg-white p-4 rounded-lg shadow-lg">
              <div class="carousel relative w-full overflow-hidden rounded-lg mb-4">
                  <div class="carousel-inner">
                      @foreach(json_decode($item->images) as $image)
                          <div class="carousel-item">
                              <img src="{{ asset('storage/app/public/' . $image) }}" alt="Property Image" class="w-full h-48 object-cover" />
                          </div>
                      @endforeach
                  </div>
                  <button class="carousel-prev absolute left-0 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded-full">
                      <i class="fas fa-chevron-left"></i>
                  </button>
                  <button class="carousel-next absolute right-0 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded-full">
                      <i class="fas fa-chevron-right"></i>
                  </button>
              </div>
      
              <!-- Property Information -->
              <h3 class="text-xl font-bold text-gray-700">{{ $item->title }}</h3>
              <p class="text-gray-500 mb-2">
                  <i class="fas fa-map-marker-alt text-orange-600"></i>
                  {{ $item->category }}
              </p>
              <p class="text-gray-700 font-semibold mb-2">&#8358;{{ number_format($item->price, 2) }}</p>
              <p class="text-gray-600 mb-4">{{ $item->description }}</p>
      
              <!-- Swap Preferences or Sell Text -->
              @if ($item->swap_preferences)
                  <p class="text-gray-600 font-bold mb-4">Swap for {{ $item->swap_preferences }}</p>
              @else
                  <p class="text-gray-600 font-bold mb-4"> For SELL</p>
              @endif
      
              <!-- Display User Name -->
              <p class="text-gray-600 mb-4">
                Posted by: 
                @if($item->user)
                    <a href="{{ route('user.profile', $item->user->id) }}" class="text-blue-500 hover:underline">{{ $item->user->name }}</a>
                @else
                    <span class="text-gray-500">Unknown User</span>
                @endif
            </p>
            
              <!-- Share Button with Share Icon -->
              <div class="flex items-center space-x-2 mb-4">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product.show', $item->id)) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                      <i class="fab fa-facebook-f"></i> Share on Facebook
                  </a>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product.show', $item->id)) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                      <i class="fab fa-twitter"></i> Share on Twitter
                  </a>
              </div>
      
              <!-- View Details Button -->
              <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                  <a href="{{ route('product.show', $item->id) }}">
                      <i class="fas fa-info-circle"></i> Buy Now
                  </a>
              </button>
          </div>  
      @endforeach
      
        
            
        </main>

        <!-- Tailwind Carousel Script -->
        <script>
            const carousels = document.querySelectorAll(".carousel");
            carousels.forEach((carousel) => {
                const items = carousel.querySelectorAll(".carousel-item");
                const prevBtn = carousel.querySelector(".carousel-prev");
                const nextBtn = carousel.querySelector(".carousel-next");
                let currentIndex = 0;

                function showItem(index) {
                    items.forEach((item, i) => {
                        item.style.display = i === index ? "block" : "none";
                    });
                }

                prevBtn.addEventListener("click", () => {
                    currentIndex = (currentIndex - 1 + items.length) % items.length;
                    showItem(currentIndex);
                });

                nextBtn.addEventListener("click", () => {
                    currentIndex = (currentIndex + 1) % items.length;
                    showItem(currentIndex);
                });

                showItem(currentIndex);
            });
        </script>
    </body>
</html>
