
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
                <form method="POST" action="{{ route('compliant.store') }}" enctype="multipart/form-data">
                    @csrf
         

                    <!-- Description -->
                    <div class="mt-4">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Provide details about the item..." required>{{ old('description') }}</textarea>
                    </div>

             

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Compliant') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
