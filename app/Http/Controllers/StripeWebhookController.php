<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    /**
     * Handle Stripe webhook events
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (SignatureVerificationException $e) {
            Log::error('Webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event->data->object);
                break;

            case 'charge.succeeded':
                $this->handleChargeSucceeded($event->data->object);
                break;

            case 'charge.failed':
                $this->handleChargeFailed($event->data->object);
                break;

            case 'invoice.payment_succeeded':
                $this->handleInvoicePaymentSucceeded($event->data->object);
                break;

            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($event->data->object);
                break;

            default:
                Log::info('Unhandled webhook event: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle successful payment intent
     */
    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        try {
            $payment = Payment::where('stripe_payment_intent_id', $paymentIntent->id)->first();

            if ($payment) {
                $payment->update([
                    'statut' => 'paye',
                    'metadata' => array_merge($payment->metadata ?? [], [
                        'stripe_status' => $paymentIntent->status,
                        'last_webhook' => 'payment_intent.succeeded',
                        'webhook_received_at' => now()->toISOString(),
                    ]),
                ]);

                // Update booking status
                if ($payment->booking) {
                    $payment->booking->update(['statut' => 'confirme']);
                }

                Log::info("Payment {$payment->id} marked as successful via webhook");
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment_intent.succeeded webhook: ' . $e->getMessage());
        }
    }

    /**
     * Handle failed payment intent
     */
    protected function handlePaymentIntentFailed($paymentIntent)
    {
        try {
            $payment = Payment::where('stripe_payment_intent_id', $paymentIntent->id)->first();

            if ($payment) {
                $payment->update([
                    'statut' => 'echoue',
                    'metadata' => array_merge($payment->metadata ?? [], [
                        'stripe_status' => $paymentIntent->status,
                        'last_webhook' => 'payment_intent.payment_failed',
                        'webhook_received_at' => now()->toISOString(),
                        'failure_reason' => $paymentIntent->last_payment_error->message ?? 'Unknown error',
                    ]),
                ]);

                Log::info("Payment {$payment->id} marked as failed via webhook");
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment_intent.payment_failed webhook: ' . $e->getMessage());
        }
    }

    /**
     * Handle successful charge
     */
    protected function handleChargeSucceeded($charge)
    {
        try {
            $payment = Payment::where('stripe_payment_intent_id', $charge->payment_intent)->first();

            if ($payment && $payment->statut !== 'paye') {
                $payment->update([
                    'statut' => 'paye',
                    'metadata' => array_merge($payment->metadata ?? [], [
                        'charge_id' => $charge->id,
                        'last_webhook' => 'charge.succeeded',
                        'webhook_received_at' => now()->toISOString(),
                    ]),
                ]);

                // Update booking status
                if ($payment->booking) {
                    $payment->booking->update(['statut' => 'confirme']);
                }

                Log::info("Payment {$payment->id} confirmed via charge.succeeded webhook");
            }
        } catch (\Exception $e) {
            Log::error('Error handling charge.succeeded webhook: ' . $e->getMessage());
        }
    }

    /**
     * Handle failed charge
     */
    protected function handleChargeFailed($charge)
    {
        try {
            $payment = Payment::where('stripe_payment_intent_id', $charge->payment_intent)->first();

            if ($payment) {
                $payment->update([
                    'statut' => 'echoue',
                    'metadata' => array_merge($payment->metadata ?? [], [
                        'charge_id' => $charge->id,
                        'last_webhook' => 'charge.failed',
                        'webhook_received_at' => now()->toISOString(),
                        'failure_reason' => $charge->failure_message ?? 'Unknown error',
                    ]),
                ]);

                Log::info("Payment {$payment->id} marked as failed via charge.failed webhook");
            }
        } catch (\Exception $e) {
            Log::error('Error handling charge.failed webhook: ' . $e->getMessage());
        }
    }

    /**
     * Handle successful invoice payment
     */
    protected function handleInvoicePaymentSucceeded($invoice)
    {
        // Handle subscription or recurring payment success
        Log::info('Invoice payment succeeded: ' . $invoice->id);
    }

    /**
     * Handle failed invoice payment
     */
    protected function handleInvoicePaymentFailed($invoice)
    {
        // Handle subscription or recurring payment failure
        Log::info('Invoice payment failed: ' . $invoice->id);
    }
}
