@extends('layouts.app')

@section('title', 'Perbarui Bidang')

@section('content')
    <div class="w-full p-5 h-full">
        <a class="font-medium text-2xl" href="{{ url('adminsistem/dashboard') }}">
            <i class="fa-solid fa-angle-left text-xl"></i> Perbarui Bidang
        </a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-5">
            <!-- Form Update Bidang -->
            <h3 class="font-medium text-lg mb-4">Pilih Bidang untuk Diperbarui</h3>
            <form action="{{ route('bidang.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id" class="block text-gray-700 font-medium">Pilih Bidang Lama</label>
                    <select name="id" id="id" class="w-full p-2 border rounded-lg">
                        @foreach ($bidang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="nama_bidang" class="block text-gray-700 font-medium">Perbarui Nama Bidang Lama</label>
                    <input type="text" name="nama_bidang" id="nama_bidang" class="w-full p-2 border rounded-lg" required>
                </div>
                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Perbarui
                </button>
            </form>
        </div>
    </div>

    <!-- Notifikasi Berhasil -->
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

    <!-- Notifikasi Error -->
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
