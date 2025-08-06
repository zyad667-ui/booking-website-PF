<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Annonce concernée par l'image
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
