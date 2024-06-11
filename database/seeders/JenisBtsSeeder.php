<?php

namespace Database\Seeders;

use App\Models\JenisBTS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBtsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisBtsData = [
            ['nama' => 'Tower Empat Kaki'],
            ['nama' => 'Tower Tiga Kaki'],
            ['nama' => 'Tower Satu Kaki'],
        ];

        foreach ($jenisBtsData as $data) {
            JenisBTS::create($data);
        }
    }
}
