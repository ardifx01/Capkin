@extends('layouts.app')

@section('title', 'Admin Binagram home')

@section('content')
    <div class="w-full p-5 h-full">
        <h2 class="text-gray-600 font-semibold text-2xl">Daftar Triwulan</h2>
        <div class="my-5 bg-white p-5 rounded shadow">
            <table id="dataIkuTable" class="w-full text-sm text-left rtl:text-left mt-5">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 h-full">
                    <tr class="h-full">
                        <th scope="col" class="p-4 w-4 text-left">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $indexTriwulan = 1;
                    @endphp
                    @foreach ($triwulan as $data)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="py-4 px-6 w-[30px]">{{ $indexTriwulan++ }}</td>
                            <td class="py-4 px-6 text-left">
                                {{ $data->triwulan }}
                            </td>
                            @if ($data->status === 'close')
                                <td class="py-4 px-6 text-center p-2 w-[100px]">
                                    <p class="px-5 py-2  text-center rounded bg-red-100 border-2 border-red-500">Ditutup</p>
                                </td>
                            @else
                                <td class="py-4 px-6 text-center p-2 w-[100px]">
                                    <p class="px-5 py-2  text-center rounded bg-green-100 border-2 border-green-500">Dibuka
                                    </p>
                                </td>
                            @endif
                            <td class="py-4 px-6 text-center gap-3 flex items-center justify-center">
                                <i class="activate-triwulan text-blue-500 hover:text-blue-700" data-id="{{ $data->id }}"
                                    data-triwulan="{{ $data->triwulan }}" data-status="{{ $data->status }}">
                                    <button class="bg-blue-500 hover:bg-blue-600 text-slate-100 px-6 py-3 rounded">
                                        Edit Status
                                    </button>
                                </i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <h2 class="text-gray-600 font-semibold text-2xl mt-10 border-t-2 border-gray-300 pt-7">Daftar IKU</h2>
        <div class="mt-5 bg-white p-5 rounded shadow">
            <ul class="flex flex-col gap-4">
                <li class="">
                    <div class="parent flex items-center gap-5">
                        <i
                            class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                        <div
                            class="p-4 rounded-md border-blue-300 border-2 flex justify-between w-full items-center bg-blue-50">
                            <p>Indikator Kinerja Utama</p>
                            <div class="flex gap-4">
                                <i class="add-tujuan fa-solid fa-plus text-green-400 cursor-pointer" data-iku="0"
                                    data-text="Indikator Kinerja Utama"></i>
                            </div>
                        </div>
                    </div>
                    <ul class="child hidden ml-[14px] flex flex-col border-orange-300 border-l-2">
                        @foreach ($iku as $tujuan)
                            <li class="ml-7 mt-4">
                                <div class="parent flex items-center gap-5">
                                    <i
                                        class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                    <div
                                        class="p-4 rounded-md border-orange-300 border-2 flex justify-between w-full items-center bg-orange-50">
                                        <p class="block w-[90%] "><span class="">[ TUJUAN ]</span>
                                            {{ $tujuan->tujuan }}</p>
                                        <div class="flex gap-4">
                                            <i class="edit-tujuan fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                data-id="{{ $tujuan->id }}" data-tujuan="{{ $tujuan->tujuan }}"></i>
                                            <i class="delete-tujuan fa-solid fa-trash text-red-500 cursor-pointer"
                                                data-id="{{ $tujuan->id }}" data-tujuan="{{ $tujuan->tujuan }}"></i>
                                            <i class="add-sasaran fa-solid fa-plus text-green-400 cursor-pointer"
                                                data-tujuan-id="{{ $tujuan->id }}"
                                                data-text="{{ $tujuan->tujuan }}"></i>
                                        </div>
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
                                                    <p class="block w-[90%] "><span class="">[ SASARAN ]</span>
                                                        {{ $sasaran->sasaran }}
                                                    </p>
                                                    <div class="flex gap-4">
                                                        <i class="edit-sasaran fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                            data-id="{{ $sasaran->id }}"
                                                            data-sasaran="{{ $sasaran->sasaran }}"></i>
                                                        <i class="delete-sasaran fa-solid fa-trash text-red-500 cursor-pointer"
                                                            data-id="{{ $sasaran->id }}"
                                                            data-sasaran="{{ $sasaran->sasaran }}"></i>
                                                        <i class="add-indikator fa-solid fa-plus text-green-400 cursor-pointer"
                                                            data-sasaran-id="{{ $sasaran->id }}"
                                                            data-text="{{ $sasaran->sasaran }}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($sasaran->indikator->isNotEmpty())
                                                <ul
                                                    class="child hidden ml-[14px] flex flex-col border-yellow-300 border-l-2">
                                                    @foreach ($sasaran->indikator as $indikator)
                                                        <li class="ml-7 mt-4">
                                                            @php
                                                                $last_bidang_id = null;
                                                            @endphp
                                                            @if ($indikator->indikator_penunjang()->exists() || $indikator->sub_indikator->isNotEmpty())
                                                                <div class="parent flex items-center gap-5">
                                                                    <i
                                                                        class="fa-solid btn fa-plus cursor-pointer p-2 rounded-md text-gray-800 w-auto h-auto bg-gray-100 hover:bg-gray-200 block"></i>
                                                                    <div
                                                                        class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                        <p class="block w-[90%] "><span class="">[
                                                                                INDIKATOR ]</span>
                                                                            {{ $indikator->indikator }}</p>
                                                                        <div class="flex gap-4">
                                                                            <i class="edit-indikator fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                                                data-id="{{ $indikator->id }}"
                                                                                data-indikator="{{ $indikator->indikator }}"></i>
                                                                            <i class="delete-indikator fa-solid fa-trash text-red-500 cursor-pointer"
                                                                                data-id="{{ $indikator->id }}"
                                                                                data-indikator="{{ $indikator->indikator }}"></i>
                                                                            <i class="add-indikator-penunjang fa-solid fa-plus text-green-400 cursor-pointer"
                                                                                data-indikator-id="{{ $indikator->id }}"
                                                                                data-text="{{ $indikator->indikator }}"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($indikator->indikator_penunjang()->exists())
                                                                    <ul
                                                                        class="child hidden ml-[14px] flex flex-col gap-4 border-purple-300 border-l-2">
                                                                        @foreach ($indikator->indikator_penunjang as $indikator_penunjang)
                                                                            @foreach ($indikator_penunjang->sub_indikator as $sub_indikator)
                                                                                @if ($sub_indikator->bidang_id != $last_bidang_id)
                                                                                    <li class="ml-16 mt-4">
                                                                                        <h3
                                                                                            class="font-semibold text-lg text-gray-600">
                                                                                            {{ $sub_indikator->bidang->nama_bidang }}
                                                                                        </h3>
                                                                                    </li>
                                                                                    @php
                                                                                        $last_bidang_id =
                                                                                            $sub_indikator->bidang_id;
                                                                                    @endphp
                                                                                @endif
                                                                                <li class="ml-16 mt-4">
                                                                                    <div
                                                                                        class="parent flex items-center gap-5">
                                                                                        <div
                                                                                            class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                            <p><span class="">[
                                                                                                    SUB INDIKATOR
                                                                                                    ]</span>
                                                                                                {{ $sub_indikator->sub_indikator }}
                                                                                            </p>
                                                                                            <div class="flex gap-4">
                                                                                                <i class="edit-sub-indikator fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                                                                    data-id="{{ $sub_indikator->id }}"
                                                                                                    data-sub_indikator="{{ $sub_indikator->sub_indikator }}"
                                                                                                    data-bidang_id="{{ $sub_indikator->bidang_id }}"></i>
                                                                                                <i class="delete-sub-indikator fa-solid fa-trash text-red-500 cursor-pointer"
                                                                                                    data-id="{{ $sub_indikator->id }}"
                                                                                                    data-sub_indikator="{{ $sub_indikator->sub_indikator }}"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    <ul
                                                                        class="child hidden ml-[14px] flex flex-col gap-4 border-cyan-300 border-l-2">
                                                                        @foreach ($indikator->sub_indikator as $sub_indikator)
                                                                            @if ($sub_indikator->bidang_id != $last_bidang_id)
                                                                                <li class="ml-16 mt-4">
                                                                                    <h3
                                                                                        class="font-semibold text-lg text-gray-600">
                                                                                        {{ $sub_indikator->bidang->nama_bidang }}
                                                                                    </h3>
                                                                                </li>
                                                                                @php
                                                                                    $last_bidang_id =
                                                                                        $sub_indikator->bidang_id;
                                                                                @endphp
                                                                            @endif
                                                                            <li class="ml-16 mt-4">
                                                                                <div
                                                                                    class="parent flex items-center gap-5">
                                                                                    <div
                                                                                        class="p-4 rounded-md border-cyan-300 border-2 flex justify-between w-full items-center bg-cyan-50">
                                                                                        <p><span class="">[ SUB
                                                                                                INDIKATOR ]</span>
                                                                                            {{ $sub_indikator->sub_indikator }}
                                                                                        </p>
                                                                                        <div class="flex gap-4">
                                                                                            <i class="edit-sub-indikator fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                                                                data-id="{{ $sub_indikator->id }}"
                                                                                                data-sub_indikator="{{ $sub_indikator->sub_indikator }}"
                                                                                                data-bidang_id="{{ $sub_indikator->bidang_id }}"></i>
                                                                                            <i class="delete-sub-indikator fa-solid fa-trash text-red-500 cursor-pointer"
                                                                                                data-id="{{ $sub_indikator->id }}"
                                                                                                data-sub_indikator="{{ $sub_indikator->sub_indikator }}"></i>
                                                                                        </div>
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
                                                                        <p><span class="">[ INDIKATOR ]</span>
                                                                            {{ $indikator->indikator }}</p>
                                                                        <div class="flex gap-4">
                                                                            <i class="edit-indikator fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                                                data-id="{{ $indikator->id }}"
                                                                                data-indikator="{{ $indikator->indikator }}"></i>
                                                                            <i class="delete-indikator fa-solid fa-trash text-red-500 cursor-pointer"
                                                                                data-id="{{ $indikator->id }}"
                                                                                data-indikator="{{ $indikator->indikator }}"></i>
                                                                        </div>
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
                            <div class="flex gap-4">
                                <i class="add-tujuan fa-solid fa-plus text-green-400 cursor-pointer" data-iku="1"
                                    data-text="Indikator Kinerja Utama Suplemen"></i>
                            </div>
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
                                        <p class="block w-[90%] "><span class="">[ TUJUAN ]</span>
                                            {{ $tujuan->tujuan }}</p>
                                        <div class="flex gap-4">
                                            <i class="edit-tujuan fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                data-id="{{ $tujuan->id }}" data-tujuan="{{ $tujuan->tujuan }}"></i>
                                            <i class="delete-tujuan fa-solid fa-trash text-red-500 cursor-pointer"
                                                data-id="{{ $tujuan->id }}" data-tujuan="{{ $tujuan->tujuan }}"></i>
                                            <i class="add-sasaran fa-solid fa-plus text-green-400 cursor-pointer"
                                                data-tujuan-id="{{ $tujuan->id }}"
                                                data-text="{{ $tujuan->tujuan }}"></i>
                                        </div>
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
                                                    <p class="block w-[90%] "><span class="">[ SASARAN ]</span>
                                                        {{ $sasaran->sasaran }}
                                                    <div class="flex gap-4">
                                                        <i class="edit-sasaran fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                            data-id="{{ $sasaran->id }}"
                                                            data-sasaran="{{ $sasaran->sasaran }}"></i>
                                                        <i class="delete-sasaran fa-solid fa-trash text-red-500 cursor-pointer"
                                                            data-id="{{ $sasaran->id }}"
                                                            data-sasaran="{{ $sasaran->sasaran }}"></i>
                                                        <i class="add-indikator fa-solid fa-plus text-green-400 cursor-pointer"
                                                            data-sasaran-id="{{ $sasaran->id }}"
                                                            data-text="{{ $sasaran->sasaran }}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="child hidden ml-[14px] flex flex-col border-yellow-300 border-l-2">
                                                @foreach ($sasaran->indikator as $indikator)
                                                    <li class="ml-16 mt-4">
                                                        <div class="parent flex items-center gap-5">
                                                            <div
                                                                class="p-4 rounded-md border-yellow-300 border-2 flex justify-between w-full items-center bg-yellow-50">
                                                                <p class="block w-[90%] "><span class="">[ INDIKATOR
                                                                        ]</span>
                                                                    {{ $indikator->indikator }}</p>
                                                                <div class="flex gap-4">
                                                                    <i class="edit-indikator fa-regular fa-pen-to-square text-blue-400 cursor-pointer"
                                                                        data-id="{{ $indikator->id }}"
                                                                        data-indikator="{{ $indikator->indikator }}"></i>
                                                                    <i class="delete-indikator fa-solid fa-trash text-red-500 cursor-pointer"
                                                                        data-id="{{ $indikator->id }}"
                                                                        data-indikator="{{ $indikator->indikator }}"></i>
                                                                </div>
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
    </div>
@endsection
