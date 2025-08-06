<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
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
}
