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
    Schema::create('eleves', function (Blueprint $table) {
        $table->id();
        $table->string('matricule', 30)->unique();
        $table->string('nom', 100);
        $table->string('prenom', 100);
        $table->date('date_naissance');
        $table->string('lieu_naissance', 100)->nullable();
        $table->enum('sexe', ['M', 'F']);
        $table->foreignId('classe_id')->nullable()->constrained('classes')->nullOnDelete();
        $table->foreignId('annee_scolaire_id')->constrained('annees_scolaires')->cascadeOnDelete();
        $table->string('nom_pere', 100)->nullable();
        $table->string('nom_mere', 100)->nullable();
        $table->string('telephone_parent', 20)->nullable();
        $table->string('adresse', 200)->nullable();
        $table->string('photo')->nullable();
        $table->enum('statut', ['inscrit', 'transfere', 'exclu', 'diplome'])->default('inscrit');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
