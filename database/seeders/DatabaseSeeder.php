<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LaratrustSeeder::class,
            ManagerSeeder::class,
            UserSeeder::class,
            MerchantSeeder::class,
            CommissionSeeder::class,
            PackageSeeder::class,
            PackageFeatureSeeder::class,
            CategorySeeder::class,
            SubscriptionSeeder::class,

        ]);
    }
}
