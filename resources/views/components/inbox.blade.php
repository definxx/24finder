
  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
      
                    
                    <div class="space-y-4">
                        @foreach ($users as $user)
                            <a href="{{ route('message.create', ['user_id' => $user->id]) }}" class="block hover:bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden">
                                        <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $user->lastMessage->message ?? 'No messages yet' }}
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

