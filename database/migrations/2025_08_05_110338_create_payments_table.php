<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Réservation liée
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Payeur (client)
            $table->decimal('montant', 8, 2);
            $table->enum('statut', ['en_attente', 'paye', 'echoue', 'rembourse'])->default('en_attente');
            $table->string('stripe_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
