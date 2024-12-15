<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

<!-- Main Section -->
<main class="flex-grow max-w-6xl mx-auto p-6">

    <!-- Display Search result -->
    @if(!$result) <!-- Correct check to see if no match found -->
        <p class="text-gray-500 text-center py-4">No items match your search criteria.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <!-- Carousel -->
                <div class="carousel relative w-full overflow-hidden rounded-lg mb-4">
                    <div class="carousel-inner">
                        @foreach(json_decode($result->images) as $image)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $image) }}" alt="Property Image"
                                     class="w-full h-48 object-cover">
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
                <h3 class="text-xl font-bold text-gray-700">{{ $result->title }}</h3>
                <p class="text-gray-500 mb-2">
                    <i class="fas fa-map-marker-alt text-orange-600"></i>
                    {{ $result->category }} 
                </p>
                <p class="text-gray-700 font-semibold mb-2">
                    ${{ number_format($result->price, 2) }}
                </p>
                <p class="text-gray-600 mb-4">{{ $result->description }}</p>
                <p class="text-gray-600 font-bold mb-4">For SELL</p>

                <!-- View Details -->
                <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                    <a href="{{ route('product.show', $result->id) }}">
                        <i class="fas fa-info-circle"></i> View Details
                    </a>
                </button>
            </div>
        </div>
    @endif
</main>

<!-- Include the carousel logic -->
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
