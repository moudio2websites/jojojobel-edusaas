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
    Schema::create('discipline', function (Blueprint $table) {
        $table->id();
        $table->foreignId('eleve_id')->constrained('eleves')->cascadeOnDelete();
        $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
        $table->enum('type', ['avertissement', 'blame', 'exclusion_temp', 'exclusion_def', 'felicitations', 'encouragements']);
        $table->text('motif');
        $table->date('date_faute');
        $table->integer('jours_exclusion')->nullable();
        $table->foreignId('signale_par')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline');
    }
};
