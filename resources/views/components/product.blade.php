<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <title>Product Listings</title>
    </head>
    <style>
        .magnifier-container {
            position: relative;
            display: inline-block;
            cursor: zoom-in;
        }

        .magnifier-lens {
            position: absolute;
            border: 2px solid #f59e0b; /* Orange border */
            border-radius: 50%;
            cursor: none;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.4);
            pointer-events: none;
            display: none;
        }

        .magnifier-zoom {
            position: absolute;
            background-repeat: no-repeat;
            display: none;
            pointer-events: none;
        }
    </style>
    <body class="bg-gray-50 flex flex-col min-h-screen">
        <!-- Listings -->
        <main class="flex-grow max-w-full mx-auto p-12">
            <div class="grid flex-grow max-w-full mx-auto">
                @foreach($product as $item)
                
                    <!-- Carousel for Property Images -->
                    <div class="carousel relative w-full overflow-hidden rounded-lg mb-4">
                        <div class="carousel-inner">
                            @foreach(json_decode($item->images) as $image)
                            <!-- Assuming images are stored as JSON -->
                            <div class="carousel-item hidden">
                                <div class="magnifier-container">
                                    <img src="{{ asset('storage/app/public/' . $image) }}" data-large="{{ asset('storage/' . $image) }}" alt="Property Image" class="w-full h-48 object-cover" />
                                    <div class="magnifier-lens"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-prev absolute left-2 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded-full">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="carousel-next absolute right-2 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded-full">
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
                    @if ($item->swap_preferences)
                    <!-- Swap Form -->
                    <p class="text-gray-600 font-bold mb-4">Swap for {{ $item->swap_preferences }}</p>

                    @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('swap.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}" />

                        <!-- Property Title -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <i class="fas fa-home text-orange-600 p-2"></i>
                                <input class="w-full p-2 outline-none" type="text" name="title" id="title" placeholder="Enter title" required />
                            </div>
                        </div>

                        <!-- Images Upload -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="images">Upload Images</label>
                            <div class="flex items-center border border-gray-300 rounded-md p-2">
                                <i class="fas fa-image text-orange-600"></i>
                                <input class="w-full p-2 outline-none" type="file" name="images[]" id="images" accept="image/*" multiple />
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <i class="fas fa-info-circle text-orange-600 p-2"></i>
                                <textarea class="w-full p-2 outline-none" name="description" id="description" rows="4" placeholder="Enter a brief description of your property" required></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-right">
                            <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700"><i class="fas fa-check-circle"></i> Swap</button>
                        </div>
                    </form>

                    @else
                    <!-- Sell Form -->
                    <p class="text-gray-600 font-bold mb-4">For SELL</p>
                    <form action="{{ route('order.store') }}" method="POST" class="max-w-6xl mx-auto flex flex-col items-center p-4">
                        @csrf
                        <label for="offer" class="mb-2">Offer</label>
                        <input type="number" name="offer" placeholder="Enter your offer or leave it as is" class="w-full md:w-1/2 p-2 border border-gray-300 rounded-md mb-4"  />

                        <label for="qty" class="mb-2">Quantity</label>
                        <input type="number" name="qty" placeholder="Enter quantity" class="w-full md:w-1/2 p-2 border border-gray-300 rounded-md mb-4" required />

                        <input type="hidden" name="item_id" value="{{ $item->id }}" />
                        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700"><i class="fas fa-info-circle"></i> Place an order</button>
                    </form>
                    @endif
                
                @endforeach
            </div>
        </main>

      

        <!-- Carousel Script -->
        <script>
            document.querySelectorAll(".carousel").forEach((carousel) => {
                const items = carousel.querySelectorAll(".carousel-item");
                const prevBtn = carousel.querySelector(".carousel-prev");
                const nextBtn = carousel.querySelector(".carousel-next");
                let currentIndex = 0;

                function showItem(index) {
                    items.forEach((item, i) => {
                        item.classList.toggle("hidden", i !== index);
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

            document.querySelectorAll(".magnifier-container").forEach((container) => {
                const img = container.querySelector("img");
                const lens = container.querySelector(".magnifier-lens");
                const largeImageSrc = img.getAttribute("data-large");

                const zoom = document.createElement("div");
                zoom.className = "magnifier-zoom";
                zoom.style.backgroundImage = `url(${largeImageSrc})`;
                document.body.appendChild(zoom);

                container.addEventListener("mousemove", (e) => {
                    const rect = img.getBoundingClientRect();
                    const x = e.pageX - rect.left - window.pageXOffset;
                    const y = e.pageY - rect.top - window.pageYOffset;

                    lens.style.left = `${x - lens.offsetWidth / 2}px`;
                    lens.style.top = `${y - lens.offsetHeight / 2}px`;
                    lens.style.display = "block";

                    zoom.style.backgroundSize = `${img.offsetWidth * 2}px ${img.offsetHeight * 2}px`;
                    zoom.style.backgroundPosition = `-${x * 2}px -${y * 2}px`;
                    zoom.style.left = `${e.pageX + 20}px`;
                    zoom.style.top = `${e.pageY + 20}px`;
                    zoom.style.display = "block";
                });

                container.addEventListener("mouseleave", () => {
                    lens.style.display = "none";
                    zoom.style.display = "none";
                });
            });
        </script>
    </body>
</html>
