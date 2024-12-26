<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
                <x-profile :user="$user"  :items="$items" :postCount="$postCount" :referredCount="$referredCount"  />
   
        </div>
    </div>
</x-app-layout>
