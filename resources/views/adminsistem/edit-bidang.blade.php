@extends('layouts.app')

@section('title', 'Hapus Bidang')

@section('content')
    <div class="w-full p-5 h-full">
        <a class="font-medium text-2xl" href="{{ url('adminsistem/dashboard') }}">
            <i class="fa-solid fa-angle-left text-xl"></i> Hapus Bidang
        </a>
        <div class="bg-white mt-5">
            <form action="{{ route('edit-bidang') }}" method="GET"
                class="flex items-center text-gray-900 border border-gray-300 rounded-md w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 overflow-hidden">
                <input type="text" name="search" id="table-search" class="block py-2 px-4 outline-none text-sm w-full"
                    placeholder="Cari bidang" value="{{ request('search') }}">
                <button type="submit"
                    class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-400 text-white rounded-r-md hover:bg-blue-600">Cari</button>
            </form>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-5">
            <h3 class="font-medium text-lg mb-4">Daftar Bidang</h3>
            @foreach ($bidang as $b)
                <div class="flex items-center justify-between mb-2 p-2 bg-gray-100 rounded-lg">
                    <span class="text-gray-700 font-medium">{{ $b->nama_bidang }}</span>
                    <form action="{{ route('bidang.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-500 hover:bg-red-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus</button>
                    </form>
                </div>
            @endforeach

            <!-- Navigasi Paginasi -->
            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                    Menampilkan <span
                        class="font-semibold text-gray-900">{{ $bidang->firstItem() }}-{{ $bidang->lastItem() }}</span>
                    dari <span class="font-semibold text-gray-900">{{ $bidang->total() }}</span>
                </span>
                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    @if ($bidang->onFirstPage())
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg cursor-not-allowed">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $bidang->appends(request()->except('page'))->previousPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                        </li>
                    @endif

                    @foreach (range(1, $bidang->lastPage()) as $i)
                        @if ($i >= $bidang->currentPage() - 2 && $i <= $bidang->currentPage() + 2)
                            <li>
                                <a href="{{ $bidang->appends(request()->except('page'))->url($i) }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight {{ $i == $bidang->currentPage() ? 'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @if ($bidang->hasMorePages())
                        <li>
                            <a href="{{ $bidang->appends(request()->except('page'))->nextPageUrl() }}"
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

    @if (session('success'))
        <script>
            swal({
                title: "{{ session('success.title') }}",
                text: "{{ session('success.message') }}",
                icon: "success",
                button: "OK",
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal({
                title: "Terjadi Kesalahan",
                text: "{{ implode(', ', $errors->all()) }}",
                icon: "error",
                button: "OK",
            });
        </script>
    @endif
@endsection
