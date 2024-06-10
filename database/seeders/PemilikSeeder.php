<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemilik::create([
            'nama' => 'PT Telkom Indonesia',
            'alamat' => 'Jl. Jend. Gatot Subroto Kav. 52',
            'telepon' => '0804123456',
            'created_by' => 1,
        ]);

        Pemilik::create([
            'nama' => 'PT Indosat Tbk',
            'alamat' => 'Jl. Medan Merdeka Barat No. 21',
            'telepon' => '0211234567',
            'created_by' => 1,
        ]);

        Pemilik::create([
            'nama' => 'PT XL Axiata Tbk',
            'alamat' => 'Jl. Kebon Sirih No. 12',
            'telepon' => '0218765432',
            'created_by' => 1,
        ]);
    }
}
