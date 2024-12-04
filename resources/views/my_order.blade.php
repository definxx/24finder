<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($ordersWithItems->isEmpty())
                    <p class="text-center text-gray-700">{{ $message }}</p>
                @else
                    <x-myorder :ordersWithItems="$ordersWithItems" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
