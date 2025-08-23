@extends('layouts.app')

@section('title', 'Edit Profil')
@section('content')
    @php
        function getRoleLabel($roleValue)
        {
            $roleOptions = [
                ['value' => '4', 'label' => 'Pimpinan'],
                ['value' => '3', 'label' => 'Admin Sistem'],
                ['value' => '2', 'label' => 'Admin Binagram'],
                ['value' => '1', 'label' => 'Admin Approval'],
                ['value' => '0', 'label' => 'Operator'],
            ];

            foreach ($roleOptions as $role) {
                if ($role['value'] === (string) $roleValue) {
                    return $role['label'];
                }
            }
            return 'Tidak Diketahui';
        }

        $userRole = Auth::user()->role;
        $dashboardUrl = '';

        if ($userRole == '3') {
            $dashboardUrl = url('adminsistem/dashboard');
        } elseif ($userRole == '2') {
            $dashboardUrl = url('adminbinagram/ikusup-ab');
        } elseif ($userRole == '4') {
            $dashboardUrl = url('pimpinan/dashboard');
        } elseif ($userRole == '1') {
            $dashboardUrl = url('adminapproval/dashboard');
        } elseif ($userRole == '0') {
            $dashboardUrl = url('operator/dashboard');
        } else {
            $dashboardUrl = '#';
        }
    @endphp

    @if (session('success'))
        <script>
            swal({
                title: "{{ session('success.title') }}",
                text: "{{ session('success.message') }}",
                icon: "success",
                button: "OK",
            }).then(() => {
                // Redirect the user to their appropriate dashboard
                window.location.href = "{{ $dashboardUrl }}";
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal({
                title: "Update Gagal!",
                text: "{{ implode('\n', $errors->all()) }}",
                icon: "error",
                button: "OK",
            });
        </script>
    @endif

    <div class="w-full p-5 h-full">
        <!-- 'Kembali' Button with the dynamic route to user's dashboard -->
        <a class="font-medium text-2xl" href="{{ $dashboardUrl }}">
            <i class="fa-solid fa-angle-left text-xl"></i> Kembali
        </a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-5">
        <h2 class="text-xl font-semibold mb-5">Edit Profil</h2>
        <form action="{{ route('user.update-profile', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" name="name" id="name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan nama Anda" value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan email Anda" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Password Lama -->
            <div class="mb-5">
                <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900">Password Lama</label>
                <input type="password" name="old_password" id="old_password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan password lama" required>
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password Baru
                    (Opsional)</label>
                <input type="password" name="password" id="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan password baru">
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ulangi password baru">
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="text-white bg-blue-500 hover:bg-blue-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Perbarui Profil
            </button>
        </form>
    </div>
    </div>
@endsection
