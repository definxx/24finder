<x-app-layout>
 
    <body class="bg-gray-50 flex flex-col min-h-screen">
        <!-- Main Content -->
        <main class="flex-grow max-w-6xl mx-auto p-6">
            @if (session('success'))
            <div class="bg-green-600 text-black p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
            @endif
            <form method="POST" class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('create.sawp.item') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-home text-orange-600 p-2"></i>
                        <input class="w-full p-2 outline-none" type="text" id="title" name="title" placeholder="Enter property title" required />
                    </div>
                    @error('title')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                        Category
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-home text-orange-600 p-2"></i>
                        <select id="category" name="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Clothing">Clothing</option>
                            <option value="Books">Books</option>
                            <option value="Toys & Games">Toys & Games</option>
                            <option value="Appliances">Appliances</option>
                            <option value="Sports & Outdoors">Sports & Outdoors</option>
                            <option value="Beauty & Health">Beauty & Health</option>
                            <option value="Jewelry & Watches">Jewelry & Watches</option>
                            <option value="Automotive">Automotive</option>
                            <option value="Tools & Home Improvement">Tools & Home Improvement</option>
                            <option value="Pet Supplies">Pet Supplies</option>
                            <option value="Baby & Kids">Baby & Kids</option>
                            <option value="Art & Collectibles">Art & Collectibles</option>
                            <option value="Music Instruments">Music Instruments</option>
                            <option value="Office Supplies">Office Supplies</option>
                            <option value="Gardening & Outdoor">Gardening & Outdoor</option>
                            <option value="Food & Beverages">Food & Beverages</option>
                            <option value="Health & Fitness">Health & Fitness</option>
                            <option value="Hobbies & Crafts">Hobbies & Crafts</option>
                        </select>
                    </div>
                    @error('category')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="condition">
                        Condition
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-map-marker-alt text-orange-600 p-2"></i>
                        <select id="condition" name="condition" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>Select the item's condition</option>
                            <option value="New">New</option>
                            <option value="Lightly Used">Lightly Used</option>
                            <option value="Heavily Used">Heavily Used</option>
                        </select>
                    </div>
                    @error('condition')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-map-marker-alt text-orange-600 p-2"></i>
                        <input name="description" class="w-full p-2 outline-none" type="text" id="description"  />
                    </div>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                        Price
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-map-marked-alt text-orange-600 p-2"></i>
                        <input name="price" class="w-full p-2 outline-none" type="text" id="price" placeholder="Enter price" required />
                    </div>
                    @error('price')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="swap_preferences">
                        Swap Preferences
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-map-marked-alt text-orange-600 p-2"></i>
                        <input name="swap_preferences" class="w-full p-2 outline-none" type="text" id="swap_preferences" placeholder="Enter swap preferences" required />
                    </div>
                    @error('swap_preferences')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="images">
                        Upload up to 5 images in JPG, PNG, or JPEG format.
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md p-2">
                        <i class="fas fa-image text-orange-600"></i>
                        <input class="w-full p-2 outline-none" type="file" id="images" name="images[]" accept="image/*" multiple required />
                    </div>
                    @error('images')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                        <i class="fas fa-check-circle"></i> Post Property
                    </button>
                </div>
            </form>
        </main>
    </body>
</x-app-layout>
