<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Customer;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret_key'));
    }

    /**
     * Create a payment intent for a booking
     */
    public function createPaymentIntent(Booking $booking, $amount, $currency = 'eur')
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => $currency,
                'metadata' => [
                    'booking_id' => $booking->id,
                    'user_id' => auth()->id(),
                    'listing_id' => $booking->listing_id,
                ],
                'description' => "Paiement pour la réservation #{$booking->id}",
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return $paymentIntent;
        } catch (\Exception $e) {
            Log::error('Stripe payment intent creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create or retrieve a Stripe customer
     */
    public function createOrRetrieveCustomer($user)
    {
        try {
            // Check if user already has a Stripe customer ID
            if ($user->stripe_customer_id) {
                return Customer::retrieve($user->stripe_customer_id);
            }

            // Create new customer
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'metadata' => [
                    'user_id' => $user->id,
                ],
            ]);

            // Update user with Stripe customer ID
            $user->update(['stripe_customer_id' => $customer->id]);

            return $customer;
        } catch (\Exception $e) {
            Log::error('Stripe customer creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Confirm a payment intent
     */
    public function confirmPaymentIntent($paymentIntentId, $paymentMethodId = null)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            
            if ($paymentMethodId) {
                $paymentIntent->confirm([
                    'payment_method' => $paymentMethodId,
                ]);
            } else {
                $paymentIntent->confirm();
            }

            return $paymentIntent;
        } catch (\Exception $e) {
            Log::error('Stripe payment confirmation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Retrieve a payment intent
     */
    public function retrievePaymentIntent($paymentIntentId)
    {
        try {
            return PaymentIntent::retrieve($paymentIntentId);
        } catch (\Exception $e) {
            Log::error('Stripe payment intent retrieval failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Cancel a payment intent
     */
    public function cancelPaymentIntent($paymentIntentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            return $paymentIntent->cancel();
        } catch (\Exception $e) {
            Log::error('Stripe payment cancellation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Refund a payment
     */
    public function refundPayment($paymentIntentId, $amount = null)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            
            $refundData = [
                'payment_intent' => $paymentIntentId,
            ];

            if ($amount) {
                $refundData['amount'] = $amount * 100; // Convert to cents
            }

            return \Stripe\Refund::create($refundData);
        } catch (\Exception $e) {
            Log::error('Stripe refund failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create a payment method
     */
    public function createPaymentMethod($type, $cardData)
    {
        try {
            return PaymentMethod::create([
                'type' => $type,
                'card' => $cardData,
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe payment method creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Attach payment method to customer
     */
    public function attachPaymentMethodToCustomer($paymentMethodId, $customerId)
    {
        try {
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            return $paymentMethod->attach(['customer' => $customerId]);
        } catch (\Exception $e) {
            Log::error('Stripe payment method attachment failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get payment methods for a customer
     */
    public function getCustomerPaymentMethods($customerId)
    {
        try {
            return PaymentMethod::all([
                'customer' => $customerId,
                'type' => 'card',
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe payment methods retrieval failed: ' . $e->getMessage());
            throw $e;
        }
    }
} 