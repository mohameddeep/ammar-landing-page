<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchants = User::inRandomOrder()->take(8)->get();
        $packages = Package::inRandomOrder()->take(15)->get();

        foreach ($merchants as $merchant) {
            $package = $packages->random();

            Subscription::create([
                'merchant_id' => $merchant->id,
                'package_id' => $package->id,
                'end_date' => Carbon::now()->addDays(30),
                'is_active' => true,
            ]);
        }
    }
}
