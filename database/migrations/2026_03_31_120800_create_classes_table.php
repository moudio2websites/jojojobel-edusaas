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
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 50);             // ex: 6ème A, Tle C
        $table->foreignId('niveau_id')->constrained('niveaux')->cascadeOnDelete();
        $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
        $table->integer('effectif_max')->default(80);
        $table->string('salle', 20)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
