<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function completePayment($paymentId)
    {
        $payment = Payment::find($paymentId);

        if ($payment) {
            $payment->markAsComplete();
            return response()->json(['message' => 'Pembayaran berhasil diselesaikan.']);
        } 
        else {
            return response()->json(['error' => 'Pembayaran tidak ditemukan.'], 404);
        }
    }
}