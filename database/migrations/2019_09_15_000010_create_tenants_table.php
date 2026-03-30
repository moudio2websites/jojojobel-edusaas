<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();

            // Informations de l'école
            $table->string('nom_ecole');
            $table->string('logo')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email_ecole')->nullable();
            $table->string('ville')->nullable();
            $table->string('region')->nullable();

            // Type et abonnement
            $table->enum('type_ecole', ['lycee', 'college', 'cetic'])->default('lycee');
            $table->enum('abonnement', ['basic', 'premium'])->default('basic');

            // Statut
            $table->boolean('actif')->default(true);

            // Données supplémentaires (flexible)
            $table->json('data')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}