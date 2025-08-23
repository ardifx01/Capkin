@extends('layouts.app')

@section('title', 'Admin Binagram Dashboard')

@section('content')

    <div class="flex flex-wrap gap-4 p-3"> <!-- Pembungkus Flexbox -->
        @foreach ($indikator as $key => $ind)
            @if (in_array($ind->sasaran->tujuan->id, [1, 2, 3, 4]))
                @component('components.indikator-card', ['ind' => $ind])
                @endcomponent
            @endif
        @endforeach
    </div>

    <!-- EXPORTEXCEL -->
    <div class="w-full flex justify-end mt-10">
        <a href="{{ route('export-excel') }}">
            <button
                class="flex items-center gap-2 bg-green-400 text-black py-3 px-6 rounded-md font-medium hover:bg-neutral-400 transition-all">
                Export Excel
                <i class="fas fa-file-excel"></i>
            </button>
        </a>
    </div>

    <div class="my-5 bg-gray-100 p-5 rounded shadow overflow-x-scroll max-h-[500px]">
        <table class="border w-full min-w-max table-auto">
            <thead class="text-sm">
                <tr>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">
                        Tujuan/Sasaran/Indikator</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Satuan</th>
                    <th colspan="4" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Target Kumulatif
                    </th>
                    <th colspan="4" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Realisasi
                        Kumulatif</th>
                    <th colspan="4" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Capaian
                        Kumulatif</th>
                    <th colspan="4" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Capaian Terhadap
                        Target Setahun</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Link Bukti
                        Dukung Capaian</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Upaya yang
                        Dilakukan</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Link Bukti
                        Dukung Upaya</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Kendala</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Solusi atas
                        Kendala</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Rencana Tindak
                        Lanjut</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">PIC Tindak
                        Lanjut</th>
                    <th rowspan="2" class="bg-yellow-300 border-black p-3 md:border-2 whitespace-nowrap">Tenggat Tindak
                        Lanjut</th>
                </tr>
                <tr>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW I</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW II</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW III</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW IV</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW I</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW II</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW III</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW IV</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW I</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW II</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW III</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW IV</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW I</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW II</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW III</th>
                    <th class="bg-yellow-300 border-black p-2 md:border-2 whitespace-nowrap">TW IV</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iku as $tujuan)
                    <tr>
                        <td colspan="28" class="bg-blue-100 border border-gray-400 p-2 font-bold">
                            [TUJUAN] {{ $tujuan->tujuan }}
                        </td>
                    </tr>
                    @foreach ($tujuan->sasaran as $sasaran)
                        <tr>
                            <td colspan="28" class="bg-green-100 border border-gray-400 p-2 pl-5">
                                [SASARAN] {{ $sasaran->sasaran }}
                            </td>
                        </tr>
                        @foreach ($sasaran->indikator as $indikator)
                            <tr>
                                <td colspan="28" class="bg-yellow-100 border border-gray-400 p-2 pl-10">
                                    [INDIKATOR] {{ $indikator->indikator }}
                                </td>
                            </tr>
                            @foreach ($indikator->indikator_penunjang as $indikator_penunjang)
                                @php
                                    // Ambil total target kumulatif per triwulan dari sub-indikator yang terkait dengan indikator penunjang ini
                                    $sub_indikator_data = $target_total_by_indikator_penunjang->get(
                                        $indikator_penunjang->id,
                                    );
                                    $triwulan_1_total_target = $sub_indikator_data
                                        ? $sub_indikator_data->where('triwulan_id', 1)->sum('total_target')
                                        : 0;
                                @endphp
                                <tr onclick="toggleSubIndikator({{ $indikator_penunjang->id }})" class="cursor-pointer">
                                    <td colspan="28" class="bg-orange-100 border border-gray-400 p-2 pl-15">
                                        <button class="text-xl">
                                            <i id="toggle-icon-{{ $indikator_penunjang->id }}"
                                                class="fa fa-plus-circle"></i>
                                        </button>
                                        [INDIKATOR PENUNJANG] {{ $indikator_penunjang->indikator_penunjang }}
                                    </td>
                                    <!-- Menampilkan Target Kumulatif per Triwulan untuk Sub Indikator -->
                                    <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                        {{ $triwulan_1_total_target }}</td>

                                </tr>
                                @php
                                    $last_bidang_id = null;
                                @endphp
                                @foreach ($indikator_penunjang->sub_indikator as $sub_indikator)
                                    @php
                                        $bidang_id = $sub_indikator->bidang_id;
                                        $data_sub_indikator = $data_iku_by_sub_indikator
                                            ->get($sub_indikator->id, collect())
                                            ->first();
                                        $data_triwulan_1 = optional(
                                            optional($data_iku_by_triwulan->get($sub_indikator->id))->get(1),
                                        )->first();
                                        $data_triwulan_2 = optional(
                                            optional($data_iku_by_triwulan->get($sub_indikator->id))->get(2),
                                        )->first();
                                        $data_triwulan_3 = optional(
                                            optional($data_iku_by_triwulan->get($sub_indikator->id))->get(3),
                                        )->first();
                                        $data_triwulan_4 = optional(
                                            optional($data_iku_by_triwulan->get($sub_indikator->id))->get(4),
                                        )->first();

                                    @endphp
                                    @if ($sub_indikator->bidang_id != $last_bidang_id)
                                        <tr id="sub-{{ $indikator_penunjang->id }}" class="hidden">
                                            <td colspan="28"
                                                class="bg-gray-200 border border-gray-400 p-2 pl-30 flex items-center">
                                                <strong>{{ $sub_indikator->bidang->nama_bidang }}</strong>
                                                @if ($bidang_counts_unfill[$sub_indikator->bidang_id] > 0)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-1 rounded-full text-xs font-medium bg-red-500 text-white ml-4">-{{ $bidang_counts_unfill[$sub_indikator->bidang_id] }}</span>
                                                @endif
                                                @if (isset($bidang_counts[$sub_indikator->bidang_id]))
                                            </td>
                                            <!-- KOLOM JUMLAH SUB INDIKATOR YANG SUDAH DI ISI PADA SETIAP TRIWULANNYA -->
                                            @php
                                                $triwulan_1_filled = $bidang_counts[$sub_indikator->bidang_id]
                                                    ->where('triwulan_id', 1)
                                                    ->sum('filled');
                                                $triwulan_2_filled = $bidang_counts[$sub_indikator->bidang_id]
                                                    ->where('triwulan_id', 2)
                                                    ->sum('filled');
                                                $triwulan_3_filled = $bidang_counts[$sub_indikator->bidang_id]
                                                    ->where('triwulan_id', 3)
                                                    ->sum('filled');
                                                $triwulan_4_filled = $bidang_counts[$sub_indikator->bidang_id]
                                                    ->where('triwulan_id', 4)
                                                    ->sum('filled');
                                                $triwulan_1_realisasi = $realisasi_total_by_bidang[
                                                    $sub_indikator->bidang_id
                                                ]
                                                    ->where('triwulan_id', 1)
                                                    ->sum('total_realisasi');
                                                $triwulan_2_realisasi = $realisasi_total_by_bidang[
                                                    $sub_indikator->bidang_id
                                                ]
                                                    ->where('triwulan_id', 2)
                                                    ->sum('total_realisasi');
                                                $triwulan_3_realisasi = $realisasi_total_by_bidang[
                                                    $sub_indikator->bidang_id
                                                ]
                                                    ->where('triwulan_id', 3)
                                                    ->sum('total_realisasi');
                                                $triwulan_4_realisasi = $realisasi_total_by_bidang[
                                                    $sub_indikator->bidang_id
                                                ]
                                                    ->where('triwulan_id', 4)
                                                    ->sum('total_realisasi');
                                            @endphp
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center"></td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_1_filled ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_2_filled ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_3_filled ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_4_filled ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_1_realisasi ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_2_realisasi ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_3_realisasi ?? 0 }}</td>
                                            <td class="bg-gray-200 border border-gray-400 p-2 text-center">
                                                {{ $triwulan_4_realisasi ?? 0 }}</td>
                                    @endif
                                    </tr>
                                    @php
                                        $last_bidang_id = $sub_indikator->bidang_id;
                                    @endphp
                                @endif
                                <tr id="sub-{{ $indikator_penunjang->id }}" class="hidden"
                                    data-parent-id="{{ $indikator_penunjang->id }}">
                                    <td class="border border-gray-400 p-2 pl-40">[SUB INDIKATOR]
                                        {{ $sub_indikator->sub_indikator }}</td>
                                    <td class="border border-gray-400 p-2">Satuan</td>
                                    <!-- Target Kumulatif per Triwulan -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_1->perjanjian_kinerja_target_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_2->perjanjian_kinerja_target_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_3->perjanjian_kinerja_target_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_4->perjanjian_kinerja_target_kumulatif ?? 0 }}</td>
                                    <!-- Realisasi Kumulatif per Triwulan -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_1->perjanjian_kinerja_realisasi_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_2->perjanjian_kinerja_realisasi_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_3->perjanjian_kinerja_realisasi_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_4->perjanjian_kinerja_realisasi_kumulatif ?? 0 }}</td>
                                    <!-- Capaian Kumulatif per Triwulan -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_1->capaian_kinerja_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_2->capaian_kinerja_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_3->capaian_kinerja_kumulatif ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_4->capaian_kinerja_kumulatif ?? 0 }}</td>
                                    <!-- Capaian Terhadap Target Setahun per Triwulan -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_1->capaian_kinerja_target_setahun ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_2->capaian_kinerja_target_setahun ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_3->capaian_kinerja_target_setahun ?? 0 }}</td>
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ $data_triwulan_4->capaian_kinerja_target_setahun ?? 0 }}</td>
                                    <!-- Link Bukti Dukung Capaian -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        @if ($link = optional($data_sub_indikator)->link_bukti_dukung_capaian)
                                            <a href="{{ $link }}" target="_blank" class="text-blue-500">Link</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <!-- Upaya yang Dilakukan -->
                                    <td class="border border-gray-400 p-2 flex flex-wrap max-w-sm">
                                        {{ optional($data_sub_indikator)->upaya_yang_dilakukan ?? '-' }}
                                    </td>
                                    <!-- Link Bukti Dukung Upaya -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        @if ($link = optional($data_sub_indikator)->link_bukti_dukung_upaya_yang_dilakukan)
                                            <a href="{{ $link }}" target="_blank" class="text-blue-500">Link</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <!-- Kendala -->
                                    <td class="border border-gray-400 p-2 flex flex-wrap max-w-sm">
                                        {{ optional($data_sub_indikator)->kendala ?? '-' }}
                                    </td>
                                    <!-- Solusi atas Kendala -->
                                    <td class="border border-gray-400 p-2 max-w-sm">
                                        {{ optional($data_sub_indikator)->solusi_atas_kendala ?? '-' }}
                                    </td>
                                    <!-- Rencana Tindak Lanjut -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ optional($data_sub_indikator)->rencana_tidak_lanjut ?? '-' }}
                                    </td>
                                    <!-- PIC Tindak Lanjut -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ optional($data_sub_indikator)->pic_tidak_lanjut ?? '-' }}
                                    </td>
                                    <!-- Tenggat Tindak Lanjut -->
                                    <td class="border border-gray-400 p-2 text-center">
                                        {{ optional($data_sub_indikator)->tenggat_tidak_lanjut ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach <!-- End foreach sub_indikator -->
                        @endforeach <!-- End foreach indikator_penunjang -->
                    @endforeach <!-- End foreach indikator -->
                @endforeach <!-- End foreach sasaran -->
                @endforeach <!-- End foreach iku -->
            </tbody>
        </table>
    </div>


    <script>
        function toggleSubIndikator(id) {
            let rows = document.querySelectorAll(`#sub-${id}`);
            let icon = document.querySelector(`#toggle-icon-${id}`);
            rows.forEach(row => {
                row.classList.toggle('hidden');
            });

            // Ganti ikon plus/minus
            if (icon.classList.contains('fa-plus-circle')) {
                icon.classList.remove('fa-plus-circle');
                icon.classList.add('fa-minus-circle');
            } else {
                icon.classList.remove('fa-minus-circle');
                icon.classList.add('fa-plus-circle');
            }
        }
    </script>
@endsection
