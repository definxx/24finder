<x-app-layout>
    <x-slot name="header">
        <!-- Your header content here -->
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($users->isEmpty())
                    <p class="text-center text-gray-700">No users available.</p>
                @else
                    <x-inbox :users="$users" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
