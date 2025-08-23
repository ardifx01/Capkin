<?php

namespace Database\Seeders;

use App\Models\Tujuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tujuan = [
            [
                'tujuan' => 'Menyediakan data statistik untuk dimanfaatkan sebagai dasar pembangunan',
                'iku' => '0'
            ],
            [
                'tujuan' => 'Meningkatnya kolaborasi, integrasi, dan standardisasi dalam penyelenggaraan SSN',
                'iku' => '0'
            ],
            [
                'tujuan' => 'Meningkatnya pelayanan prima dalam penyelenggaraan SSN',
                'iku' => '0'
            ],
            [
                'tujuan' => 'Penguatan tata kelola kelembagaan dan reformasi birokrasi',
                'iku' => '0'
            ],
            [
                'tujuan' => 'Bagian Umum',
                'iku' => '0'
            ],
            [
                'tujuan' => 'Menyediakan data statistik untuk dimanfaatkan sebagai dasar pembangunan',
                'iku' => '1'
            ],
            [
                'tujuan' => 'Meningkatnya pelayanan prima dalam penyelenggaraan SSN',
                'iku' => '1'
            ],
            [
                'tujuan' => 'Penguatan tata kelola kelembagaan dan reformasi birokrasi',
                'iku' => '1'
            ],
        ];

        foreach ($tujuan as $tjn) {
            Tujuan::create([
                'tujuan' => $tjn['tujuan'],
                'iku' =>$tjn['iku']
            ]);
        }
    }
}
