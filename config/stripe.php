<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Stripe Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Stripe payment processing.
    | Make sure to set your Stripe API keys in your .env file.
    |
    */

    'publishable_key' => env('STRIPE_PUBLISHABLE_KEY'),
    'secret_key' => env('STRIPE_SECRET_KEY'),
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Currency Configuration
    |--------------------------------------------------------------------------
    |
    | Default currency for payments. Stripe supports various currencies.
    |
    */
    'currency' => env('STRIPE_CURRENCY', 'eur'),

    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    |
    | Supported payment methods for your application.
    |
    */
    'payment_methods' => [
        'card',
        'sepa_debit',
        'ideal',
        'sofort',
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Events
    |--------------------------------------------------------------------------
    |
    | Stripe webhook events to handle.
    |
    */
    'webhook_events' => [
        'payment_intent.succeeded',
        'payment_intent.payment_failed',
        'charge.succeeded',
        'charge.failed',
        'invoice.payment_succeeded',
        'invoice.payment_failed',
    ],
]; 