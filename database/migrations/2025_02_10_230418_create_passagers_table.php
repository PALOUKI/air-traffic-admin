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
        Schema::create('passagers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Vol::class)->constrained()->cascadeOnDelete();
            $table->string('nom');
            $table->string('prenom');
            $table->date('dateDeNaissance');
            $table->string('nationalite');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passagers');
    }
};
