<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw Funds</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="POST" action="/withdraw" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md space-y-4">
        @csrf
    
        <h2 class="text-2xl font-bold text-gray-800 text-center">Withdraw Funds</h2>
    
        <!-- Bank Selection -->
        <div>
            <label for="bank_code" class="block text-sm font-medium text-gray-700">Select Bank:</label>
            <select
                name="bank_code"
                id="bank_code"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            >
                @foreach ($banks as $bank)
                    <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                @endforeach
            </select>
        </div>
    
        <!-- Account Number -->
        <div>
            <label for="account_number" class="block text-sm font-medium text-gray-700">Account Number:</label>
            <input
                type="text"
                name="account_number"
                id="account_number"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="Enter your account number"
            />
        </div>
    
        <!-- Amount -->
        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount (NGN):</label>
            <input
                type="number"
                name="amount"
                id="amount"
                min="1"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="Enter withdrawal amount"
            />
        </div>
    
        <!-- Submit Button -->
        <div>
            <button
                type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Withdraw
            </button>
        </div>
    </form>
    

</body>
</html>
