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
    Schema::create('notes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('eleve_id')->constrained('eleves')->cascadeOnDelete();
        $table->foreignId('matiere_id')->constrained('matieres')->cascadeOnDelete();
        $table->foreignId('classe_id')->constrained('classes')->cascadeOnDelete();
        $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
        $table->tinyInteger('sequence');           // 1, 2, 3 (séquence)
        $table->tinyInteger('trimestre');          // 1, 2, 3
        $table->decimal('note', 5, 2)->nullable(); // ex: 14.50
        $table->string('appreciation', 50)->nullable();
        $table->foreignId('saisi_par')->nullable()->constrained('users')->nullOnDelete();
        $table->unique(['eleve_id','matiere_id','sequence','annee_scolaire_id'], 'note_unique');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
