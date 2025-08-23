@extends('layouts.app')

@section('title', 'Tambah IKU')

@section('content')
    <!-- Previous success and error alerts remain unchanged -->
    @if (!empty(session('success')))
        <script>
            swal({
                title: "{{ Session::get('success.title') }}",
                text: "{{ Session::get('success.message') }}",
                icon: "success",
                button: {
                    text: "OK",
                    closeModal: true,
                }
            }).then(() => {
                window.location.href = "{{ url('operator/dashboard') }}";
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            var errorMessage = "";
            @foreach ($errors->all() as $error)
                errorMessage += "{{ $error }}\n";
            @endforeach

            swal("Data submit failed!", errorMessage, "error", {
                button: true,
                button: "OK",
            });
        </script>
    @endif
    @php
        $triwulan = request()->query('triwulan');
    @endphp

    @if ($triwulanStatus !== 'close' && $triwulanStatus != null)
        <!-- Form layout remains unchanged -->
        <div class="w-full p-5 h-full">
            <a class="text-gray-600 font-semibold text-2xl flex items-center gap-3" href="{{ url('operator/dashboard') }}"><i
                    class="fa-solid fa-angle-left text-lg"></i> Tambah Master Data</a>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5 bg-white mt-5">
                <p class="font-semibold text-lg text-gray-600 mb-3">
                    {{ $entityName ?? 'Entitas tidak ditemukan' }}
                </p>
                <p class="font-medium text-gray-600 mb-10">Triwulan Ke-{{ $triwulan }}</p>
                <form class="mx-auto" action="{{ url('operator/tambah-master-data') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="{{ $entityType }}">
                    <input type="hidden" name="entity_id" value="{{ $entityId }}">
                    <input type="hidden" name="triwulan" value="{{ request()->query('triwulan') }}">


                    <div class="">
                        <p class="w-full font-semibold border-b-2 py-2 mb-4 text-gray-600">Perjanjian Kinerja</p>
                        <div class="flex gap-x-10 gap-y-3 w-full items-center justify-between">
                            <div class="mb-5 w-1/2">
                                <label for="perjanjian_kinerja_target_kumulatif"
                                    class="block mb-2 text-sm font-medium text-gray-900">Target Kumulatif</label>
                                <input type="number" min="0" name="perjanjian_kinerja_target_kumulatif"
                                    id="perjanjian_kinerja_target_kumulatif"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0" required onchange="calculateCapaianKinerja()" />
                            </div>
                            <div class="mb-5 w-1/2">
                                <label for="perjanjian_kinerja_realisasi_kumulatif"
                                    class="block mb-2 text-sm font-medium text-gray-900">Realisasi Kumulatif</label>
                                <input type="number" min="0" name="perjanjian_kinerja_realisasi_kumulatif"
                                    id="perjanjian_kinerja_realisasi_kumulatif"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0" required onchange="calculateCapaianKinerja()" />
                            </div>
                        </div>
                    </div>

                    <div class="border-b-2">
                        <p class="w-full font-semibold border-b-2 py-2 mb-4 text-gray-600">Capaian Kinerja</p>
                        <div class="flex gap-x-10 gap-y-3 w-full items-center justify-between">
                            <div class="mb-5 w-1/2">
                                <label for="capaian_kinerja_kumulatif"
                                    class="block mb-2 text-sm font-medium text-gray-900">Kumulatif</label>
                                <input type="number" min="0.00" step="0.01" name="capaian_kinerja_kumulatif"
                                    id="capaian_kinerja_kumulatif"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required readonly />
                            </div>
                            <div class="mb-5 w-1/2">
                                <label for="capaian_kinerja_target_setahun"
                                    class="block mb-2 text-sm font-medium text-gray-900">Terhadap Target Setahun</label>
                                <input type="number" min="0.00" step="0.01" name="capaian_kinerja_target_setahun"
                                    id="capaian_kinerja_target_setahun"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="0.00" required readonly />
                            </div>
                        </div>
                    </div>

                    <script>
                        function calculateCapaianKinerja() {
                            const targetKumulatif = parseFloat(document.getElementById('perjanjian_kinerja_target_kumulatif').value) || 0;
                            const realisasiKumulatif = parseFloat(document.getElementById('perjanjian_kinerja_realisasi_kumulatif')
                                .value) || 0;

                            // Hitung target setahun secara otomatis
                            const targetSetahun = realisasiKumulatif <= 9 ? 60 : 61;

                            // Perhitungan Capaian Kinerja Kumulatif
                            let capaianKinerjaKumulatif = 0;
                            if (targetKumulatif !== 0) {
                                capaianKinerjaKumulatif = (realisasiKumulatif / targetKumulatif) * 100;
                                capaianKinerjaKumulatif = Math.min(capaianKinerjaKumulatif, 120);
                            }

                            // Perhitungan Capaian Kinerja Terhadap Target Setahun
                            let capaianKinerjaTargetSetahun = 0;
                            if (targetSetahun !== 0) {
                                capaianKinerjaTargetSetahun = (realisasiKumulatif / targetSetahun) * 100;
                                capaianKinerjaTargetSetahun = Math.min(capaianKinerjaTargetSetahun, 120);
                            }

                            document.getElementById('capaian_kinerja_kumulatif').value = capaianKinerjaKumulatif.toFixed(2);
                            document.getElementById('capaian_kinerja_target_setahun').value = capaianKinerjaTargetSetahun.toFixed(2);
                        }
                    </script>

                    <div class="mt-4">
                        <div class="mb-5 w-full">
                            <label for="link_bukti_dukung_capaian"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Link
                                bukti dukung capaian</label>
                            <input type="text" name="link_bukti_dukung_capaian" id="link_bukti_dukung_capaian"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Masukkan link bukti dukung" required />
                        </div>
                        <div class="mb-5 w-full">
                            <label for="upaya_yang_dilakukan" class="block mb-2 text-sm font-medium text-gray-900 ">Upaya
                                yang
                                dilakukan</label>
                            <textarea type="text" name="upaya_yang_dilakukan" id="upaya_yang_dilakukan"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Masukkan upaya yang sudah dilakukan" rows="6" required></textarea>
                        </div>
                        <div class="mb-5 w-full">
                            <label for="link_bukti_dukung_upaya_yang_dilakukan"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Link
                                bukti dukung upaya</label>
                            <input type="text" name="link_bukti_dukung_upaya_yang_dilakukan"
                                id="link_bukti_dukung_upaya_yang_dilakukan"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Masukkan link bukti upaya" required />
                        </div>
                    </div>
                    <div class="">
                        <p class="w-full font-semibold border-b-2 py-2 mb-4 text-gray-600">Analisis Pencapaian Kinerja di
                            Triwulan Berjalan</p>
                        <div class="grid grid-cols-2 gap-x-10 gap-y-3 w-full items-center justify-between">
                            <div class="mb-5 w-full">
                                <label for="kendala" class="block mb-2 text-sm font-medium text-gray-900 ">Kendala</label>
                                <textarea type="text" name="kendala" id="kendala"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Masukkan kendala saat triwulan ini" rows="6" required></textarea>
                            </div>
                            <div class="mb-5 w-full">
                                <label for="solusi_atas_kendala"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Solusi</label>
                                <textarea type="text" name="solusi_atas_kendala" id="solusi_atas_kendala"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Masukkan solusi atas kendala" rows="6" required></textarea>
                            </div>
                        </div>
                        <div class="mb-5 w-full">
                            <label for="rencana_tidak_lanjut"
                                class="block mb-2 text-sm font-medium text-gray-900 ">Rencana
                                tindak
                                lanjut</label>
                            <textarea type="text" name="rencana_tidak_lanjut" id="rencana_tidak_lanjut"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Masukkan rencana tindak lanjut untuk triwulan berikutnya" rows="6" required></textarea>
                        </div>
                        <div class="mb-5 w-full">
                            <label for="pic_tidak_lanjut" class="block mb-2 text-sm font-medium text-gray-900 ">PIC tindak
                                lanjut</label>
                            <input type="text" name="pic_tidak_lanjut" id="pic_tidak_lanjut"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Masukkan PIC tindak lanjut untuk triwulan berikutnya" required></input>
                        </div>
                        <div class="mb-5 w-1/4">
                            <label for="tenggat_tidak_lanjut" class="block mb-2 text-sm font-medium text-gray-900 ">Batas
                                waktu tindak
                                lanjut</label>
                            <input type="date" name="tenggat_tidak_lanjut" id="tenggat_tidak_lanjut"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                required></input>
                        </div>
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                </form>
            </div>
        </div>
    @endif
@endsection
