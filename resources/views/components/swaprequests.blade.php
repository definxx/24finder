<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Swap Request Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-extrabold text-orange-600 text-center mb-8">
            Swap Request Management
        </h2>
    
        <!-- Check if swap requests are available -->
        @if (empty($swapRequests))
            <div class="p-4 text-center text-gray-600">
                <p>No swap requests for now.</p>
            </div>
        @else
            <!-- Loop through swap requests -->
            @foreach ($swapRequests as $swapRequest)
            @foreach ($swapRequest['swaps'] as $swap)
                <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                Swap Request for "{{ $swapRequest['item']->title }}"
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Request by: {{ $swap->user->name }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button
                                class="text-orange-600 hover:underline font-medium text-sm flex items-center"
                                onclick="window.location.href='{{ route('product.show', $swapRequest['item']->id) }}'"
                            >
                                <i class="fas fa-eye mr-1"></i> View Details
                            </button>
                        </div>
                    </div>
        
                    <div class="flex items-center justify-between">
                        <p class="text-gray-700 text-sm">
                            Requested Item: "{{ $swap->title }}"
                        </p>
                        <p class="text-gray-600 text-sm">
                            Status: <span class="font-semibold {{ $swap->status === 'approved' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($swap->status) }}</span>
                        </p>
                    </div>
        
                    <div class="flex justify-between mt-4">
                        <!-- Approve or Decline Buttons -->
                        <form method="POST" action="{{ route('swap_requests.update', $swap->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="flex space-x-4">
                                <button
                                    type="submit"
                                    name="status"
                                    value="approved"
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700"
                                >
                                    Approve
                                </button>
                                <button
                                    type="submit"
                                    name="status"
                                    value="declined"
                                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                >
                                    Decline
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endforeach
        
        
        @endif
    </div>
</body>
</html>
