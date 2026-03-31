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
    Schema::create('paiements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('eleve_id')->constrained('eleves')->cascadeOnDelete();
        $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
        $table->tinyInteger('numero_tranche');
        $table->decimal('montant', 10, 2);
        $table->date('date_paiement');
        $table->string('numero_recu', 50)->unique();
        $table->enum('mode_paiement', ['especes', 'orange_money', 'mtn_momo', 'virement'])->default('especes');
        $table->foreignId('encaisse_par')->nullable()->constrained('users')->nullOnDelete();
        $table->text('observation')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
