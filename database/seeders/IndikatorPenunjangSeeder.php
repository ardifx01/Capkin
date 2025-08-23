<?php

namespace Database\Seeders;

use App\Models\IndikatorPenunjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorPenunjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indikatorPenunjang = [
            [
                'indikator_penunjang' => 'Jumlah publikasi statistik yang terbit tepat waktu',
                'indikator_id' => '1'
            ],
            [
                'indikator_penunjang' => 'Jumlah rilis data statistik yang tepat waktu',
                'indikator_id' => '1'
            ],
            [
                'indikator_penunjang' => 'Jumlah pengunjung eksternal yang mengakses data dan informasi statistik melalui website BPS',
                'indikator_id' => '1'
            ],
            [
                'indikator_penunjang' => 'Jumlah publikasi statistik yang dihasilkan yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_id' => '2'
            ],
            [
                'indikator_penunjang' => 'Jumlah target publikasi statistik yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_id' => '2'
            ],
        ];

        foreach ($indikatorPenunjang as $idktrPnnjg) {
            IndikatorPenunjang::create([
                'indikator_penunjang' => $idktrPnnjg['indikator_penunjang'],
                'indikator_id' => $idktrPnnjg['indikator_id']
            ]);
        }
    }
}
