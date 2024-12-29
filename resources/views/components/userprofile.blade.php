
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Profile Picture -->
    <div class="flex flex-col items-center justify-center mb-8">
        <div class="relative">
            <img
                id="profile-picture"
                class="w-40 h-40 rounded-full object-cover border-4 border-orange-600 shadow-lg"
                src="{{ $user->profile_photo_path ? asset('storage/app/public/' . $user->profile_photo_path) : asset('images/logo.jpg') }}"
                alt="Profile Picture"
            />
        </div>
        <p class="text-gray-700">
            <i class="fas fa-user mr-2 text-blue-500"></i> 
            <a href="{{ route('user.profile', $user->id) }}">{{ $user->name }} </a>
        </p>
        <p class="text-gray-700">
            <i class="fas fa-envelope mr-2 text-green-500"></i> 
            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
        </p>
        <p class="text-gray-700">
            <i class="fas fa-phone mr-2 text-orange-500"></i> 
            <a href="tel:{{ $user->tel }}">{{ $user->tel }}</a>
        </p>
        <p class="text-gray-600 mt-2">
            <i class="fas fa-clipboard-list text-orange-600"></i> Total Posts: {{ $postCount }}
        </p>



        <p class="mt-4 text-sm text-gray-500">
            <a href="{{ route('chat.create', ['user_id' => $user->id]) }}" class="text-blue-500 hover:text-blue-700 mr-4 flex items-center"> 
                <i class="fas fa-comment-dots mr-1"></i> Chat 
            </a>
            <a href="/user/profile/{{ $user->id }}" class="text-green-500 hover:text-green-700 flex items-center" target="_blank"> 
                <i class="fas fa-share-alt mr-1"></i> Share Profile 
            </a>
        </p>
    </div>
</form>


<!-- Property Card -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($items as $item)
    <!-- Property Card -->
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <div class="carousel relative w-full overflow-hidden rounded-lg mb-4">
            @foreach (json_decode($item->images, true) as $image)
            <div class="carousel-item">
                <img src="{{ asset('storage/app/public/' . $image) }}" alt="Item Image" class="w-full h-48 object-cover" />
            </div>
            @endforeach
            <button class="carousel-prev absolute left-0 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded-full">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-next absolute right-0 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded-full">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <h3 class="text-xl font-bold text-gray-700">{{ $item->title }}</h3>
        <p class="text-gray-500 mb-2"><i class="fas fa-tags text-orange-600"></i> {{ $item->category }}</p>
        <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($item->description, 50) }}</p>

        <p class="text-gray-700 font-semibold mb-2">&#8358;{{ number_format($item->price, 2) }}</p>

        <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
            <a href="{{ route('product.show', $item->id) }}"> <i class="fas fa-info-circle"></i> View Details </a>
        </button>
    </div>
    @empty
    <div class="col-span-3 text-gray-700 text-lg text-center">
        No items available.
    </div>
    @endforelse
</div>
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
