<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tujuan;
use App\Models\DataIku;
use App\Models\Indikator;
use Illuminate\Support\Facades\DB;

class PimpinanController extends Controller
{
    public function view_master_data()
    {
        // Mengambil data IKU
        $iku = Tujuan::where('iku', 0)
            ->whereIn('id', [1, 2, 3, 4])
            ->with(['sasaran.indikator.indikator_penunjang.sub_indikator.bidang'])
            ->get();

        $iku_sup = Tujuan::where('iku', 1)
            ->with(['sasaran.indikator.indikator_penunjang', 'sasaran.indikator.sub_indikator'])
            ->get();

        // Mengambil data berdasarkan sub-indikator yang disetujui
        $data_iku_by_sub_indikator = DataIku::where('status', 'approved')
            ->select(
                'sub_indikator_id',
                'link_bukti_dukung_capaian',
                'upaya_yang_dilakukan',
                'link_bukti_dukung_upaya_yang_dilakukan',
                'kendala',
                'solusi_atas_kendala',
                'rencana_tidak_lanjut',
                'pic_tidak_lanjut',
                'tenggat_tidak_lanjut'
            )
            ->get()
            ->groupBy('sub_indikator_id');

        // Mengelompokkan data penunjang berdasarkan triwulan
        $data_iku_by_triwulan = DataIku::where('status', 'approved')
            ->select(
                'sub_indikator_id',
                'triwulan_id',
                'perjanjian_kinerja_target_kumulatif',
                'perjanjian_kinerja_realisasi_kumulatif',
                'capaian_kinerja_kumulatif',
                'capaian_kinerja_target_setahun'
            )
            ->get()
            ->groupBy('sub_indikator_id');

        // Mengelompokkan data berdasarkan triwulan_id
        $data_penunjang_by_triwulan = $data_iku_by_triwulan->map(function ($items) {
            return $items->groupBy('triwulan_id');
        });

        // Mengambil data indikator
        $indikator = Indikator::all();

        //Menghitung sub-indikator yang belum terisi
        $bidang_counts_unfil = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.bidang_id', DB::raw('count(md_sub_indikator.id) as total'), DB::raw('count(data_iku.id) as filled'))
            ->groupBy('md_sub_indikator.bidang_id')
            ->get()
            ->keyBy('bidang_id')
            ->map(function ($item) {
                return $item->total - $item->filled;
            });


        // Menghitung sub-indikator yang terisi berdasarkan triwulan
        $bidang_counts = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.bidang_id', 'data_iku.triwulan_id', DB::raw('count(data_iku.id) as filled'))
            ->where('data_iku.status', 'approved') // Tambahkan kondisi ini
            ->whereIn('data_iku.triwulan_id', [1, 2, 3, 4])
            ->groupBy('md_sub_indikator.bidang_id', 'data_iku.triwulan_id')
            ->get()
            ->groupBy('bidang_id', 'triwulan_id');

        // Menghitung total realisasi kumulatif per triwulan untuk setiap bidang
        $realisasi_total_by_bidang = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.bidang_id', 'data_iku.triwulan_id', DB::raw('sum(data_iku.perjanjian_kinerja_realisasi_kumulatif) as total_realisasi'))
            ->where('data_iku.status', 'approved')
            ->whereIn('data_iku.triwulan_id', [1, 2, 3, 4])
            ->groupBy('md_sub_indikator.bidang_id', 'data_iku.triwulan_id')
            ->get()
            ->groupBy('bidang_id');


        // Menghitung total target kumulatif per triwulan untuk setiap bidang dan indikator penunjang
        $target_total_by_indikator_penunjang = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.indikator_penunjang_id', 'data_iku.triwulan_id', DB::raw('sum(data_iku.perjanjian_kinerja_target_kumulatif) as total_target'))
            ->where('data_iku.status', 'approved')
            ->whereIn('data_iku.triwulan_id', [1, 2, 3, 4])
            ->groupBy('md_sub_indikator.indikator_penunjang_id', 'data_iku.triwulan_id')
            ->get()
            ->groupBy('indikator_penunjang_id');


        return view('pimpinan.dashboard', [
            'iku' => $iku,
            'data_iku_by_triwulan' => $data_penunjang_by_triwulan,
            'data_iku_by_sub_indikator' => $data_iku_by_sub_indikator,
            'indikator' => $indikator,
            'bidang_counts' => $bidang_counts,
            'bidang_counts_unfill' => $bidang_counts_unfil,
            'iku_sup' => $iku_sup,
            'realisasi_total_by_bidang' => $realisasi_total_by_bidang,
            'target_total_by_indikator_penunjang' => $target_total_by_indikator_penunjang,
        ]);
    }
}
