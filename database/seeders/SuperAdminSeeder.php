<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@jojojobel.cm'],
            [
                'name'     => 'JojoJobel Admin',
                'password' => bcrypt('Admin2025!'),
                'role'     => 'superadmin',
            ]
        );

        $this->command->info('SuperAdmin créé : admin@jojojobel.cm');
    }
}