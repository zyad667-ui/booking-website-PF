<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Show payment form for a booking
     */
    public function showPaymentForm(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // Check if booking already has a payment
        if ($booking->payment && $booking->payment->isSuccessful()) {
            return redirect()->route('bookings.show', $booking)
                ->with('success', 'This booking has already been paid.');
        }

        return view('payments.create', compact('booking'));
    }

    /**
     * Create payment intent and show payment form
     */
    public function createPaymentIntent(Request $request, Booking $booking)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        try {
            DB::beginTransaction();

            // Create or get Stripe customer
            $customer = $this->stripeService->createOrRetrieveCustomer(auth()->user());

            // Create payment intent
            $paymentIntent = $this->stripeService->createPaymentIntent(
                $booking,
                $request->amount,
                config('stripe.currency', 'eur')
            );

            // Create payment record
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'user_id' => auth()->id(),
                'montant' => $request->amount,
                'statut' => 'en_attente',
                'stripe_id' => $paymentIntent->id,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'currency' => config('stripe.currency', 'eur'),
                'description' => "Paiement pour la réservation #{$booking->id}",
                'metadata' => [
                    'booking_id' => $booking->id,
                    'listing_id' => $booking->listing_id,
                ],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_id' => $payment->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment intent creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment intent.',
            ], 500);
        }
    }

    /**
     * Process payment confirmation
     */
    public function confirmPayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
            'payment_id' => 'required|exists:payments,id',
        ]);

        try {
            DB::beginTransaction();

            $payment = Payment::findOrFail($request->payment_id);
            
            // Verify payment belongs to authenticated user
            if ($payment->user_id !== auth()->id()) {
                abort(403, 'Unauthorized access to this payment.');
            }

            // Retrieve payment intent from Stripe
            $paymentIntent = $this->stripeService->retrievePaymentIntent($request->payment_intent_id);

            // Update payment status based on Stripe status
            switch ($paymentIntent->status) {
                case 'succeeded':
                    $payment->update(['statut' => 'paye']);
                    $payment->booking->update(['statut' => 'confirme']);
                    
                    DB::commit();
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Payment completed successfully!',
                        'redirect_url' => route('bookings.show', $payment->booking),
                    ]);

                case 'requires_payment_method':
                    $payment->update(['statut' => 'echoue']);
                    
                    DB::commit();
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment failed. Please try again.',
                    ]);

                case 'requires_confirmation':
                    // Payment needs additional confirmation
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment requires additional confirmation.',
                        'requires_action' => true,
                    ]);

                default:
                    $payment->update(['statut' => 'en_attente']);
                    
                    DB::commit();
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment is being processed.',
                    ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment confirmation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Payment confirmation failed.',
            ], 500);
        }
    }

    /**
     * Cancel a payment
     */
    public function cancelPayment(Request $request, Payment $payment)
    {
        // Verify payment belongs to authenticated user
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this payment.');
        }

        try {
            DB::beginTransaction();

            // Cancel payment intent in Stripe
            if ($payment->stripe_payment_intent_id) {
                $this->stripeService->cancelPaymentIntent($payment->stripe_payment_intent_id);
            }

            // Update payment status
            $payment->update(['statut' => 'echoue']);

            DB::commit();

            return redirect()->route('bookings.show', $payment->booking)
                ->with('success', 'Payment has been cancelled.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment cancellation failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to cancel payment.');
        }
    }

    /**
     * Refund a payment
     */
    public function refundPayment(Request $request, Payment $payment)
    {
        // Only allow refunds for successful payments
        if (!$payment->isSuccessful()) {
            return redirect()->back()
                ->with('error', 'Only successful payments can be refunded.');
        }

        try {
            DB::beginTransaction();

            // Process refund through Stripe
            $refund = $this->stripeService->refundPayment(
                $payment->stripe_payment_intent_id,
                $request->amount ?? $payment->montant
            );

            // Update payment status
            $payment->update(['statut' => 'rembourse']);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Payment has been refunded successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment refund failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to process refund.');
        }
    }

    /**
     * Show payment history for user
     */
    public function paymentHistory()
    {
        $payments = Payment::where('user_id', auth()->id())
            ->with(['booking.listing'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Changed from get() to paginate(10)

        return view('payments.history', compact('payments'));
    }

    /**
     * Show payment details
     */
    public function show(Payment $payment)
    {
        // Verify payment belongs to authenticated user
        if ($payment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this payment.');
        }

        return view('payments.show', compact('payment'));
    }
}
