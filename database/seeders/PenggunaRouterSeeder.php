<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use App\Models\PenggunaRouter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaRouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenggunaRouter::create([
            'nama' => 'Joko',
            'alamat' => 'Jl. Jend. Gatot Subroto Kav. 52',
            'telepon' => '0804123456',
            'created_by' => 1,
        ]);

        PenggunaRouter::create([
            'nama' => 'Owi',
            'alamat' => 'Jl. Medan Merdeka Barat No. 21',
            'telepon' => '0211234567',
            'created_by' => 1,
        ]);

        PenggunaRouter::create([
            'nama' => 'Budi',
            'alamat' => 'Jl. Kebon Sirih No. 12',
            'telepon' => '0218765432',
            'created_by' => 1,
        ]);
    }
}
