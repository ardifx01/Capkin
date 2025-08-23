<?php

namespace Database\Seeders;

use App\Models\Indikator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indikator = [
            [
                'indikator' => 'Persentase pengguna data yang menggunakan data BPS sebagai dasar perencanaan, monitoring dan evaluasi pembangunan (%)',
                'sasaran_id' => '1'
            ],
            [
                'indikator' => 'Persentase publikasi statistik yang menerapkan standar akurasi (%)',
                'sasaran_id' => '1'
            ],
            [
                'indikator' => 'Persentase Organisasi Perangkat Daerah (OPD) yang mendapatkan rekomendasi kegiatan statistik (%)',
                'sasaran_id' => '2'
            ],
            [
                'indikator' => 'Persentase Organisasi Perangkat Daerah (OPD) yang menyampaikan metadata sektoral sesuai standar (%)',
                'sasaran_id' => '2'
            ],
            [
                'indikator' => 'Persentase Organisasi Perangkat Daerah (OPD) yang mendapatkan pembinaan statistik (%)',
                'sasaran_id' => '3'
            ],
            [
                'indikator' => 'Hasil penilaian implementasi SAKIP',
                'sasaran_id' => '4',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase kepuasan pengguna data terhadap sarana dan prasarana pelayanan BPS Provinsi (%)',
                'sasaran_id' => '4'
            ],
            [
                'indikator' => 'Persentase penyelesaian pelaksanaan pengadaan',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Jumlah laporan/dokumen keuangan yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Jumlah laporan/dokumen monitoring dan evaluasi yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Jumlah laporan/dokumen BMN yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Jumlah laporan/dokumen kepegawaian yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Jumlah laporan/dokumen kehumasan yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Jumlah laporan/dokumen dukungan manajemen lainnya yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Hasil penilaian implementasi SAKIP (IKU Kepala)',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase sarana prasarana dalam kondisi baik (Indikator penunjang IKU Kepala)',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase penyusunan Laporan Keuangan yang tepat waktu dan sesuai standar',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase pembayaran gaji dan tunjangan pegawai yang tepat waktu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase realisasi anggaran terhadap pagu',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase data kepegawaian yang di update',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Persentase usulan mutasi pegawai yang ditindaklanjuti',
                'sasaran_id' => '5',
                'bidang_id' => '1'
            ],
            [
                'indikator' => 'Response rate survei berbasis rumah tangga di wilayah BPS Provinsi',
                'sasaran_id' => '6'
            ],
            [
                'indikator' => 'Response rate survei berbasis usaha di wilayah BPS Provinsi',
                'sasaran_id' => '6'
            ],
            [
                'indikator' => 'Persentase rilis BRS yang dilakukan oleh Kepala BPS Provinsi',
                'sasaran_id' => '6'
            ],
            [
                'indikator' => 'Persentase rilis BRS yang dilakukan oleh Kepala BPS Provinsi dan melibatkan pejabat daerah',
                'sasaran_id' => '6'
            ],
            [
                'indikator' => 'Tingkat ketepatan waktu Pemerintah Daerah melakukan submit penilaian EPSS di wilayah BPS Provinsi',
                'sasaran_id' => '7'
            ],
            [
                'indikator' => 'Persentase Pemerintah Daerah di wilayah BPS Provinsi dengan nilai IPS kategori minimal baik',
                'sasaran_id' => '7'
            ],
            [
                'indikator' => 'Persentase Satker yang memperoleh predikat WBK/WBBM hasil penilaian Tim Penilai Internal (TPI)',
                'sasaran_id' => '8'
            ],
            [
                'indikator' => 'Nilai Maturitas SPIP',
                'sasaran_id' => '8'
            ],
            [
                'indikator' => 'Persentase Satker di wilayah BPS Provinsi yang mencapai kategori Nilai Kinerja Anggaran minimal "Baik"',
                'sasaran_id' => '8'
            ],
            [
                'indikator' => 'Indeks Pemantauan dan Evaluasi Kinerja Penyelenggaraan Pelayanan Publik',
                'sasaran_id' => '8'
            ],
        ];

        foreach ($indikator as $idktr) {
            Indikator::create($idktr);
        }
    }
}
