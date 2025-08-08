<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'montant',
        'statut',
        'stripe_id',
        'stripe_payment_intent_id',
        'stripe_payment_method_id',
        'currency',
        'description',
        'metadata',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'metadata' => 'array',
    ];

    /**
     * Réservation associée au paiement
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Payeur (client)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if payment is successful
     */
    public function isSuccessful()
    {
        return $this->statut === 'paye';
    }

    /**
     * Check if payment is pending
     */
    public function isPending()
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Check if payment failed
     */
    public function isFailed()
    {
        return $this->statut === 'echoue';
    }

    /**
     * Check if payment is refunded
     */
    public function isRefunded()
    {
        return $this->statut === 'rembourse';
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->montant, 2) . ' ' . strtoupper($this->currency ?? 'EUR');
    }
}
