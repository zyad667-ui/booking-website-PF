<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    /**
     * Hôte (propriétaire de l'annonce)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Réservations pour cette annonce
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Avis sur cette annonce
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Images de l'annonce
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
