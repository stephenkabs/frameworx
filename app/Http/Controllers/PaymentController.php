<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DpoPaymentService;

class PaymentController extends Controller
{
    protected $dpoService;

    public function __construct(DpoPaymentService $dpoService)
    {
        $this->dpoService = $dpoService;
    }

    public function createPayment(Request $request)
    {
        $paymentDetails = [
            'company_token' => 'B3F59BE7-0756-420E-BB88-1D98E7A6B040',
            'amount' => $request->amount,
            'currency' => $request->currency,
            'reference' => $request->reference,
            'redirect_url' => route('payment.success'),
            'back_url' => route('payment.cancel'),
            'unique_ref' => '0',
            'ptl' => '5',
        ];

        $services = [
            [
                'type' => '45',
                'description' => 'Flight from Nairobi to Diani',
                'date' => now()->format('Y/m/d H:i'),
            ],
        ];

        try {
            $response = $this->dpoService->createPaymentToken($paymentDetails, $services);

            // Handle response
            return response()->json(['success' => true, 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
