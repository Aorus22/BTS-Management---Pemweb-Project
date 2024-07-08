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

        Pemilik::create([
            'nama' => 'PT Smartfren Telecom Tbk',
            'alamat' => 'Jl. MH Thamrin No. 8',
            'telepon' => '0888112233',
            'created_by' => 1,
        ]);

        Pemilik::create([
            'nama' => 'Hutchison Tri Indonesia',
            'alamat' => 'Jl. Sudirman No. 10',
            'telepon' => '0899223344',
            'created_by' => 1,
        ]);

        Pemilik::create([
            'nama' => 'PT MyRepublic Indonesia',
            'alamat' => 'Jl. Kuningan Barat No. 26',
            'telepon' => '0219876543',
            'created_by' => 1,
        ]);

        Pemilik::create([
            'nama' => 'PT Biznet Networks',
            'alamat' => 'Jl. KH Wahid Hasyim No. 77',
            'telepon' => '0215556667',
            'created_by' => 1,
        ]);

        Pemilik::create([
            'nama' => 'PT First Media Tbk',
            'alamat' => 'Jl. Hayam Wuruk No. 11',
            'telepon' => '0213334445',
            'created_by' => 1,
        ]);
    }
}
