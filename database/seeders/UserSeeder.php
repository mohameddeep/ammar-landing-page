<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@elryad.com",
//                'password' => Hash::make('elryad1256!#'),
                'phone' => "055$i" . "1242455",
            ]);
        }
    }
}
