<?php

namespace Database\Seeders;

use App\Models\SubIndikator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubIndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subIndikator = [
            // *****************************************
            // Sasaran 1
            // *****************************************
            // *****************************************
            // Indikator Penunjang 1
            // *****************************************
            // *****************************************
            // Target dan Realisasi Tim Statistik Sosial
            // *****************************************
            [
                'sub_indikator' => 'Selayang Pandang Kesejahteraan Rakyat Provinsi Riau 2023 (23-02-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Keadaan Angkatan Kerja di Provinsi Riau Agustus 2023 (23-04-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Penghitungan dan Analisis Kemiskinan Makro Provinsi Riau 2023 (28-03-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Konsumsi Penduduk Provinsi Riau 2023 (26-04-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Indikator Pasar Tenaga Kerja Provinsi Riau Agustus 2023 (30-04-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Pendidikan Provinsi Riau 2023 (28-06-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Politik dan Keamanan Provinsi Riau 2023 (31-07-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Perumahan Provinsi Riau 2023 (26-08-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Indikator Pasar Tenaga Kerja Provinsi Riau Februari 2023 (25-10-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Keadaan Angkatan Kerja di Provinsi Riau Februari 2023 (11-10-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Kesejahteraan Rakyat Provinsi Riau 2024 (13-12-2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '2'
            ],

            // *****************************************
            // Target dan Realisasi Tim Statistik Produksi
            // *****************************************

            [
                'sub_indikator' => 'Profil Industri Mikro dan Kecil Provinsi Riau 2022 (25 Maret 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Ringkasan Eksekutif Luas Panen dan Produksi Padi di Provinsi Riau, 2023 (6 Juni 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Luas Panen dan Produksi Padi di Provinsi Riau, 2023 (16 September 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Statistik Tanaman Sayuran dan Buah-buahan Provinsi Riau 2023 (19 September 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Statistik Pemotongan Ternak Provinsi Riau 2023 (10 Oktober 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Direktori Perusahaan Konstruksi  Provinsi Riau Tahun 2024 ( 18 November 2024 )',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Direktori Industri Manufaktur Besar dan Sedang Provinsi Riau 2024 (9 Desember 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Statistik Industri Besar dan Sedang Provinsi Riau 2022 (16 Desember 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Statistik Air Bersih  Provinsi RiauTahun 2024 (23 Desember 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Statistik Kelapa Sawit Provinsi Riau 2022 (31 Januari 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '3'
            ],

            // *****************************************
            // Target dan Realisasi Tim Statistik Distribusi
            // *****************************************

            [
                'sub_indikator' => 'Indeks Harga Konsumen Gabungan 3 Kota di Provinsi Riau 2023 (23 Februari 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Inflasi Triwulanan (Q to Q) Gabungan 3 Kota di Provinsi Riau Triwulan IV 2023 (8 Maret 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Nilai Tukar Petani Provinsi Riau 2023 (17 Mei 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Inflasi Triwulanan (Q to Q) Provinsi Riau Triwulan I 2024 (17 Mei 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Produsen Harga Perdesaan Provinsi Riau Non Makanan Tahun 2023 (16 Juli 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Nilai Tukar Petani Semester 1 2024 (31 Agustus 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Keuangan Pemerintah Daerah se-Provinsi Riau 2022-2023 (6 September 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Indeks Harga Konsumen Provinsi Riau Semester I 2024 (13 September 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Keuangan Pemerintah Desa Provinsi Riau APBDes 2022, Realisasi 2022 dan APBDes 2023 (30 September 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Inflasi Triwulanan (Q to Q) Provinsi Riau Triwulan II 2024 (4 Oktober 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Inflasi Triwulanan (Q to Q) Provinsi Riau Triwulan III 2024 (15 November 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Harga Konsumen Perdesaan Provinsi Riau Tahun 2023 Makanan (2 Desember 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Indeks Kemahalan Konstruksi Provinsi Riau 2024 (6 Desember 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Publikasi Angkutan Udara 2023 (26 April 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Jasa Akomodasi Provinsi Riau 2023 (30 Juli 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Perdagangan Luar Negeri Kabupaten/Kota tahun 2023 (6 Agustus 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Statistik Perdagangan Luar Negeri Provinsi Riau tahun 2023 (6 Agustus 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Direktori Hotel dan Jasa Akomodasi Lainnya Provinsi Riau 2023 (16 Agustus 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '4'
            ],

            // *****************************************
            // Target dan Realisasi Tim Nerwilis
            // *****************************************

            [
                'sub_indikator' => 'Overview 2023 (28 Maret 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'PDRB Provinsi Riau Menurut Pengeluaran 2019-2023 (4 April 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'PDRB Provinsi Riau Menurut Lapangan Usaha 2019-2023 (4 April)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Posisi Riau Di Tingkat Nasional 2023 (30 April 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'PDRB Provinsi Riau Kabupaten/Kota di Provinsi Riau Menurut Pengeluaran 2019-2023 (28 Juni)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'PDRB Provinsi Riau Kabupaten/Kota di Provinsi Riau Menurut Lapangan Usaha 2019-2023 (28 Juni)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Potensi Pertanian Provinsi Riau 2023 (31 Juli 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Laporan Perekonomian Provinsi Riau 2023 (31 Juli 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Indikator Pembangunan Manusia dan Gender Provinsi Riau 2023 (30 Agustus 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Statistik Daerah Provinsi Riau 2024 (26 September 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Analisis Isu Terkini (September)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Overview Semester I 2024 (Oktober)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Indikator Kesejahteraan Rakyat Provinsi Riau 2024 (29 November 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Indikator Tujuan Pembangunan Berkelanjutan Provinsi Riau 2024 (Desember)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '5'
            ],

            // *****************************************
            // Target dan Realisasi Tim IPDS
            // *****************************************

            [
                'sub_indikator' => 'Provinsi Riau Dalam Angka 2024 (28 Februari 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '6'
            ],
            [
                'sub_indikator' => 'Master File Wilayah Kerja Statistik Provinsi Riau 2023 (30 April 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '6'
            ],
            [
                'sub_indikator' => 'Katalog Publikasi BPS Provinsi Riau 2023 (30 September 2023)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '6'
            ],
            [
                'sub_indikator' => 'Analisis Hasil Survei Kebutuhan Data BPS Provinsi Riau 2024  ( 6 Desember 2024)',
                'indikator_penunjang_id' => '1',
                'bidang_id' => '6'
            ],

            // *****************************************
            // Indikator Penunjang 2
            // *****************************************

            [
                'sub_indikator' => 'Perkembangan Indeks Harga Konsumen',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Perkembangan Nilai Tukar Petani',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Perkembangan Pariwisata',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Profil Kemiskinan',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Tingkat Ketimpangan Pengeluaran Penduduk',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Perkembangan Ekspor dan Impor',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Pertumbuhan Ekonomi',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Indeks Pembangunan Manusia (IPM)',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Keadaan Ketenagakerjaan',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Luas Panen dan Produksi Padi ',
                'indikator_penunjang_id' => '2',
                'bidang_id' => '3'
            ],

            // *****************************************
            // Indikator Penunjang 3
            // *****************************************
            // *****************************************
            // Jumlah publikasi statistik sosial yang 
            // dihasilkan yang bersumber dari aktivitas 
            // statistik menerapkan standar akurasi
            // *****************************************

            [
                'sub_indikator' => 'Selayang Pandang Kesejahteraan Rakyat Provinsi Riau 2023 (23-02-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Penghitungan dan Analisis Kemiskinan Makro Provinsi Riau 2023 (28-03-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Keadaan Angkatan Kerja di Provinsi Riau Agustus 2023 (23-04-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Konsumsi Penduduk Provinsi Riau 2023 (26-04-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Indikator Pasar Tenaga Kerja Provinsi Riau Agustus 2023 (30-04-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Pendidikan Provinsi Riau 2023 (28-06-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Politik dan Keamanan Provinsi Riau 2023 (31-07-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Perumahan Provinsi Riau 2023 (26-08-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Keadaan Angkatan Kerja di Provinsi Riau Februari 2023 (11-10-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Indikator Pasar Tenaga Kerja Provinsi Riau Februari 2023 (25-10-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Statistik Kesejahteraan Rakyat Provinsi Riau 2024 (13-12-2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '2'
            ],

            // *****************************************
            // Jumlah publikasi statistik produksi yang 
            // dihasilkan yang bersumber dari aktivitas 
            // statistik menerapkan standar akurasi
            // *****************************************

            [
                'sub_indikator' => 'Profil Industri Mikro dan Kecil Provinsi Riau 2022 (25 Maret 2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '3'
            ],

            // *****************************************
            // Jumlah publikasi statistik distribusi yang 
            // dihasilkan yang bersumber dari aktivitas 
            // statistik menerapkan standar akurasi
            // *****************************************

            [
                'sub_indikator' => 'Statistik Keuangan Pemerintah Desa Provinsi Riau APBDes 2022, Realisasi 2022 dan APBDes 2023  (30 September)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '4'
            ],

            // *****************************************
            // Jumlah publikasi statistik nerwilis yang 
            // dihasilkan yang bersumber dari aktivitas 
            // statistik menerapkan standar akurasi
            // *****************************************

            [
                'sub_indikator' => 'PDRB Provinsi Riau Menurut Pengeluaran 2019-2023 (4 April 2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'PDRB Provinsi Riau Menurut Lapangan Usaha 2019-2023 (4 April 2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Statistik Daerah Provinsi Riau 2024 (26 September 2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Indikator Kesejahteraan Rakyat Provinsi Riau 2024 (29 November 2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '5'
            ],

            // *****************************************
            // Jumlah publikasi IPDS yang dihasilkan 
            // yang bersumber dari aktivitas statistik 
            // menerapkan standar akurasi
            // *****************************************

            [
                'sub_indikator' => 'Provinsi Riau Dalam Angka 2024 (28 Februari 2024)',
                'indikator_penunjang_id' => '4',
                'bidang_id' => '6'
            ],

            // *****************************************
            // Indikator Penunjang 4
            // *****************************************
            // *****************************************
            // Jumlah target publikasi statistik yang 
            // bersumber dari aktivitas statistik 
            // menerapkan standar akurasi
            // *****************************************

            [
                'sub_indikator' => 'Jumlah target publikasi statistik sosial yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_penunjang_id' => '5',
                'bidang_id' => '2'
            ],
            [
                'sub_indikator' => 'Jumlah target publikasi statistik produksi yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_penunjang_id' => '5',
                'bidang_id' => '3'
            ],
            [
                'sub_indikator' => 'Jumlah target publikasi statistik distribusi yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_penunjang_id' => '5',
                'bidang_id' => '4'
            ],
            [
                'sub_indikator' => 'Jumlah target publikasi statistik nerwilis yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_penunjang_id' => '5',
                'bidang_id' => '5'
            ],
            [
                'sub_indikator' => 'Jumlah target publikasi IPDS yang bersumber dari aktivitas statistik menerapkan standar akurasi',
                'indikator_penunjang_id' => '5',
                'bidang_id' => '6'
            ],

            // *****************************************
            // Sasaran 2
            // *****************************************

            [
                'sub_indikator' => 'Jumlah Organisasi Perangkat Daerah (OPD) yang mendapatkan rekomendasi kegiatan statistik',
                'indikator_id' => '3',
            ],
            [
                'sub_indikator' => 'Jumlah Organisasi Perangkat Daerah (OPD) yang menjadi target pembinaan',
                'indikator_id' => '3',
            ],
            [
                'sub_indikator' => 'Jumlah Organisasi Perangkat Daerah (OPD) yang menyampaikan metadata sektoral sesuai standar',
                'indikator_id' => '4',
            ],
            [
                'sub_indikator' => 'Jumlah Organisasi Perangkat Daerah (OPD) yang melakukan kegiatan statistik',
                'indikator_id' => '4',
            ],

            // *****************************************
            // Sasaran 3
            // *****************************************

            [
                'sub_indikator' => 'Jumlah Organisasi Perangkat Daerah (OPD) yang mendapatkan pembinaan statistik',
                'indikator_id' => '5',
            ],
            [
                'sub_indikator' => 'Jumlah Organisasi Perangkat Daerah (OPD) yang menjadi target pembinaan statistik',
                'indikator_id' => '5',
            ],

            // *****************************************
            // Sasaran 4
            // *****************************************

            [
                'sub_indikator' => 'Persentase sarana prasarana dalam kondisi baik',
                'indikator_id' => '7',
            ],
            [
                'sub_indikator' => 'Jumlah pengunjung langsung Pelayanan Statistik Terpadu (PST)',
                'indikator_id' => '7',
            ],

            // *****************************************
            // Sasaran 5
            // *****************************************

            [
                'sub_indikator' => 'Jumlah pengadaan kendaraan bermotor',
                'indikator_id' => '8',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Jumlah pengadaan perangkat pengolah data dan komunikasi',
                'indikator_id' => '8',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Jumlah pengadaan peralatan fasilitas perkantoran',
                'indikator_id' => '8',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Luas pembangunan/renovasi gedung dan bangunan',
                'indikator_id' => '8',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Luas pengadaan tanah untuk pembangunan/renovasi gedung dan bangunan',
                'indikator_id' => '8',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Jumlah paket pengadaan barang dan jasa lainnya',
                'indikator_id' => '8',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan BPS Provinsi Riau Untuk Periode yang Berakhir 31 Desember 2023 (Unaudited)',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan Wilayah Riau Untuk Periode yang Berakhir 31 Desember 2023 (Unaudited)',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan BPS Provinsi Riau Untuk Periode yang Berakhir 31 Desember 2023 (Audited)',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan  Wilayah Riau Untuk Periode yang Berakhir 31 Desember 2023 (Audited)',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan BPS Provinsi Riau Untuk Periode yang Berakhir 30 Juni 2024',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan Wilayah Riau Untuk Periode yang Berakhir 30 Juni 2024',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan BPS Provinsi Riau Untuk Periode yang Berakhir 30 September 2024',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Keuangan Wilayah Riau Untuk Periode yang Berakhir 30 September 2024',
                'indikator_id' => '9',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Monev Capaian Kinerja Triwulan IV 2023',
                'indikator_id' => '10',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Kinerja 2023',
                'indikator_id' => '10',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Monev Capaian Kinerja Triwulan I 2024',
                'indikator_id' => '10',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Monev Capaian Kinerja Triwulan II 2024',
                'indikator_id' => '10',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Monev Capaian Kinerja Triwulan III 2024',
                'indikator_id' => '10',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan BMN Tahunan 2023 Satker',
                'indikator_id' => '11',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan BMN Tahunan 2023 Wilayah',
                'indikator_id' => '11',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan BMN Semester I 2024 Satker',
                'indikator_id' => '11',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan BMN Semester I 2024 Wilayah',
                'indikator_id' => '11',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan BMN Triwulan III 2024 Satker',
                'indikator_id' => '11',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan BMN Triwulan III 2024 Wilayah',
                'indikator_id' => '11',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Perjanjian Kinerja 2024',
                'indikator_id' => '14',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Survei Satuan Harga Barang Dan Jasa 2024',
                'indikator_id' => '14',
                'bidang_id' => '1'
            ],
            [
                'sub_indikator' => 'Laporan Pengadaan Barang Dan Jasa 2024',
                'indikator_id' => '14',
                'bidang_id' => '1'
            ],
        ];

        foreach ($subIndikator as $sbidktr) {
            SubIndikator::create($sbidktr);
        }
    }
}
