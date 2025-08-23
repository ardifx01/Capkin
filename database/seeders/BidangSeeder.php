<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidang = [
            [
                "nama_bidang" => "Bagian Umum",
            ],
            [
                "nama_bidang" => "Fungsi Statistik Sosial",
            ],
            [
                "nama_bidang" => "Fungsi Statistik Produksi",
            ],
            [
                "nama_bidang" => "Fungsi Statistik Distribusi",
            ],
            [
                "nama_bidang" => "Fungsi Nerwilis",
            ],
            [
                "nama_bidang" => "Fungsi IPDS",
            ],
            [
                "nama_bidang" => "Pimpinan",
            ],
        ];

        foreach ($bidang as $nama_bidang) {
            Bidang::create([
                'nama_bidang' => $nama_bidang['nama_bidang']
            ]);
        }
    }
}
