


            @if (session('success'))
            <div class="bg-green-600 text-black p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
            @endif
            <form method="POST" class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('compliant.store') }}" enctype="multipart/form-data">
                @csrf

                

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <i class="fas fa-map-marker-alt text-orange-600 p-2"></i>
                        <textarea name="description" class="w-full p-2 outline-none" type="text" id="description" required ></textarea>
                    </div>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Submit Button -->
                <div class="text-right">
                    <button class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                        <i class="fas fa-check-circle"></i> Comment
                    </button>
                </div>
            </form>


