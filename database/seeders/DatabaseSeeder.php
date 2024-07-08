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
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            JenisBtsSeeder::class,
            WilayahSeeder::class,
            PemilikSeeder::class,
            BTSSeeder::class,
            KuesionerSeeder::class,
            MonitoringSeeder::class,
            JawabanKuesionerSeeder::class
        ]);
    }
}
