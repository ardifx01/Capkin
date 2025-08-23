<?php

namespace Database\Seeders;

use App\Models\Triwulan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TriwulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $triwulan = [
            [
                'triwulan' => 'Triwulan 1',
            ],
            [
                'triwulan' => 'Triwulan 2',
            ],
            [
                'triwulan' => 'Triwulan 3',
            ],
            [
                'triwulan' => 'Triwulan 4',
            ],
        ];

        foreach($triwulan as $trwln){
            Triwulan::create($trwln);
        }
    }
}
