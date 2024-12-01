<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-extrabold text-orange-600 text-center mb-8">
            Manage Your Swaps
        </h2>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4 text-center">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Swap List -->
        <div class="space-y-6">
            @forelse($swaps as $swap)
                <!-- Swap Card -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                Swap Request for {{ $swap->item->title }}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                Submitted: {{ $swap->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('product.show', $swap->id) }}"
                                class="text-orange-600 hover:underline font-medium text-sm flex items-center"
                            >
                                <i class="fas fa-eye mr-1"></i> View Details
                            </a>
                            <form method="POST" action="{{ route('swap.destroy', $swap->id) }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="text-red-600 hover:underline font-medium text-sm flex items-center"
                                    onclick="return confirm('Are you sure you want to cancel this swap?')"
                                >
                                    <i class="fas fa-times mr-1"></i> Cancel Swap
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-700 text-sm">
                            Swap Description: <span class="font-bold">{{ $swap->description }}</span>
                        </p>
                        <!-- Status with Badge -->
                        <span class="text-sm font-semibold py-1 px-3 rounded-full 
                            @if($swap->status === 'pending') bg-yellow-100 text-yellow-600 
                            @elseif($swap->status === 'approved') bg-green-100 text-green-600 
                            @elseif($swap->status === 'rejected') bg-red-100 text-red-600 
                            @else bg-gray-100 text-gray-600 
                            @endif">
                            {{ ucfirst($swap->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center">No swap requests found.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $swaps->links() }}
        </div>
    </div>
</body>
</html>
