<x-app-layout>
    <x-slot name="header">
        <!-- Search and Filters -->
        <div class="bg-white py-4 shadow-md">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center p-4">
                <input
                    type="text"
                    placeholder="Search by location, price, or property type"
                    class="w-full md:w-1/2 p-2 border border-gray-300 rounded-md mb-4 md:mb-0"
                />
                <button
                    class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700"
                >
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Check if there are swap requests -->
                @if (empty($swapRequests))
                    <div class="p-4 text-center text-gray-600">
                        <p>No swap requests for now.</p>
                    </div>
                @else
                    <x-swaprequests :swapRequests="$swapRequests" :item="$item" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
