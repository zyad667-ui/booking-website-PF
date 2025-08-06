<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Annonces créées par l'utilisateur (si hôte)
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * Réservations faites par l'utilisateur (si client)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Paiements effectués par l'utilisateur (client)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Messages envoyés
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Messages reçus
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Avis rédigés par l'utilisateur
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
