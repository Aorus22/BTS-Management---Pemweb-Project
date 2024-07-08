<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JawabanKuesioner;
use App\Models\Monitoring;
use App\Models\Kuesioner;
use App\Models\Pilihan_Kuesioner;

class JawabanKuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $monitorings = Monitoring::all();
        $kuesioners = Kuesioner::all();

        foreach ($monitorings as $monitoring) {
            foreach ($kuesioners as $kuesioner) {
                $pilihan = Pilihan_Kuesioner::where('id_kuesioner', $kuesioner->id)->inRandomOrder()->first();

                JawabanKuesioner::create([
                    'id_monitoring' => $monitoring->id,
                    'id_kuesioner' => $kuesioner->id,
                    'id_pilihan_kuesioner' => $pilihan->id,
                    'created_by' => 1,
                    'edited_by' => 1,
                ]);
            }
        }
    }
}
