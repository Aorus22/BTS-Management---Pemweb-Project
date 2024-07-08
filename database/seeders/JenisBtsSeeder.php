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
            ['nama' => 'Tower Empat Kaki', 'created_by' => 1],
            ['nama' => 'Tower Tiga Kaki', 'created_by' => 1],
            ['nama' => 'Tower Satu Kaki', 'created_by' => 1],
        ];

        foreach ($jenisBtsData as $data) {
            JenisBTS::create($data);
        }
    }
}
