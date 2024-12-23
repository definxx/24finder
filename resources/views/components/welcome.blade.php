<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Property Listings - Startup</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="description" content="Find the best electronics and POS machines on 24finder.ng. Affordable prices and fast delivery." />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    </head>

    <body class="bg-gray-50 flex flex-col min-h-screen">
        <!-- Navbar -->

        <!-- Listings -->
        <main class="flex-grow max-w-6xl mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $combinedItems = $saleItems->merge($swapItems); @endphp @foreach($combinedItems as $item)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <div class="carousel relative w-full overflow-hidden rounded-lg mb-4">
                        <div class="carousel-inner">
                            @foreach(json_decode($item->images) as $image)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/app/public/' . $image) }}"  width="50" height="50" alt="Property Image" class="w-full h-48 object-cover" />
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
                    <p class="text-gray-600 font-bold mb-4">For SELL</p>
                    @endif

                    <!-- Display User Name -->
                    <p class="text-gray-600 mb-4">
                        Posted by: @if($item->user)
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
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('product.show', $item->id)) }}" target="_blank" class="text-blue-400 hover:text-blue-600"> <i class="fab fa-twitter"></i> Share on Twitter </a>
                    </div>

                    <div class="like-dislike-container flex items-center space-x-4 mb-2">
                        <span class="likes text-blue-600">Likes: <span id="likes-{{ $item->id }}"> {{ $item->likes_count ?? 0 }}</span></span>
                        <span class="dislikes text-red-600">Dislikes: <span id="dislikes-{{ $item->id }}">{{ $item->dislikes_count ?? 0}}</span></span>
                    </div>

                    <div class="flex space-x-2 mb-4">
                        <!-- Like Button -->
                        @auth
                        <form action="{{ route('item.like', $item->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="like-btn bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"><i class="fas fa-thumbs-up"></i> Like</button>
                        </form>

                        <!-- Dislike Button -->
                        <form action="{{ route('item.dislike', $item->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="dislike-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"><i class="fas fa-thumbs-down"></i> Dislike</button>
                        </form>
                        @endauth
                       

                        <button class="comment-btn bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600" onclick="toggleCommentSection({{ $item->id }})"><i class="fas fa-comment-alt"></i> Comment</button>
                        <!-- View Details Button -->
                    </div>
                    <!-- Comment Section -->
                    <div class="comment-section hidden mb-4" id="comment-section-{{ $item->id }}">
                        <!-- Comments List -->
                        <div id="comments-list-{{ $item->id }}" class="mb-4">
                            @forelse ($item->comments as $comment)
                            <div class="p-2 border-b">
                                <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                                <span class="text-gray-500 text-sm">({{ $comment->created_at->diffForHumans() }})</span>
                            </div>
                            @empty
                            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                            @endforelse
                        </div>
                
                        @auth
                        <form action="{{ route('item.comment', $item->id) }}" method="POST">
                            @csrf
                            <textarea name="comment" class="border p-2 w-full rounded" placeholder="Write your comment here..." required></textarea>
                            <button type="submit" class="bg-green-600 text-white px-4 py-1 mt-2 rounded hover:bg-green-700">
                                Submit
                            </button>
                        </form>
                        @endauth
                        <!-- Comment Form -->
                       
                    </div>

                    <!-- View Details Button -->
                    <a href="{{ route('product.show', $item->id) }}" class="block bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 text-center"> <i class="fas fa-info-circle"></i> View </a>
                </div>
                @endforeach

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

                <script>
                    /**
                     * Toggle the visibility of the comment section for a specific item and fetch comments if not already fetched.
                     * @param {number} id - The ID of the item.
                     */
                    function toggleCommentSection(id) {
                        const commentSection = document.getElementById(`comment-section-${id}`);
                        const commentsList = document.getElementById(`comments-list-${id}`);

                        if (commentSection) {
                            commentSection.classList.toggle("hidden");

                            // Fetch comments only if the section is being displayed
                            if (!commentSection.classList.contains("hidden") && !commentsList.dataset.fetched) {
                                fetchComments(id);
                            }
                        } else {
                            console.error(`Comment section for item ${id} not found.`);
                        }
                    }

                   
                </script>
            </div>
        </main>
    </body>
</html>
