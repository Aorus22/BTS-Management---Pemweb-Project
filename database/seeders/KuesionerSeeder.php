<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kuesioner;
use App\Models\Pilihan_Kuesioner;

class KuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'pertanyaan' => 'Bagaimana kondisi kebersihan area sekitar BTS?',
                'choices' => ['Sangat Bersih', 'Bersih', 'Cukup Bersih', 'Kotor', 'Sangat Kotor']
            ],
            [
                'pertanyaan' => 'Seberapa baik kondisi fisik tower BTS?',
                'choices' => ['Tidak ada kerusakan', 'Kerusakan minor', 'Kerusakan sedang', 'Kerusakan parah']
            ],
            [
                'pertanyaan' => 'Bagaimana penataan kabel di sekitar BTS?',
                'choices' => ['Sangat Rapi', 'Rapi', 'Cukup Rapi', 'Tidak Rapi']
            ],
            [
                'pertanyaan' => 'Apakah ada tanda-tanda korosi pada struktur tower?',
                'choices' => ['Tidak ada korosi', 'Korosi minor', 'Korosi sedang', 'Korosi parah']
            ],
            [
                'pertanyaan' => 'Bagaimana kondisi sumber listrik utama?',
                'choices' => ['Berfungsi dengan baik', 'Sering mati', 'Tidak stabil', 'Mati']
            ],
            [
                'pertanyaan' => 'Seberapa baik kondisi baterai cadangan?',
                'choices' => ['Sangat baik', 'Baik', 'Cukup', 'Buruk']
            ],
            [
                'pertanyaan' => 'Bagaimana kondisi dan kinerja genset cadangan?',
                'choices' => ['Berfungsi dengan baik dan telah diuji', 'Berfungsi tapi belum diuji', 'Tidak berfungsi', 'Tidak ada genset']
            ],
            [
                'pertanyaan' => 'Bagaimana kondisi perangkat BTS secara keseluruhan?',
                'choices' => ['Semua perangkat berfungsi dengan baik', 'Beberapa perangkat berfungsi dengan baik', 'Beberapa perangkat bermasalah', 'Banyak perangkat bermasalah']
            ],
            [
                'pertanyaan' => 'Apakah ada masalah dengan konektivitas BTS?',
                'choices' => ['Tidak ada masalah', 'Masalah minor', 'Masalah sedang', 'Masalah parah']
            ],
            [
                'pertanyaan' => 'Seberapa sering perangkat BTS mengalami restart?',
                'choices' => ['Tidak pernah', 'Jarang', 'Kadang-kadang', 'Sering']
            ],
            [
                'pertanyaan' => 'Bagaimana tingkat keamanan di sekitar BTS?',
                'choices' => ['Sangat Aman', 'Aman', 'Cukup Aman', 'Tidak Aman']
            ],
            [
                'pertanyaan' => 'Apakah ada sistem keamanan seperti CCTV yang berfungsi dengan baik?',
                'choices' => ['Semua berfungsi', 'Sebagian berfungsi', 'Tidak berfungsi', 'Tidak ada CCTV']
            ],
        ];

        foreach ($questions as $question) {
            $kuesioner = Kuesioner::create([
                'pertanyaan' => $question['pertanyaan'],
                'created_by' => 1,
            ]);

            foreach ($question['choices'] as $choice) {
                Pilihan_Kuesioner::create([
                    'id_kuesioner' => $kuesioner->id,
                    'pilihan_jawaban' => $choice,
                    'created_by' => 1, 
                ]);
            }
        }
    }
}
