<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $provinsis = [
            'Jawa Tengah' => ['Kabupaten Magelang', 'Kabupaten Sleman', 'Kabupaten Bantul'],
            'Jawa Timur' => ['Kabupaten Surabaya', 'Kabupaten Malang', 'Kabupaten Sidoarjo'],
            'Jawa Barat' => ['Kabupaten Bandung', 'Kabupaten Bekasi', 'Kabupaten Bogor'],
        ];

        foreach ($provinsis as $provinsi => $kabupatens) {
            $provinsiData = Wilayah::create([
                'nama' => $provinsi,
                'level' => 1,
                'created_by' => 1,
            ]);

            foreach ($kabupatens as $kabupaten) {
                Wilayah::create([
                    'nama' => $kabupaten,
                    'id_parent' => $provinsiData->id,
                    'level' => 2,
                    'created_by' => 1,
                ]);
            }
        }
    }
}
