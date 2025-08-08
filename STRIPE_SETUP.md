# Stripe Payment Integration Setup

This guide will help you set up Stripe payments in your PlaceZo booking website.

## Prerequisites

1. A Stripe account (sign up at [stripe.com](https://stripe.com))
2. Laravel project with the booking system already set up

## Installation Steps

### 1. Install Stripe PHP SDK

```bash
composer require stripe/stripe-php
```

### 2. Configure Environment Variables

Add the following variables to your `.env` file:

```env
# Stripe Configuration
STRIPE_PUBLISHABLE_KEY=pk_test_your_publishable_key_here
STRIPE_SECRET_KEY=sk_test_your_secret_key_here
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret_here
STRIPE_CURRENCY=eur
```

### 3. Get Your Stripe Keys

1. Go to [Stripe Dashboard](https://dashboard.stripe.com/)
2. Navigate to **Developers → API keys**
3. Copy your **Publishable key** and **Secret key**
4. Replace the placeholder values in your `.env` file

### 4. Set Up Webhooks (Optional but Recommended)

1. In your Stripe Dashboard, go to **Developers → Webhooks**
2. Click **Add endpoint**
3. Set the endpoint URL to: `https://yourdomain.com/stripe/webhook`
4. Select these events:
   - `payment_intent.succeeded`
   - `payment_intent.payment_failed`
   - `charge.succeeded`
   - `charge.failed`
5. Copy the webhook signing secret and add it to your `.env` file

### 5. Run Migrations

```bash
php artisan migrate
```

This will add the necessary Stripe fields to your database tables.

## Features Included

### Payment Processing
- ✅ Secure payment form with Stripe Elements
- ✅ Payment intent creation and confirmation
- ✅ Real-time payment status updates
- ✅ Support for multiple currencies
- ✅ Payment method validation

### Payment Management
- ✅ Payment history for users
- ✅ Payment details view
- ✅ Payment status tracking
- ✅ Refund functionality
- ✅ Payment cancellation

### Security Features
- ✅ CSRF protection
- ✅ Webhook signature verification
- ✅ Secure API key handling
- ✅ PCI compliance through Stripe

### User Experience
- ✅ Modern, responsive payment form
- ✅ Real-time validation
- ✅ Loading states and error handling
- ✅ Success/failure notifications
- ✅ Mobile-friendly design

## Usage

### For Users
1. Create a booking
2. Click "Payer maintenant" on the booking details page
3. Fill in payment information
4. Complete the payment
5. View payment history in the user menu

### For Developers
- Payment routes are available under `/payments/`
- Webhook endpoint: `/stripe/webhook`
- All payment data is stored in the `payments` table
- Stripe customer IDs are stored in the `users` table

## Testing

### Test Cards
Use these test card numbers for testing:

- **Success**: `4242 4242 4242 4242`
- **Decline**: `4000 0000 0000 0002`
- **Requires Authentication**: `4000 0025 0000 3155`

### Test Mode
- All payments are processed in test mode by default
- No real charges will be made
- Switch to live mode by updating your Stripe keys

## Troubleshooting

### Common Issues

1. **Payment fails with "Invalid API key"**
   - Check your Stripe keys in `.env`
   - Ensure you're using the correct test/live keys

2. **Webhook not receiving events**
   - Verify webhook endpoint URL
   - Check webhook secret in `.env`
   - Ensure webhook is active in Stripe Dashboard

3. **Payment form not loading**
   - Check browser console for JavaScript errors
   - Verify Stripe publishable key is correct
   - Ensure HTTPS is enabled (required for Stripe)

### Debug Mode
Enable debug logging by adding to your `.env`:
```env
LOG_LEVEL=debug
```

## Security Notes

- Never commit your Stripe secret keys to version control
- Always use HTTPS in production
- Regularly rotate your API keys
- Monitor webhook events for suspicious activity
- Keep Stripe SDK updated

## Support

For Stripe-specific issues:
- [Stripe Documentation](https://stripe.com/docs)
- [Stripe Support](https://support.stripe.com/)

For application-specific issues:
- Check Laravel logs: `storage/logs/laravel.log`
- Review payment records in database
- Test with Stripe's test mode first

## Production Checklist

Before going live:

- [ ] Switch to live Stripe keys
- [ ] Set up production webhook endpoint
- [ ] Test payment flow with real cards
- [ ] Configure proper error handling
- [ ] Set up monitoring and alerts
- [ ] Review security settings
- [ ] Test refund functionality
- [ ] Verify webhook reliability 