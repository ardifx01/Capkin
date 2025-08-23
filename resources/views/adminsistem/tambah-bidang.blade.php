@extends('layouts.app')

@section('title', 'Tambah Bidang')

@section('content')
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
            var errorMessage = "";
            @foreach ($errors->all() as $error)
                errorMessage += "{{ $error }}\n";
            @endforeach

            Swal.fire({
                title: "Gagal!",
                text: errorMessage,
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>
    @endif

    <div class="w-full p-5 h-full">
        <a class="text-gray-600 font-semibold text-2xl" href="{{ url('adminsistem/dashboard') }}">
            <i class="fa-solid fa-angle-left text-xl"></i> Tambah Bidang
        </a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-5">
            <form class="mx-auto" action="{{ url('adminsistem/tambah-bidang') }}" method="post">
                {{ csrf_field() }}
                <div class="mb-5">
                    <label for="nama_bidang" class="block mb-2 text-sm font-medium text-gray-900">Nama Bidang</label>
                    <input type="text" name="nama_bidang" value="{{ old('nama_bidang') }}" id="nama_bidang"
                        class="shadow-sm bg-gray-20 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukkan Nama Bidang" required />
                </div>
                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
