<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CharityDonation;
use App\Mail\CharityReceiptMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class CharityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:upi,bank_transfer,qr_code',
            'transaction_id' => 'required|string|max:255',
        ]);

        $donationId = 'DON-' . strtoupper(Str::random(8));

        $donation = CharityDonation::create([
            'donation_id' => $donationId,
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
        ]);

        // Generate PDF Receipt
        $pdf = Pdf::loadView('frontend.receipts.charity', compact('donation'));
        $pdfPath = 'receipts/' . $donationId . '.pdf';
        \Storage::disk('public')->put($pdfPath, $pdf->output());

        $donation->update(['receipt_path' => $pdfPath]);

        // Send Email
        Mail::to($donation->email)->send(new CharityReceiptMail($donation, storage_path('app/public/' . $pdfPath)));

        return response()->json([
            'success' => true,
            'message' => 'Donation submitted successfully! Your receipt has been sent to your email.',
            'donation_id' => $donationId,
            'receipt_url' => asset('storage/' . $pdfPath)
        ]);
    }
}
