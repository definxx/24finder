<x-app-layout>
    <x-slot name="header">
        
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                {{ __('login') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                {{ __('register') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome :categories="$categories" :swapItems="$swapItems" :saleItems="$saleItems" />
            </div>
        </div>
    </div>
</x-app-layout>
