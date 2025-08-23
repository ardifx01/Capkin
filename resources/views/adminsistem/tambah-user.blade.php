@extends('layouts.app')

@section('title', 'Admin Sistem dashboard')

@section('content')
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
                window.location.href = "{{ url('adminsistem/dashboard') }}";
            });
        </script>
    @endif
    @if (!empty(session('warning')))
        <script>
            swal({
                title: "{{ Session::get('warning.title') }}",
                text: "{{ Session::get('warning.message') }}",
                icon: "warning",
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

            swal("Registration Failed!", errorMessage, "error", {
                button: true,
                button: "OK",
            });
        </script>
    @endif
    <div class="w-full p-5 h-full">
        <a class="text-gray-600 font-semibold text-2xl" href="{{ url('adminsistem/dashboard') }}"><i
                class="fa-solid fa-angle-left text-xl"></i> Tambah User</a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-5">
            <form class="mx-auto" action="{{ url('adminsistem/tambah-user') }}" method="post">
                {{ csrf_field() }}
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" id="nama"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan nama user" />
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan email" />
                </div>
                <div class="mb-5">
                    <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor Induk Pegawai</label>
                    <input type="text" name="nip" value="{{ old('nip') }}" id="nip"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan NIP user" />
                </div>
                <div class="mb-5">
                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900">Bidang</label>
                    <select id="bidang" name="bidang_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="">Pilih Bidang</option>
                        @foreach ($bidang as $b)
                            <option {{ old('bidang_id') == $b->id ? 'selected' : '' }} value="{{ $b->id }}">
                                {{ $b->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                    <select id="role" name="role"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                        <option value="">Pilih Role</option>
                        @foreach ($roleOptions as $option)
                            <option {{ old('role') == $option['value'] ? 'selected' : '' }}
                                value="{{ $option['value'] }}">
                                {{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" value="" name="password" id="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan password" />
                </div>
                <div class="mb-5">
                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 ">Ulangi
                        password</label>
                    <input type="password" value="" name="confirm_password" id="repeat-password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Ulangi password di atas" />
                </div>
                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Daftarkan
                    Akun</button>
            </form>
        </div>
    </div>
@endsection
