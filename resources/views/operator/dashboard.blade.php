@extends('layouts.app')

@section('title', 'Operator dashboard')

@section('content')
    @php
        $bidangOptions = [
            7 => 'Pimpinan',
            6 => 'Fungsi IPDS',
            5 => 'Fungsi Nerwilis',
            4 => 'Fungsi Statistik Distribusi',
            3 => 'Fungsi Statistik Produksi',
            2 => 'Fungsi Statistik Sosial',
            1 => 'Bagian Umum',
        ];

        $userBidang = $bidangOptions[Auth::user()->bidang_id] ?? 'Unknown';
    @endphp
    <div class="w-full p-5 h-full">
        <h2 class="text-gray-600 font-semibold text-2xl">Isikan Capaian Kinerja</h2>
        <p class="text-gray-600 font-light text-lg mt-2">{{ $userBidang }}</p>
        <div class="mt-4 mb-2 flex items-center gap-2">
            <p class="text-gray-800">Pilih triwulan:</p>
            <div class="flex items-center">
                <select name="triwulan_id" id="triwulan"
                    class="px-4 py-2 pr-4 w-[200px] rounded-md shadow-sm outline-none border-none appearance-none text-gray-800 active:border-blue-500 active:border-2">
                    <option selected value="0">pilih</option>
                    @foreach ($triwulan as $data)
                        @if ($data->status === 'open')
                            <option value="{{ $data->id }}">{{ $data->triwulan }}</option>
                        @elseif ($data->status === 'close')
                            <option @disabled(true) class="disabled:text-gray-300" value="{{ $data->id }}">
                                {{ $data->triwulan }}</option>
                        @endif
                    @endforeach
                </select>
                <svg class="w-4 h-4 mt-px -ml-6 pointer-events-none " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        @if (request()->has('triwulan') &&
                !empty(request()->get('triwulan')) &&
                $triwulanStatus !== 'close' &&
                $triwulanStatus != null &&
                request()->get('triwulan') != 0)
            <div class="mt-10 bg-white p-5 rounded shadow">
                <ul class="flex flex-col gap-4">
                    <li class="">
                        <div class="parent flex items-center gap-5">
                            <i
                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                            <div
                                class="p-4 rounded-md border-blue-300 border-2 flex justify-between w-full items-center bg-blue-50">
                                <p>Indikator Kinerja Utama</p>
                            </div>
                        </div>
                        <ul class="child hidden ml-[14px] flex flex-col border-orange-300 border-l-2">
                            @foreach ($iku as $tujuan)
                                @if (Auth::user()->bidang_id !== 1 &&
                                        Auth::user()->bidang_id !== 6 &&
                                        $tujuan->id !== 5 &&
                                        $tujuan->id !== 2 &&
                                        $tujuan->id !== 3 &&
                                        $tujuan->id !== 4)
                                    <li class="ml-7 mt-4">
                                        <div class="parent flex items-center gap-5">
                                            <i
                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                            <div
                                                class="p-4 rounded-md border-orange-300 border-2 flex justify-between w-full items-center bg-orange-50">
                                                <p class="block w-[85%] "><span class="">[ TUJUAN ]</span>
                                                    {{ $tujuan->tujuan }}</p>
                                            </div>
                                        </div>
                                        <ul class="child hidden ml-[14px] flex flex-col border-green-300 border-l-2">
                                            @foreach ($tujuan->sasaran as $sasaran)
                                                <li class="ml-7 mt-4">
                                                    <div class="parent flex items-center gap-5">
                                                        <i
                                                            class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                        <div
                                                            class="p-4 rounded-md border-green-300 border-2 flex justify-between w-full items-center bg-green-50">
                                                            <p class="block w-[85%] "><span class="">[ SASARAN
                                                                    ]</span>
                                                                {{ $sasaran->sasaran }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if ($sasaran->indikator->isNotEmpty())
                                                        <ul
                                                            class="child hidden ml-[14px] flex flex-col border-yellow-300 border-l-2">
                                                            @foreach ($sasaran->indikator as $indikator)
                                                                <li class="ml-7 mt-4">
                                                                    @if ($indikator->indikator_penunjang()->exists() || $indikator->sub_indikator->isNotEmpty())
                                                                        <div class="parent flex items-center gap-5">
                                                                            <i
                                                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                            <div
                                                                                class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                                <p class="block w-[85%] "><span
                                                                                        class="">[
                                                                                        INDIKATOR ]</span>
                                                                                    {{ $indikator->indikator }}</p>

                                                                            </div>
                                                                        </div>
                                                                        @if ($indikator->indikator_penunjang()->exists())
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-purple-300 border-l-2">
                                                                                @foreach ($indikator->indikator_penunjang as $indikator_penunjang)
                                                                                    <li class="ml-7 mt-4">
                                                                                        @if ($indikator_penunjang->sub_indikator->isNotEmpty())
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <i
                                                                                                    class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                                                <div
                                                                                                    class="p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%] ">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul
                                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                                @foreach ($indikator_penunjang->sub_indikator as $sub_indikator)
                                                                                                    @if ($sub_indikator->bidang_id === null || $sub_indikator->bidang_id === Auth::user()->bidang_id)
                                                                                                        <li
                                                                                                            class="ml-16 mt-4">
                                                                                                            <div
                                                                                                                class="parent flex items-center gap-5">
                                                                                                                <div
                                                                                                                    class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                                    <p
                                                                                                                        class="block w-[85%]">
                                                                                                                        <span
                                                                                                                            class="">[
                                                                                                                            SUB
                                                                                                                            INDIKATOR
                                                                                                                            ]</span>
                                                                                                                        {{ $sub_indikator->sub_indikator }}
                                                                                                                    </p>
                                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                                        @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                                    Approved
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                        @else
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                                    Data sudah diisi
                                                                                                                                </span>
                                                                                                                                <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                                    Edit data
                                                                                                                                </a>
                                                                                                                            </div>
                                                                                                                        @endif
                                                                                                                    @else
                                                                                                                        <a
                                                                                                                            href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                                            <button
                                                                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                                Input
                                                                                                                                data
                                                                                                                            </button>
                                                                                                                        </a>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @else

                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                @foreach ($indikator->sub_indikator as $sub_indikator)
                                                                                    <li class="ml-16 mt-4">
                                                                                        <div
                                                                                            class="parent flex items-center gap-5">
                                                                                            <div
                                                                                                class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                <p class="block w-[85%]">
                                                                                                    <span class="">[
                                                                                                        SUB
                                                                                                        INDIKATOR ]</span>
                                                                                                    {{ $sub_indikator->sub_indikator }}
                                                                                                </p>
                                                                                                @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                Approved
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                Data sudah diisi
                                                                                                            </span>
                                                                                                            <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                            class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                Edit data
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                        <button
                                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                            Input
                                                                                                            data
                                                                                                        </button>
                                                                                                    </a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    @else
                                                                        <div class="parent flex items-center gap-5">
                                                                            <div
                                                                                class="ml-12 p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                                <p class="block w-[85%]"><span
                                                                                        class="">[
                                                                                        INDIKATOR ]</span>
                                                                                    {{ $indikator->indikator }}</p>
                                                                                @if (in_array($indikator->id, $existingDataIndikator))
                                                                                    @if (in_array($indikator->id, $existingDataIndikatorApproved))
                                                                                        <div class="flex flex-col items-center text-center">
                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                Approved
                                                                                            </span>
                                                                                        </div>
                                                                                    @else
                                                                                        <div
                                                                                            class="flex flex-col items-center text-center">
                                                                                            <span
                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                Data
                                                                                                sudah
                                                                                                diisi
                                                                                            </span>
                                                                                            <a href="{{ url('operator/edit-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                Edit
                                                                                                data
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif
                                                                                @else
                                                                                    <a
                                                                                        href="{{ url('operator/tambah-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                        <button
                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                            Input
                                                                                            data
                                                                                        </button>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif (Auth::user()->bidang_id === 1 && ($tujuan->id === 5 || $tujuan->id === 4))
                                    <li class="ml-7 mt-4">
                                        <div class="parent flex items-center gap-5">
                                            <i
                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                            <div
                                                class="p-4 rounded-md border-orange-300 border-2 flex justify-between w-full items-center bg-orange-50">
                                                <p class="block w-[85%] "><span class="">[ TUJUAN ]</span>
                                                    {{ $tujuan->tujuan }}</p>
                                            </div>
                                        </div>
                                        <ul class="child hidden ml-[14px] flex flex-col border-green-300 border-l-2">
                                            @foreach ($tujuan->sasaran as $sasaran)
                                                <li class="ml-7 mt-4">
                                                    <div class="parent flex items-center gap-5">
                                                        <i
                                                            class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                        <div
                                                            class="p-4 rounded-md border-green-300 border-2 flex justify-between w-full items-center bg-green-50">
                                                            <p class="block w-[85%] "><span class="">[ SASARAN
                                                                    ]</span>
                                                                {{ $sasaran->sasaran }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if ($sasaran->indikator->isNotEmpty())
                                                        <ul
                                                            class="child hidden ml-[14px] flex flex-col border-yellow-300 border-l-2">
                                                            @foreach ($sasaran->indikator as $indikator)
                                                                <li class="ml-7 mt-4">
                                                                    @if ($indikator->indikator_penunjang()->exists() || $indikator->sub_indikator->isNotEmpty() && $indikator->id !== 7)
                                                                        <div class="parent flex items-center gap-5">
                                                                            <i
                                                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                            <div
                                                                                class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                                <p class="block w-[85%] "><span
                                                                                        class="">[
                                                                                        INDIKATOR ]</span>
                                                                                    {{ $indikator->indikator }}</p>
                                                                            </div>
                                                                        </div>
                                                                        @if ($indikator->indikator_penunjang()->exists())
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-purple-300 border-l-2">
                                                                                @foreach ($indikator->indikator_penunjang as $indikator_penunjang)
                                                                                    <li class="ml-7 mt-4">
                                                                                        @if ($indikator_penunjang->sub_indikator->isNotEmpty())
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <i
                                                                                                    class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                                                <div
                                                                                                    class="p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%] ">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul
                                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                                @foreach ($indikator_penunjang->sub_indikator as $sub_indikator)
                                                                                                    @if ($sub_indikator->bidang_id === null || $sub_indikator->bidang_id === Auth::user()->bidang_id)
                                                                                                        <li
                                                                                                            class="ml-16 mt-4">
                                                                                                            <div
                                                                                                                class="parent flex items-center gap-5">
                                                                                                                <div
                                                                                                                    class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                                    <p
                                                                                                                        class="block w-[85%]">
                                                                                                                        <span
                                                                                                                            class="">[
                                                                                                                            SUB
                                                                                                                            INDIKATOR
                                                                                                                            ]</span>
                                                                                                                        {{ $sub_indikator->sub_indikator }}
                                                                                                                    </p>
                                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                                        @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                                    Approved
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                        @else
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                                    Data sudah diisi
                                                                                                                                </span>
                                                                                                                                <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                                    Edit data
                                                                                                                                </a>
                                                                                                                            </div>
                                                                                                                        @endif
                                                                                                                    @else
                                                                                                                        <a
                                                                                                                            href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                                            <button
                                                                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                                Input
                                                                                                                                data
                                                                                                                            </button>
                                                                                                                        </a>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @else
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <div
                                                                                                    class="ml-12 p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%]">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                    @if (in_array($indikator_penunjang->id, $existingDataIndikatorPenunjang))
                                                                                                        @if (in_array($indikator_penunjang->id, $existingDataIndikatorPenunjangApproved))
                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                    Approved
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div
                                                                                                                class="flex flex-col items-center text-center">
                                                                                                                <span
                                                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                    Data
                                                                                                                    sudah
                                                                                                                    diisi
                                                                                                                </span>
                                                                                                                <a href="{{ url('operator/edit-master-data/indikator_penunjang/' . $indikator_penunjang->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                    Edit
                                                                                                                    data
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <a
                                                                                                            href="{{ url('operator/tambah-master-data/indikator_penunjang/' . $indikator_penunjang->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                            <button
                                                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                Input
                                                                                                                data
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                @foreach ($indikator->sub_indikator as $sub_indikator)
                                                                                    <li class="ml-16 mt-4">
                                                                                        <div
                                                                                            class="parent flex items-center gap-5">
                                                                                            <div
                                                                                                class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                <p class="block w-[85%]">
                                                                                                    <span class="">[
                                                                                                        SUB
                                                                                                        INDIKATOR ]</span>
                                                                                                    {{ $sub_indikator->sub_indikator }}
                                                                                                </p>
                                                                                                @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                Approved
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                Data sudah diisi
                                                                                                            </span>
                                                                                                            <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                            class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                Edit data
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                        <button
                                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                            Input
                                                                                                            data
                                                                                                        </button>
                                                                                                    </a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    @elseif($indikator->id !== 7)
                                                                        <div class="parent flex items-center gap-5">
                                                                            <div
                                                                                class="ml-12 p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                                <p class="block w-[85%]"><span
                                                                                        class="">[ INDIKATOR
                                                                                        ]</span>
                                                                                    {{ $indikator->indikator }}</p>
                                                                                @if (in_array($indikator->id, $existingDataIndikator))
                                                                                    @if (in_array($indikator->id, $existingDataIndikatorApproved))
                                                                                        <div class="flex flex-col items-center text-center">
                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                Approved
                                                                                            </span>
                                                                                        </div>
                                                                                    @else
                                                                                        <div
                                                                                            class="flex flex-col items-center text-center">
                                                                                            <span
                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                Data
                                                                                                sudah
                                                                                                diisi
                                                                                            </span>
                                                                                            <a href="{{ url('operator/edit-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                Edit
                                                                                                data
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif
                                                                                @else
                                                                                    <a
                                                                                        href="{{ url('operator/tambah-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                        <button
                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                            Input
                                                                                            data
                                                                                        </button>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif (Auth::user()->bidang_id === 6 && ($tujuan->id === 1 || $tujuan->id === 2 || $tujuan->id === 3 || $tujuan->id === 4))
                                    <li class="ml-7 mt-4">
                                        <div class="parent flex items-center gap-5">
                                            <i
                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                            <div
                                                class="p-4 rounded-md border-orange-300 border-2 flex justify-between w-full items-center bg-orange-50">
                                                <p class="block w-[85%] "><span class="">[ TUJUAN ]</span>
                                                    {{ $tujuan->tujuan }}</p>
                                            </div>
                                        </div>
                                        <ul class="child hidden ml-[14px] flex flex-col border-green-300 border-l-2">
                                            @foreach ($tujuan->sasaran as $sasaran)
                                                <li class="ml-7 mt-4">
                                                    <div class="parent flex items-center gap-5">
                                                        <i
                                                            class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                        <div
                                                            class="p-4 rounded-md border-green-300 border-2 flex justify-between w-full items-center bg-green-50">
                                                            <p class="block w-[85%] "><span class="">[ SASARAN
                                                                    ]</span>
                                                                {{ $sasaran->sasaran }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if ($sasaran->indikator->isNotEmpty())
                                                        <ul
                                                            class="child hidden ml-[14px] flex flex-col border-yellow-300 border-l-2">
                                                            @foreach ($sasaran->indikator as $indikator)
                                                                <li class="ml-7 mt-4">
                                                                    @if (($indikator->indikator_penunjang()->exists() && $indikator->sub_indikator->isNotEmpty()) || $indikator->id !== 1 && $indikator->id !== 6)
                                                                        <div class="parent flex items-center gap-5">
                                                                            <i
                                                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                            <div
                                                                                class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                                <p class="block w-[85%] "><span
                                                                                        class="">[
                                                                                        INDIKATOR ]</span>
                                                                                    {{ $indikator->indikator }}</p>
                                                                            </div>
                                                                        </div>
                                                                        @if ($indikator->indikator_penunjang()->exists())
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-purple-300 border-l-2">
                                                                                @foreach ($indikator->indikator_penunjang as $indikator_penunjang)
                                                                                    <li class="ml-7 mt-4">
                                                                                        @if ($indikator_penunjang->sub_indikator->isNotEmpty())
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <i
                                                                                                    class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                                                <div
                                                                                                    class="p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%] ">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul
                                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                                @foreach ($indikator_penunjang->sub_indikator as $sub_indikator)
                                                                                                    @if ($sub_indikator->bidang_id === null || $sub_indikator->bidang_id === Auth::user()->bidang_id)
                                                                                                        <li
                                                                                                            class="ml-16 mt-4">
                                                                                                            <div
                                                                                                                class="parent flex items-center gap-5">
                                                                                                                <div
                                                                                                                    class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                                    <p
                                                                                                                        class="block w-[85%]">
                                                                                                                        <span
                                                                                                                            class="">[
                                                                                                                            SUB
                                                                                                                            INDIKATOR
                                                                                                                            ]</span>
                                                                                                                        {{ $sub_indikator->sub_indikator }}
                                                                                                                    </p>
                                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                                        @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                                    Approved
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                        @else
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                                    Data sudah diisi
                                                                                                                                </span>
                                                                                                                                <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                                    Edit data
                                                                                                                                </a>
                                                                                                                            </div>
                                                                                                                        @endif
                                                                                                                    @else
                                                                                                                        <a
                                                                                                                            href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                                            <button
                                                                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                                Input
                                                                                                                                data
                                                                                                                            </button>
                                                                                                                        </a>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @else
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <div
                                                                                                    class="ml-12 p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%]">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                    @if (in_array($indikator_penunjang->id, $existingDataIndikatorPenunjang))
                                                                                                        @if (in_array($indikator_penunjang->id, $existingDataIndikatorPenunjangApproved))
                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                    Approved
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div
                                                                                                                class="flex flex-col items-center text-center">
                                                                                                                <span
                                                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                    Data
                                                                                                                    sudah
                                                                                                                    diisi
                                                                                                                </span>
                                                                                                                <a href="{{ url('operator/edit-master-data/indikator_penunjang/' . $indikator_penunjang->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                    Edit
                                                                                                                    data
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <a
                                                                                                            href="{{ url('operator/tambah-master-data/indikator_penunjang/' . $indikator_penunjang->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                            <button
                                                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                Input
                                                                                                                data
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                @foreach ($indikator->sub_indikator as $sub_indikator)
                                                                                    <li class="ml-16 mt-4">
                                                                                        <div
                                                                                            class="parent flex items-center gap-5">
                                                                                            <div
                                                                                                class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                <p class="block w-[85%]">
                                                                                                    <span class="">[
                                                                                                        SUB
                                                                                                        INDIKATOR ]</span>
                                                                                                    {{ $sub_indikator->sub_indikator }}
                                                                                                </p>
                                                                                                @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                Approved
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                Data sudah diisi
                                                                                                            </span>
                                                                                                            <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                            class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                Edit data
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                        <button
                                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                            Input
                                                                                                            data
                                                                                                        </button>
                                                                                                    </a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    @else
                                                                        <div class="parent flex items-center gap-5">
                                                                            @if ($indikator->id !== 6)
                                                                            <i
                                                                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                            @endif
                                                                            @if ($indikator->id !== 6)
                                                                            <div
                                                                            class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                            <p class="block w-[85%] "><span
                                                                                    class="">[
                                                                                    INDIKATOR ]</span>
                                                                                {{ $indikator->indikator }}</p>
                                                                            @if (in_array($indikator->id, $existingDataIndikator))
                                                                                @if (in_array($indikator->id, $existingDataIndikatorApproved))
                                                                                    <div class="flex flex-col items-center text-center">
                                                                                        <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                            Approved
                                                                                        </span>
                                                                                    </div>
                                                                                @else
                                                                                    <div
                                                                                        class="flex flex-col items-center text-center">
                                                                                        <span
                                                                                            class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                            Data
                                                                                            sudah
                                                                                            diisi
                                                                                        </span>
                                                                                        <a href="{{ url('operator/edit-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                            class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                            Edit
                                                                                            data
                                                                                        </a>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                <a
                                                                                    href="{{ url('operator/tambah-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                    <button
                                                                                        class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                        Input
                                                                                        data
                                                                                    </button>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                            @elseif($indikator->id !== 6)
                                                                            <div
                                                                                class="ml-12 p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                                <p class="block w-[85%] "><span
                                                                                        class="">[
                                                                                        INDIKATOR ]</span>
                                                                                    {{ $indikator->indikator }}</p>
                                                                                @if (in_array($indikator->id, $existingDataIndikator))
                                                                                    @if (in_array($indikator->id, $existingDataIndikatorApproved))
                                                                                        <div class="flex flex-col items-center text-center">
                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                Approved
                                                                                            </span>
                                                                                        </div>
                                                                                    @else
                                                                                        <div
                                                                                            class="flex flex-col items-center text-center">
                                                                                            <span
                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                Data
                                                                                                sudah
                                                                                                diisi
                                                                                            </span>
                                                                                            <a href="{{ url('operator/edit-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                Edit
                                                                                                data
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif
                                                                                @else
                                                                                    <a
                                                                                        href="{{ url('operator/tambah-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                        <button
                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                            Input
                                                                                            dataaa
                                                                                        </button>
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                        @if ($indikator->indikator_penunjang()->exists())
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-purple-300 border-l-2">
                                                                                @foreach ($indikator->indikator_penunjang as $indikator_penunjang)
                                                                                    <li class="ml-7 mt-4">
                                                                                        @if ($indikator_penunjang->sub_indikator->where('bidang_id', 6)->isNotEmpty())
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <i
                                                                                                    class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                                                <div
                                                                                                    class="p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%] ">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul
                                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                                @foreach ($indikator_penunjang->sub_indikator as $sub_indikator)
                                                                                                    @if ($sub_indikator->bidang_id === null || $sub_indikator->bidang_id === Auth::user()->bidang_id)
                                                                                                        <li
                                                                                                            class="ml-16 mt-4">
                                                                                                            <div
                                                                                                                class="parent flex items-center gap-5">
                                                                                                                <div
                                                                                                                    class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                                    <p
                                                                                                                        class="block w-[85%]">
                                                                                                                        <span
                                                                                                                            class="">[
                                                                                                                            SUB
                                                                                                                            INDIKATOR
                                                                                                                            ]</span>
                                                                                                                        {{ $sub_indikator->sub_indikator }}
                                                                                                                    </p>
                                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                                        @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                                    Approved
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                        @else
                                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                                    Data sudah diisi
                                                                                                                                </span>
                                                                                                                                <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                                class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                                    Edit data
                                                                                                                                </a>
                                                                                                                            </div>
                                                                                                                        @endif
                                                                                                                    @else
                                                                                                                        <a href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                                            <button class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                                Input data
                                                                                                                            </button>
                                                                                                                        </a>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @elseif ($indikator_penunjang->sub_indikator->isEmpty())
                                                                                            <div
                                                                                                class="parent flex items-center gap-5">
                                                                                                <div
                                                                                                    class="ml-12 p-4 rounded-md border-purple-300 border-2 flex justify-between w-full items-center bg-purple-50">
                                                                                                    <p
                                                                                                        class="block w-[85%]">
                                                                                                        <span
                                                                                                            class="">[
                                                                                                            INDIKATOR
                                                                                                            PENUNJANG
                                                                                                            ]</span>
                                                                                                        {{ $indikator_penunjang->indikator_penunjang }}
                                                                                                    </p>
                                                                                                    @if (in_array($indikator_penunjang->id, $existingDataIndikatorPenunjang))
                                                                                                        @if (in_array($indikator_penunjang->id, $existingDataIndikatorPenunjangApproved))
                                                                                                            <div class="flex flex-col items-center text-center">
                                                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                    Approved
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div
                                                                                                                class="flex flex-col items-center text-center">
                                                                                                                <span
                                                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                    Data
                                                                                                                    sudah
                                                                                                                    diisi
                                                                                                                </span>
                                                                                                                <a href="{{ url('operator/edit-master-data/indikator_penunjang/' . $indikator_penunjang->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                    Edit
                                                                                                                    data
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <a
                                                                                                            href="{{ url('operator/tambah-master-data/indikator_penunjang/' . $indikator_penunjang->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                            <button
                                                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                                Input
                                                                                                                data
                                                                                                            </button>
                                                                                                        </a>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                                @foreach ($indikator->sub_indikator as $sub_indikator)
                                                                                    <li class="ml-16 mt-4">
                                                                                        <div
                                                                                            class="parent flex items-center gap-5">
                                                                                            <div
                                                                                                class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                                <p class="block w-[85%]">
                                                                                                    <span class="">[
                                                                                                        SUB
                                                                                                        INDIKATOR ]</span>
                                                                                                    {{ $sub_indikator->sub_indikator }}
                                                                                                </p>
                                                                                                @if (in_array($sub_indikator->id, $existingDataSubIndikator))
                                                                                                    @if (in_array($sub_indikator->id, $existingDataSubIndikatorApproved))
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                                                Approved
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div class="flex flex-col items-center text-center">
                                                                                                            <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                                                Data sudah diisi
                                                                                                            </span>
                                                                                                            <a href="{{ url('operator/edit-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                                            class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                                                Edit data
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <a
                                                                                                        href="{{ url('operator/tambah-master-data/sub_indikator/' . $sub_indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                                                        <button
                                                                                                            class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                                            Input
                                                                                                            data
                                                                                                        </button>
                                                                                                    </a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                    		</ul>
                    </li>
                    <li class="">
                        <div class="parent flex items-center gap-5">
                            <i
                                class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                            <div
                                class="p-4 rounded-md border-blue-300 border-2 flex justify-between w-full items-center bg-blue-50">
                                <p>Indikator Kinerja Utama Suplemen</p>
                            </div>
                        </div>
                        <ul class="child hidden ml-[14px] flex flex-col border-orange-300 border-l-2">
                            @foreach ($iku_sup as $tujuan)
                                <li class="ml-7 mt-4">
                                    <div class="parent flex items-center gap-5">
                                        <i
                                            class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                        <div
                                            class="p-4 rounded-md border-orange-300 border-2 flex justify-between w-full items-center bg-orange-50">
                                            <p class="block w-[85%] "><span class="">[ TUJUAN ]</span>
                                                {{ $tujuan->tujuan }}</p>
                                        </div>
                                    </div>
                                    <ul class="child hidden ml-[14px] flex flex-col border-green-300 border-l-2">
                                        @foreach ($tujuan->sasaran as $sasaran)
                                            <li class="ml-7 mt-4">
                                                <div class="parent flex items-center gap-5">
                                                    <i
                                                        class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                    <div
                                                        class="p-4 rounded-md border-green-300 border-2 flex justify-between w-full items-center bg-green-50">
                                                        <p class="block w-[85%] "><span class="">[ SASARAN ]</span>
                                                            {{ $sasaran->sasaran }}
                                                    </div>
                                                </div>
                                                <ul
                                                    class="child hidden ml-[14px] flex flex-col border-yellow-300 border-l-2">
                                                    @foreach ($sasaran->indikator as $indikator)
                                                        <li class="ml-16 mt-4">
                                                            <div class="parent flex items-center gap-5">
                                                                <div
                                                                    class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                    <p class="block w-[85%] "><span class="">[
                                                                            INDIKATOR
                                                                            ]</span>
                                                                        {{ $indikator->indikator }}</p>
                                                                    @if (in_array($indikator->id, $existingDataIndikator))
                                                                        @if (in_array($indikator->id, $existingDataIndikatorApproved))
                                                                            <div class="flex flex-col items-center text-center">
                                                                                <span class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-green-500 to-green-400 py-2 px-3 rounded-md text-white">
                                                                                    Approved
                                                                                </span>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="flex flex-col items-center text-center">
                                                                                <span
                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-red-500 to-red-400 py-1 px-3 rounded-t-md text-white">
                                                                                    Data
                                                                                    sudah
                                                                                    diisi
                                                                                </span>
                                                                                <a href="{{ url('operator/edit-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}"
                                                                                    class="w-full text-sm whitespace-nowrap bg-gradient-to-r from-blue-500 to-blue-400 py-1 px-3 rounded-b-md text-white">
                                                                                    Edit
                                                                                    data
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <a
                                                                            href="{{ url('operator/tambah-master-data/indikator/' . $indikator->id . '?triwulan=' . $selectedTriwulan) }}">
                                                                            <button
                                                                                class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-3 rounded-md font-medium transition-all text-sm whitespace-nowrap">
                                                                                Input
                                                                                data
                                                                            </button>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        @else
            <p
                class="mt-7 px-5 py-2 rounded-md border-red-500 border-2 flex justify-between w-full items-center bg-red-50">
                Pilih triwulan terlebih dahulu</p>
        @endif
    </div>
@endsection
