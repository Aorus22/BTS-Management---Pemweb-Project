<?php

namespace Database\Seeders;

use App\Models\Bts;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class BTSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $btsList = [
            [
                'nama' => 'BTS Indralaya',
                'alamat' => 'Jl. Teuku Umar No.1',
                'id_jenis_bts' => 1,
                'latitude' => -7.621000,
                'longitude' => 111.088500,
                'tinggi_tower' => 50.00,
                'panjang_tanah' => 100.00,
                'lebar_tanah' => 50.00,
                'ada_genset' => true,
                'ada_tembok_batas' => true,
                'id_pemilik' => 1,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Biringkanaya',
                'alamat' => 'Jl. Tapir No.2',
                'id_jenis_bts' => 2,
                'latitude' => -6.9188,
                'longitude' => 106.9267,
                'tinggi_tower' => 60.00,
                'panjang_tanah' => 120.00,
                'lebar_tanah' => 60.00,
                'ada_genset' => false,
                'ada_tembok_batas' => true,
                'id_pemilik' => 2,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Tembuku',
                'alamat' => 'Jl. Anggrek No.3',
                'id_jenis_bts' => 3,
                'latitude' => -7.9829,
                'longitude' => 112.6304,
                'tinggi_tower' => 55.00,
                'panjang_tanah' => 110.00,
                'lebar_tanah' => 55.00,
                'ada_genset' => true,
                'ada_tembok_batas' => false,
                'id_pemilik' => 3,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Pundong',
                'alamat' => 'Jl. Tembakau No.4',
                'id_jenis_bts' => 1,
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'tinggi_tower' => 52.00,
                'panjang_tanah' => 105.00,
                'lebar_tanah' => 52.00,
                'ada_genset' => true,
                'ada_tembok_batas' => true,
                'id_pemilik' => 4,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Dau',
                'alamat' => 'Jl. Sudirman No.5',
                'id_jenis_bts' => 2,
                'latitude' => -8.6705,
                'longitude' => 115.2126,
                'tinggi_tower' => 58.00,
                'panjang_tanah' => 115.00,
                'lebar_tanah' => 58.00,
                'ada_genset' => false,
                'ada_tembok_batas' => true,
                'id_pemilik' => 5,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Cikidang',
                'alamat' => 'Jl. Pettarani No.6',
                'id_jenis_bts' => 3,
                'latitude' => -5.1354,
                'longitude' => 119.4238,
                'tinggi_tower' => 57.00,
                'panjang_tanah' => 112.00,
                'lebar_tanah' => 57.00,
                'ada_genset' => true,
                'ada_tembok_batas' => true,
                'id_pemilik' => 6,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Batealit',
                'alamat' => 'Jl. Gatot Subroto No.7',
                'id_jenis_bts' => 1,
                'latitude' => 3.5916,
                'longitude' => 98.6698,
                'tinggi_tower' => 54.00,
                'panjang_tanah' => 108.00,
                'lebar_tanah' => 54.00,
                'ada_genset' => true,
                'ada_tembok_batas' => true,
                'id_pemilik' => 7,
                'created_by' => 1,
            ],
            [
                'nama' => 'BTS Nyalindung',
                'alamat' => 'Jl. Kapten A. Rivai No.8',
                'id_jenis_bts' => 2,
                'latitude' => -2.9909,
                'longitude' => 104.7562,
                'tinggi_tower' => 59.00,
                'panjang_tanah' => 118.00,
                'lebar_tanah' => 59.00,
                'ada_genset' => false,
                'ada_tembok_batas' => true,
                'id_pemilik' => 8,
                'created_by' => 1,
            ],
        ];

        $wilayahList = Wilayah::where('level', 2)->get();

        foreach ($btsList as $bts) {
            $wilayah = $wilayahList->random();
            $bts['id_wilayah'] = $wilayah->id;

            Bts::create($bts);
        }
    }
}
