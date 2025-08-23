<?php

namespace App\Exports;

use App\Models\DataIku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataIkuExport implements FromCollection, WithHeadings, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Header row
        ];
    }

    /**
     * Mengambil data dari model DataIku.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DataIku::select(
            'sub_indikator_id',
            'perjanjian_kinerja_target_kumulatif',
            'perjanjian_kinerja_realisasi_kumulatif',
            'capaian_kinerja_kumulatif',
            'capaian_kinerja_target_setahun',
            'link_bukti_dukung_capaian',
            'upaya_yang_dilakukan',
            'link_bukti_dukung_upaya_yang_dilakukan',
            'kendala',
            'solusi_atas_kendala',
            'rencana_tidak_lanjut',
            'pic_tidak_lanjut',
            'tenggat_tidak_lanjut'
        )->get();
        return $data;
    }

    /**
     * Menyediakan header untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Sub Indikator ID',
            'Target Kumulatif',
            'Realisasi Kumulatif',
            'Capaian Kumulatif',
            'Target Setahun',
            'Link Bukti Dukung Capaian',
            'Upaya yang Dilakukan',
            'Link Bukti Dukung Upaya',
            'Kendala',
            'Solusi Atas Kendala',
            'Rencana Tindak Lanjut',
            'PIC Tindak Lanjut',
            'Tenggat Tindak Lanjut',
        ];
    }
}
