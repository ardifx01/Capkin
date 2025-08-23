@extends('layouts.app')

@section('title', 'Admin Sistem dashboard')

@section('content')
    <div class="w-full p-5 h-full">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-3">
            <div class="w-full flex justify-between">
                <div class="bg-white">
                    <form action="{{ route('search-user') }}" method="GET"
                        class="flex items-center text-gray-900 border border-gray-300 rounded-md w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 overflow-hidden">
                        <input type="text" name="search" id="table-search"
                            class="block py-2 px-4 outline-none text-sm w-full" placeholder="Cari user"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-400 text-white rounded-r-md hover:bg-blue-600">Cari</button>
                    </form>
                </div>
                <div>
                    <form action="{{ route('search-user') }}" method="GET" id="form-sorting">
                        <label for="filter" class="mr-2">Filter:</label>
                        <select required name="filter" id="filter"
                            class="px-4 py-2 text-sm outline-none cursor-pointer filter-select">
                            <option value="">Pilih</option>
                            <option value="nip">NIP</option>
                            <option value="name">Nama</option>
                            <option value="email">Email</option>
                            <option value="role">Role</option>
                            <option value="nama_bidang">Bidang
                            </option>
                        </select>
                        <select required name="sort_order" id="sort_order"
                            class="px-4 py-2 text-sm outline-none cursor-pointer sort-order">
                            <option value="">Pilih</option>
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                        </select>
                        <button type="submit"
                            class="ml-3 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-400 text-white rounded-md hover:bg-blue-600">Terapkan</button>
                    </form>
                </div>
                <a href="{{ url('adminsistem/tambah-user') }}">
                    <button
                        class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-400 hover:bg-blue-600 text-white py-2 px-6 rounded-md font-medium transition-all">
                        Tambah User
                        <i class="fa solid fa-plus"></i>
                    </button>
                </a>
            </div>
            <table id="userTable" class="w-full text-sm text-left rtl:text-left mt-5">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 h-full">
                    <tr class="h-full">
                        <th scope="col" class="p-4 w-4 text-left">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            NIP
                        </th>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Bidang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = $users->firstItem();
                        $roleLabels = [];
                        foreach ($roleOptions as $option) {
                            $roleLabels[$option['value']] = $option['label'];
                        }
                    @endphp
                    @forelse ($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="py-4 px-6 w-[30px]">{{ $index++ }}</td>
                            <td class="py-4 px-6 text-left">{{ $user->nip }}</td>
                            <td class="py-4 px-6 text-left">{{ $user->name }}</td>
                            <td class="py-4 px-6 text-left">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-left">{{ $roleLabels[$user->role] }}</td>
                            <td class="py-4 px-6 text-left">{{ $user->nama_bidang }}</td>
                            <td class="py-4 px-6 text-left gap-3 flex items-center">
                                <i data-id="{{ $user->id }}"
                                    class="btn-update fa-regular fa-pen-to-square text-blue-500 cursor-pointer"></i>
                                <i data-nip="{{ $user->nip }}" data-name="{{ $user->name }}"
                                    data-id="{{ $user->id }}"
                                    class="btn-delete fa-solid fa-trash text-red-500 cursor-pointer"></i>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b hover:bg-gray-50 text-center">
                            <td colspan="7" class="cotext-center py-5 font-bold">Tidak ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500  mb-4 md:mb-0 block w-full md:inline md:w-auto">Menampilkan
                    <span class="font-semibold text-gray-900 ">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span>
                    dari
                    <span class="font-semibold text-gray-900">{{ $users->total() }}</span></span>
                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    @if ($users->onFirstPage())
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg cursor-not-allowed">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $users->appends(request()->except('page'))->previousPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                        </li>
                    @endif

                    @foreach (range(1, $users->lastPage()) as $i)
                        @if ($i >= $users->currentPage() - 2 && $i <= $users->currentPage() + 2)
                            <li>
                                <a href="{{ $users->appends(request()->except('page'))->url($i) }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight {{ $i == $users->currentPage() ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($users->hasMorePages())
                        <li>
                            <a href="{{ $users->appends(request()->except('page'))->nextPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                        </li>
                    @else
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg cursor-not-allowed">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
