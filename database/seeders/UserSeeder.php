<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangUmum = Bidang::where('nama_bidang', 'Bagian Umum')->first();
        $bidangStatSosial = Bidang::where('nama_bidang', 'Fungsi Statistik Sosial')->first();
        $bidangStatProduksi = Bidang::where('nama_bidang', 'Fungsi Statistik Produksi')->first();
        $bidangStatDistribusi = Bidang::where('nama_bidang', 'Fungsi Statistik Distribusi')->first();
        $bidangNerwilis = Bidang::where('nama_bidang', 'Fungsi Nerwilis')->first();
        $bidangIPDS = Bidang::where('nama_bidang', 'Fungsi IPDS')->first();
        $pimpinan = Bidang::where('nama_bidang', 'Pimpinan')->first();
        
        $users = [

            // PIMPINAN
            [
                "name" => "Joe Gon",
                "email" => "pimpinan@gmail.com",
                "password" => "bps123",
                "role" => "4",
                "nip" => "222",
                "bidang_id" => $pimpinan->id
            ],

            // ADMIN SISTTEM
            [
                "name" => "John Doe",
                "email" => "adminsistem@gmail.com",
                "password" => "bps123",
                "role" => "3",
                "nip" => "132131231231312313124",
                "bidang_id" => $bidangIPDS->id
            ],

            // ADMIN BINAGRAM
            [
                "name" => "Mils Way",
                "email" => "adminbinagram@gmail.com",
                "password" => "bps123",
                "role" => "2",
                "nip" => "132131231231312313125",
                "bidang_id" => $bidangIPDS->id
            ],

            // ADMIN APPROVAL
            [
                "name" => "Clerk Emily",
                "email" => "approvalsosial@gmail.com",
                "password" => "bps123",
                "role" => "1",
                "nip" => "132131231231312313126",
                "bidang_id" => $bidangStatSosial->id
            ],
            [
                "name" => "Jehan Roy",
                "email" => "approvalumum@gmail.com",
                "password" => "bps123",
                "role" => "1",
                "nip" => "132131231231312315232",
                "bidang_id" => $bidangUmum->id
            ],
            [
                "name" => "Komer Sihan",
                "email" => "approvalproduksi@gmail.com",
                "password" => "bps123",
                "role" => "1",
                "nip" => "132131231231312315233",
                "bidang_id" => $bidangStatProduksi->id
            ],
            [
                "name" => "Celo Shank",
                "email" => "approvaldistribusi@gmail.com",
                "password" => "bps123",
                "role" => "1",
                "nip" => "132131231231312315234",
                "bidang_id" => $bidangStatDistribusi->id
            ],
            [
                "name" => "Suhail Miwa",
                "email" => "approvalnerwilis@gmail.com",
                "password" => "bps123",
                "role" => "1",
                "nip" => "132131231231312315235",
                "bidang_id" => $bidangNerwilis->id
            ],
            [
                "name" => "King Jhon",
                "email" => "approvalipds@gmail.com",
                "password" => "bps123",
                "role" => "1",
                "nip" => "132131231231312315236",
                "bidang_id" => $bidangIPDS->id
            ],

            // OPERATOR
            [
                "name" => "Ronald Roy",
                "email" => "umum@gmail.com",
                "password" => "bps123",
                "role" => "0",
                "nip" => "132131231231312313126873",
                "bidang_id" => $bidangUmum->id
            ],
            [
                "name" => "Jakie Chan",
                "email" => "sosial@gmail.com",
                "password" => "bps123",
                "role" => "0",
                "nip" => "132131231231312313126891",
                "bidang_id" => $bidangStatSosial->id
            ],
            [
                "name" => "Marie Lim",
                "email" => "produksi@gmail.com",
                "password" => "bps123",
                "role" => "0",
                "nip" => "132131231231312313126892",
                "bidang_id" => $bidangStatProduksi->id
            ],
            [
                "name" => "Ana Sher",
                "email" => "distribusi@gmail.com",
                "password" => "bps123",
                "role" => "0",
                "nip" => "132131231231312313126893",
                "bidang_id" => $bidangStatDistribusi->id
            ],
            [
                "name" => "Medya Boo",
                "email" => "nerwilis@gmail.com",
                "password" => "bps123",
                "role" => "0",
                "nip" => "132131231231312313126894",
                "bidang_id" => $bidangNerwilis->id
            ],
            [
                "name" => "Rada Loyu",
                "email" => "ipds@gmail.com",
                "password" => "bps123",
                "role" => "0",
                "nip" => "132131231231312313126895",
                "bidang_id" => $bidangIPDS->id
            ],
        ];

        foreach ($users as $user) {
            User::create([
                "name" => $user['name'],
                "email" => $user['email'],
                "password" => Hash::make($user['password']),
                "remember_token" => Str::random(50),
                "role" => $user['role'],
                "nip" => $user['nip'],
                "bidang_id" => $user['bidang_id']
            ]);
        }
    }
}
