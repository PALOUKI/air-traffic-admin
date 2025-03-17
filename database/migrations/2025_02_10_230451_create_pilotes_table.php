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
        Schema::create('pilotes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CompagnieAerienne::class)->constrained()->cascadeOnDelete();
            $table->string('nom');
            $table->string('prenom');
            //$table->enum('licence', ['pilote', 'hotesse', 'steward', 'mecanicien', 'agentAuSol']); 
            $table->string('licence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilotes');
    }
};
