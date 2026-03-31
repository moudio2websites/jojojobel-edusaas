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
    Schema::create('enseignants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        $table->string('matricule', 30)->unique();
        $table->string('nom', 100);
        $table->string('prenom', 100);
        $table->string('telephone', 20)->nullable();
        $table->string('email')->nullable();
        $table->string('specialite', 100)->nullable();
        $table->enum('grade', ['PCEG', 'PLEG', 'vacataire'])->default('PCEG');
        $table->boolean('actif')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
