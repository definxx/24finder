<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaystackController extends Controller
{
    public function processWithdrawal(Request $request)
    {
        // Validate user input
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_code' => 'required|string',
            'account_number' => 'required|string',
        ]);
    
        $amount = $request->input('amount'); // In Naira
        $bankCode = $request->input('bank_code');
        $accountNumber = $request->input('account_number');
    
        // Convert amount to Kobo (Paystack requires amount in kobo)
        $amountInKobo = $amount * 100;
    
        try {
            // Create a transfer recipient
            $recipientCode = $this->createTransferRecipient($bankCode, $accountNumber);
    
            // Initiate the transfer
            $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
                ->post(env('PAYSTACK_BASE_URL') . '/transfer', [
                    'source' => 'balance',
                    'reason' => 'Withdrawal from platform',
                    'amount' => $amountInKobo,
                    'recipient' => $recipientCode,
                ]);
    
            // Check if the request was successful
            if ($response->successful() && $response->json('status') === true) {
                return response()->json([
                    'message' => 'Withdrawal successful!',
                    'data' => $response->json('data'), // Optional: return transfer details
                ]);
            } else {
                // Handle Paystack failure
                $errorMessage = $response->json('message') ?? 'An error occurred';
                return response()->json([
                    'error' => $errorMessage,
                ], 500);
            }
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'error' => 'Withdrawal failed: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    private function createTransferRecipient($bankCode, $accountNumber)
    {
        // Create a transfer recipient on Paystack
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_BASE_URL') . '/transferrecipient', [
                'type' => 'nuban',
                'name' => 'User Withdrawal',
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
                'currency' => 'NGN',
            ]);
    
        // Check if the request was successful
        if ($response->successful() && $response->json('status') === true) {
            return $response->json('data.recipient_code'); // Return the recipient code
        } else {
            $errorMessage = $response->json('message') ?? 'An error occurred while creating the recipient';
            throw new \Exception($errorMessage);
        }
    }
    
    public function index()
    {
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get(env('PAYSTACK_BASE_URL') . '/bank');
    
        if ($response->successful()) {
            $banks = $response->json()['data']; // List of banks
            return view('payment.paystack', compact('banks')); // Pass the banks to the view
        
        } else {
            return back()->with('error', 'Failed to fetch banks.'); // Handle error
        }
    }
    
}
