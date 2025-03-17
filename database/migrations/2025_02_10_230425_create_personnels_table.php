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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CompagnieAerienne::class)->constrained()->cascadeOnDelete();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('fonction', ['pilote', 'hotesse', 'steward', 'mecanicien', 'agentAuSol']); // Enum pour plus de contrôle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
