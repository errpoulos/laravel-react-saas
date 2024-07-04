<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Eli',
            'email' => 'errpoulos@example.com',
            'password' => bcrypt('pa$$word'),
        ]);

        Feature::create([
            'image' => 'https://static-00.iconduck.com/assets.00/plus-icon-1024x1024-jdaf40nu.png',
            'route_name' => 'feature1.index',
            'name' => 'Calculate Sum',
            'required_credits' => 3,
            'active' => true,
        ]);
        Feature::create([
            'image' => 'https://static-00.iconduck.com/assets.00/no-entry-emoji-512x512-lh8ak5ym.png',
            'route_name' => 'feature1.index',
            'name' => 'Calculate Difference',
            'required_credits' => 1,
            'active' => true,
        ]);

        Package::create([
            'name' => 'Basic',
            'price' => 5,
            'credits' => 20,
        ]);

        Package::create([
            'name' => 'Silver',
            'price' => 20,
            'credits' => 100,
        ]);

        Package::create([
            'name' => 'Gold',
            'price' => 50,
            'credits' => 500,
        ]);
    }

}
