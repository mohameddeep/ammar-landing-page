<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = Manager::query()->updateOrCreate([
            'email' => 'admin@Elryad.com',
        ], [
            'name' => 'Admin',
            'email' => 'admin@Elryad.com',
            'phone' => '+96650000000',
            'password' => 'elryad1256!@',
        ]);
        $manager->syncRoles([1]);
    }
}
