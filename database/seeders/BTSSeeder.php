<?php

namespace Database\Seeders;

use App\Models\Bts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BTSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bts::create([
            'nama' => 'BTS Jakarta Pusat',
            'alamat' => 'Jl. Medan Merdeka No.1, Jakarta',
            'id_jenis_bts' => 1,
            'latitude' => -6.175110,
            'longitude' => 106.865036,
            'tinggi_tower' => 50.00,
            'panjang_tanah' => 100.00,
            'lebar_tanah' => 50.00,
            'ada_genset' => true,
            'ada_tembok_batas' => true,
//            'id_user_pic' => 1,
            'id_pemilik' => 1,
            'id_wilayah' => 1,
            'created_by' => 1,
            'edited_by' => 1,
        ]);

        Bts::create([
            'nama' => 'BTS Surabaya',
            'alamat' => 'Jl. Gubeng No.2, Surabaya',
            'id_jenis_bts' => 2,
            'latitude' => -7.257472,
            'longitude' => 112.752090,
            'tinggi_tower' => 60.00,
            'panjang_tanah' => 120.00,
            'lebar_tanah' => 60.00,
            'ada_genset' => false,
            'ada_tembok_batas' => true,
//            'id_user_pic' => 2,
            'id_pemilik' => 2,
            'id_wilayah' => 2,
            'created_by' => 1,
            'edited_by' => 1,
        ]);

        Bts::create([
            'nama' => 'BTS Bandung',
            'alamat' => 'Jl. Asia Afrika No.3, Bandung',
            'id_jenis_bts' => 3,
            'latitude' => -6.917464,
            'longitude' => 107.619123,
            'tinggi_tower' => 55.00,
            'panjang_tanah' => 110.00,
            'lebar_tanah' => 55.00,
            'ada_genset' => true,
            'ada_tembok_batas' => false,
//            'id_user_pic' => 3,
            'id_pemilik' => 3,
            'id_wilayah' => 3,
            'created_by' => 1,
            'edited_by' => 1,
        ]);
    }
}
