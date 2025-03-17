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
        Schema::create('avions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\CompagnieAerienne::class)->constrained()->cascadeOnDelete();
            $table->string('modele');
            $table->integer('capacite');
            $table->integer('anneeDeFabrication')->nullable(); // ou year si besoinnmais j'ai eu un problème avec year
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avions');
    }
};
