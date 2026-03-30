<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'superadmin',   // JojoJobel — toi
                'admin_ecole',  // Directeur de l'école
                'censeur',      // Censeur / sous-directeur
                'enseignant',   // Professeur
                'parent',       // Parent d'élève
            ])->default('admin_ecole')->after('email');

            $table->string('telephone', 20)->nullable()->after('role');
            $table->foreignId('tenant_id')->nullable()->after('telephone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'telephone', 'tenant_id']);
        });
    }
};