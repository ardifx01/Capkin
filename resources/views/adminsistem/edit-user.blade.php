@extends('layouts.app')

@section('title', 'Admin Sistem dashboard')

@section('content')
    @php
        if (Request::is('adminsistem/*')) {
            $redirectUrl = url('adminsistem/dashboard');
        } elseif (Request::is('adminbinagram/*')) {
            $redirectUrl = url('adminbinagram/dashboard');
        } elseif (Request::is('adminapproval/*')) {
            $redirectUrl = url('adminapproval/dashboard');
        } elseif (Request::is('operator/*')) {
            $redirectUrl = url('operator/dashboard');
        } elseif (Request::is('pimpinan/*')) {
            $redirectUrl = url('pimpinan/dashboard');
        }
    @endphp
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
                window.location.href = "{{ $redirectUrl }}";
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
            $dashboardUrl = url('adminbinagram/dashboard');
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
    @php
        if (Request::is('adminsistem/edit-user/*')) {
            $actionUrl = url('adminsistem/edit-user/' . $user->id);
        } elseif (Request::is('adminbinagram/edit-user/*')) {
            $actionUrl = url('adminbinagram/edit-user/' . $user->id);
        } else {
            $actionUrl = '#'; // Default action jika path tidak sesuai
        }
    @endphp

    <div class="w-full p-5 h-full">
        <a class="font-medium text-2xl" href="{{ $dashboardUrl }}"><i class="fa-solid fa-angle-left text-xl"></i> Edit User</a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 bg-white mt-5">
            <form class="mx-auto" action="{{ $actionUrl }}" method="post">
                {{ csrf_field() }}
                @method('PUT')
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" id="nama"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan nama user" />
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan email" />
                </div>
                <div class="mb-5">
                    <label for="nip" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor Induk Pegawai</label>
                    <input type="text" name="nip" value="{{ old('nip', $user->nip) }}" id="nip"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukkan NIP user" />
                </div>
                <div class="mb-5">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Bidang</label>
                    <select name="bidang_id" id="bidang"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-white-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Bidang pengguna">
                        <option value="{{ $joinBidang->id }}">{{ $joinBidang->nama_bidang }}</option>
                        @foreach ($bidang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_bidang }}</option>
                        @endforeach
                    </select>
                    <div class="mb-5">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <select name="role" id="role"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-white-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Peran pengguna">
                            <option value="{{ $user->role }}">{{ getRoleLabel($user->role) }}</option>
                            @foreach ($roleOptions as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
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
                        class="text-white bg-blue-500 hover:bg-blue-600 transition-all focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Perbarui
                        data</button>
            </form>
        </div>

    </div>
@endsection
