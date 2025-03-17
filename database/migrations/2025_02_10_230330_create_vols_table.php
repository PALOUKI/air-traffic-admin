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
        Schema::create('vols', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CompagnieAerienne::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Aeroport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Avion::class)->constrained()->cascadeOnDelete();
            $table->timestamp('dateHeureDepart') ;
            $table->timestamp('dateHeureArrivee') ;
            $table->time('dureeEstimee') ;
            $table->enum('statut', ['programmer','retarder', 'enVol', 'atterri', 'devier']); // Enum pour plus de contrôle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vols');
    }
};
