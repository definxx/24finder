<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Pass the $items to the component -->
                <x-profile :user="$user" />
            </div>
        </div>
    </div>
</x-app-layout>
