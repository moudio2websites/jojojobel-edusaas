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
    Schema::create('tranches_scolarite', function (Blueprint $table) {
        $table->id();
        $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
        $table->foreignId('niveau_id')->constrained('niveaux')->cascadeOnDelete();
        $table->tinyInteger('numero_tranche');     // 1, 2, 3
        $table->decimal('montant', 10, 2);
        $table->date('date_limite')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranches_scolarite');
    }
};
