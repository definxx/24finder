<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Booking Management</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    </head>

    <body class="bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-extrabold text-orange-600 text-center mb-8">
                Manage Your Bookings
            </h2>

            <!-- Booking List -->
            <div class="space-y-6">
                <!-- Booking Card Example -->
            
                
                @if (isset($message))
                <p class="text-gray-600">{{ $message }}</p>
            @else
                @foreach ($ordersWithItems as $data)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $data['item'] ? $data['item']->title : 'Unknown Item' }}
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    Category: {{ $data['item'] ? $data['item']->category : 'N/A' }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <!-- View Details Button -->
                                <a href="{{ route('product.view', ['id' => $data['item']->id]) }}" 
                                   class="text-orange-600 hover:underline font-medium text-sm flex items-center">
                                    <i class="fas fa-eye mr-1"></i> View Details
                                </a>
                                <a href="{{ route('message.create', ['user_id' => $data['item']->user_id]) }}" 
                                    class="text-orange-600 hover:underline font-medium text-sm flex items-center">
                                    <i class="fas fa-envelope mr-1"></i> Message
                                 </a>
                                 
             
                                <!-- Cancel Booking Button -->
                                @if ($data['order']->status !== 'confirmed') {{-- Adjust condition based on your status value --}}
                                    <form action="{{ route('order.cancel', ['id' => $data['order']->id]) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:underline font-medium text-sm flex items-center">
                                            <i class="fas fa-times mr-1"></i> Cancel Booking
                                        </button>
                                    </form>
                                @else
                                    <button class="text-gray-400 cursor-not-allowed font-medium text-sm flex items-center" disabled>
                                        <i class="fas fa-times mr-1"></i> Cancel Booking
                                    </button>
                                @endif

                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-700 text-sm">Quantity: <span class="font-bold">{{ $data['order']->qty }}</span></p>
                            <p class="text-gray-700 text-sm">Offer: <span class="font-bold">${{ $data['order']->offer }}</span></p>
                            <p class="text-green-600 text-sm font-semibold">
                                Status: {{ $data['order']->status ? ucfirst($data['order']->status) : 'Processing' }}
                            </p>
                            
                        </div>
                    </div>
                @endforeach
            @endif
            
                
              
            </div>
        </div>
    </body>
</html>
