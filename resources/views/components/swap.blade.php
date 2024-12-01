<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post an Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session('success'))
                <div class="bg-green-600 text-black p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
                <form method="POST" action="{{ route('create.sawp.item') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Item Title -->
                    <div class="mt-4">
                        <x-label for="title" value="{{ __('Item Title') }}" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" placeholder="Enter a descriptive title" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-label for="category" value="{{ __('Category') }}" />
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

                    <!-- Description -->
                    <div class="mt-4">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Provide details about the item..." required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Condition -->
                    <div class="mt-4">
                        <x-label for="condition" value="{{ __('Condition') }}" />
                        <select id="condition" name="condition" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>Select the item's condition</option>
                            <option value="New">New</option>
                            <option value="Lightly Used">Lightly Used</option>
                            <option value="Heavily Used">Heavily Used</option>
                        </select>
                    </div>

                    <!-- Swap Preferences -->
                    <div class="mt-4">
                        <x-label for="swap_preferences" value="{{ __('Swap Preferences (Optional)') }}" />
                        <x-input id="swap_preferences" class="block mt-1 w-full" type="text" name="swap_preferences" :value="old('swap_preferences')" placeholder="What are you looking for in return?" />
                    </div>

                    <!-- Images -->
                    <div class="mt-4">
                        <x-label for="images" value="{{ __('Upload Images') }}" />
                        <x-input id="images" class="block mt-1 w-full" type="file" name="images[]" multiple required />
                        <small class="text-gray-500">Upload up to 5 images in JPG, PNG, or JPEG format.</small>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Post Item') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
