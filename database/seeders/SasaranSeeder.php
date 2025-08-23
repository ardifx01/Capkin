<?php

namespace Database\Seeders;

use App\Models\Sasaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SasaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sasaran = [
            [
                'sasaran' => 'Meningkatnya pemanfaatan data statistik yang berkualitas',
                'tujuan_id' => '1'
            ],
            [
                'sasaran' => 'Penguatan komitmen K/L/D/I terhadap SSN',
                'tujuan_id' => '2'
            ],
            [
                'sasaran' => 'Penguatan statistik sektoral K/L/D/I',
                'tujuan_id' => '3'
            ],
            [
                'sasaran' => 'SDM Statistik yang unggul dan berdaya saing dalam kerangka tata kelola kelembagaan',
                'tujuan_id' => '4'
            ],
            [
                'sasaran' => 'Bagian Umum',
                'tujuan_id' => '5'
            ],
            [
                'sasaran' => 'Meningkatnya pemanfaatan data statistik yang berkualitas',
                'tujuan_id' => '6'
            ],
            [
                'sasaran' => 'Penguatan statistik sektoral K/L/D/I',
                'tujuan_id' => '7'
            ],
            [
                'sasaran' => 'SDM Statistik yang unggul dan berdaya saing dalam kerangka tata kelola kelembagaan',
                'tujuan_id' => '8'
            ],
        ];

        foreach ($sasaran as $ssrn) {
            Sasaran::create([
                "sasaran" => $ssrn['sasaran'],
                "tujuan_id" => $ssrn['tujuan_id']
            ]);
        }
    }
}
