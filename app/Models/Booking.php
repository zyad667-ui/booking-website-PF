<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * Client (utilisateur ayant réservé)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Annonce réservée
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Paiement associé à la réservation
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Messages liés à la réservation
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
