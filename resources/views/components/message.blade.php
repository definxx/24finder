<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Messages</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    </head>

    <body class="bg-gray-50 flex items-center justify-center min-h-screen">
        <h2 class="text-3xl font-bold text-orange-600 text-center mb-6">
            Messages with {{ $recipient->name }}
        </h2>

        <!-- Messages Container -->
        <div class="flex flex-col space-y-4">
            @foreach($messages as $message)
            <div class="flex items-start space-x-3 {{ $message->sender_id == Auth::id() ? 'justify-end' : '' }}">
                @if($message->sender_id != Auth::id())
                <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                    <img src="{{ $recipient->profile_photo_path ? asset('storage/app/public/' . $recipient->profile_photo_path) : asset('images/logo.jpg') }}"
                     alt="{{ $recipient->name }}" class="w-full h-full object-cover" />
                </div>
                @endif
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <p class="text-gray-800">{{ $message->message }}</p>
                    <span class="text-xs text-gray-500 mt-2 block">{{ $message->created_at->format('g:i A') }}</span>
                </div>
                @if($message->sender_id == Auth::id())
                <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                    <img src="{{ Auth::user()->profile_picture }}" alt="You" class="w-full h-full object-cover" />
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <!-- Message Input -->
            <div>
                <form method="POST" action="{{ route('message.send', ['user_id' => $recipient->id]) }}">
                    @csrf

                    <div class="mt-6 flex items-center">
                        <input type="text" name="message" placeholder="Type a message..." class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />

                        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg ml-3 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            Send
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
