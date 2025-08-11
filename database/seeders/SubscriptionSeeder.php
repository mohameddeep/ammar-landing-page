<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->take(8)->get();
        $packages = Package::inRandomOrder()->take(15)->get();

        foreach ($users as $user) {
            $package = $packages->random();

            Subscription::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'end_date' => Carbon::now()->addDays(30),
                'is_active' => true,
            ]);
        }
    }
}
