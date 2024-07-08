<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Monitoring;

class MonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monitorings = [
            [
                'tahun' => 2024,
                'id_bts' => 1,
                'tanggal_kunjungan' => '2024-07-08',
                'created_by' => 1,
                'edited_by' => 1,
            ],
            [
                'tahun' => 2024,
                'id_bts' => 2,
                'tanggal_kunjungan' => '2024-07-09',
                'created_by' => 1,
                'edited_by' => 1,
            ],
        ];

        foreach ($monitorings as $monitoring) {
            Monitoring::create($monitoring);
        }
    }
}
