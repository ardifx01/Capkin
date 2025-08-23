@extends('layouts.app')

@section('title', 'Pimpinan Dashboard')

@section('content')

    <div class="flex flex-wrap gap-4"> <!-- Pembungkus Flexbox -->
        @foreach ($indikator as $key => $ind)
            @component('components.indikator-card', ['ind' => $ind])
            @endcomponent
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
