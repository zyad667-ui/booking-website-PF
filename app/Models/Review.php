<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Auteur de l'avis
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Annonce concernée par l'avis
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
