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
    Schema::create('matieres', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 100);
        $table->string('code', 20)->nullable();    // ex: MATH, FR, SVT
        $table->integer('coefficient')->default(1);
        $table->foreignId('niveau_id')->constrained('niveaux')->cascadeOnDelete();
        $table->enum('groupe', ['litteraire', 'scientifique', 'technique', 'general'])->default('general');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
