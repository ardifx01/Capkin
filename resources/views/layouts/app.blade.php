<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>@yield('title')</title>
    <!-- Add your stylesheets and scripts here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @php
        $roleOptions = [
            ['value' => '4', 'label' => 'Pimpinan'],
            ['value' => '3', 'label' => 'Admin Sistem'],
            ['value' => '2', 'label' => 'Admin Binagram'],
            ['value' => '1', 'label' => 'Admin Approval'],
            ['value' => '0', 'label' => 'Operator'],
        ];

        $bidangOptions = [
            7 => 'Pimpinan',
            6 => 'Fungsi IPDS',
            5 => 'Fungsi Nerwilis',
            4 => 'Fungsi Statistik Distribusi',
            3 => 'Fungsi Statistik Produksi',
            2 => 'Fungsi Statistik Sosial',
            1 => 'Bagian Umum',
        ];

        $userRoleLabel = '';
        foreach ($roleOptions as $roleOption) {
            if ($roleOption['value'] == Auth::user()->role) {
                $userRoleLabel = $roleOption['label'];
                break;
            }
        }

        $firstLetter = strtoupper(substr(Auth::user()->name, 0, 1));
        $idUser = Auth::user()->id;
        $userBidang = $bidangOptions[Auth::user()->bidang_id] ?? 'Unknown';

    @endphp
    <div class="wrapper">
        <!-- Header -->
        <header
            class="flex items-center justify-between py-4 px-10 h-20 fixed left-0 bg-white z-20 top-0 w-full border-b-2">
            @if (Auth::check())
                <img src="{{ asset('assets/logo-auth.png') }}" class="w-18 h-14" />
                <div class="flex items-center gap-6">
                    <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                        <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                    </a>
                    <div class="relative">
                        <div
                            class="profile-btn flex select-none items-center justify-center text-white rounded-full bg-gray-700 w-7 h-7 text-xs cursor-pointer">
                            {{ $firstLetter }}</div>
                        <div id="profile-container"
                            class="absolute flex flex-col items-center gap-2 hidden w-[300px] rounded-md z-10 shadow-md right-0 bg-white p-5">
                            <div
                                class="flex select-none items-center justify-center text-white rounded-full bg-gray-700 w-12 h-12 text-xl cursor-pointer">
                                {{ $firstLetter }}
                            </div>
                            <div class="flex flex-col items-center">
                                <p class="font-medium text-lg">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <div class="flex flex-col w-full mt-5 border-t-2 pt-5 gap-2">
                                <i class="btn-update w-full menu-item cursor-pointer not-italic">
                                    <a href="{{ route('user.edit-profile', ['id' => $idUser]) }}"
                                        data-id="{{ $idUser }}">
                                        <div
                                            class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                            <i class="fa-solid fa-gear my-auto w-1/12"></i>
                                            <p class="text-sm">Edit profile</p>
                                        </div>
                                    </a>
                                </i>
                                <a class="logout-btn w-full menu-item cursor-pointer " href="{{ route('logout') }}">
                                    {{-- <div
                                    class="flex justify-left gap-6 mb-5 mt-3 bg-gradient-to-r from-blue-500 to-blue-400 px-6 py-3 rounded-lg text-white">
                                    <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                    <p class="text-sm">Log out</p>
                                </div> --}}
                                    <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                                        <div
                                            class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                            <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                            <p class="text-sm">Log out</p>
                                        </div>
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </header>

        <!-- Sidebar -->
        <aside class="top-20 fixed left-0 w-[260px] border-r-2 z-10" style="height: calc(100vh - 80px)">
            <div class="w-full h-full flex flex-col overflow-x-hidden p-5">
                @if (Auth::check())
                    <div
                        class="mb-5 mt-3 sticky top-4 bg-gradient-to-r {{ Auth::user()->bidang_id == 1
                            ? " from-violet-500
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    to-fuchsia-500"
                            : (Auth::user()->bidang_id == 2
                                ? 'from-blue-500 to-cyan-500'
                                : (Auth::user()->bidang_id == 3
                                    ? 'from-teal-500 to-sky-500'
                                    : (Auth::user()->bidang_id == 4
                                        ? 'from-red-500 to-amber-500'
                                        : (Auth::user()->bidang_id == 5
                                            ? 'from-cyan-500 to-emerald-500'
                                            : (Auth::user()->bidang_id == 6
                                                ? 'from-rose-500 to-pink-500'
                                                : 'from-sky-500 to-indigo-500'))))) }} p-5 rounded-lg text-white">
                        <div
                            class="flex items-center justify-center text-blue-500 font-bold rounded-full bg-white w-9 h-9 text-sm cursor-pointer">
                            {{ $firstLetter }}</div>
                        <div class="mt-5">
                            <p class="font-medium text-lg">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-start">
                                {{ $userBidang }}
                                {{-- {{ $userRoleLabel }} --}}
                            </p>
                        </div>
                        <div class="mt-5 text-white text-sm border-t pt-3">
                            <p>{{ $userRoleLabel }}</p>
                            {{-- <p>{{ $userBidang }}</p> --}}
                        </div>
                    </div>
                @endif
                {{-- sidebar menu --}}
                <div class="flex flex-col gap-4 w-full h-full">
                    {{-- pimpinan --}}
                    @if (Auth::user()->role == 4)
                        <div class="flex flex-col h-full gap-3 w-full justify-between">
                            <div class="flex flex-col w-full gap-1">
                                <a href="{{ route('dashboard-pimpinan') }}" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-house my-auto text-xs w-1/12"></i>
                                        <p class="text-sm">Dashboard</p>
                                    </div>
                                </a>
                                <a href="{{ route('ikusup') }}" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-house my-auto text-xs w-1/12"></i>
                                        <p class="text-sm">Iku Suplemen</p>
                                    </div>
                                </a>
                            </div>
                            <div class="">
                                <a href="{{ route('user.edit-profile', ['id' => $idUser]) }}" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-gear my-auto w-1/12"></i>
                                        <p class="text-sm">Edit profile</p>
                                    </div>
                                </a>
                                <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                        <p class="text-sm">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    {{-- admin sistem --}}
                    @if (Auth::user()->role == 3)
                        <div class="flex flex-col h-full gap-3 w-full justify-between">
                            <div class="flex flex-col w-full gap-1">
                                <a href="/adminsistem/dashboard" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-user my-auto text-xs w-1/12"></i>
                                        <p class="text-sm">Daftar User</p>
                                    </div>
                                </a>
                                <a href="/adminsistem/tambah-user" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-plus my-auto text-xs w-1/12"></i>
                                        <p class="text-sm">Tambah User</p>
                                    </div>
                                </a>
                                <div class="flex flex-col gap-3 w-full pl-6 mt-4 dropdown-parent overflow-hidden ">
                                    <div class="flex w-full gap-[22px] cursor-pointer dropdown-button">
                                        <i class="fa-solid fa-angle-down my-auto text-xs w-1/12 dropdown-icon"></i>
                                        <p class="text-sm font-medium">Tentang Bidang</p>
                                    </div>
                                    <div
                                        class="pl-4 flex flex-col w-full gap-1 dropdown-child relative duration-300 transition-all max-h-0 overflow-hidden">
                                        <a href="/adminsistem/tambah-bidang" class="w-full menu-item">
                                            <div
                                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                                <i class="fa-solid fa-plus my-auto text-xs w-1/12"></i>
                                                <p class="text-sm">Tambah</p>
                                            </div>
                                        </a>
                                        <a href="/adminsistem/edit-bidang" class="w-full menu-item">
                                            <div
                                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                                <i class="fa-solid fa-trash my-auto text-xs w-1/12"></i>
                                                <p class="text-sm">Hapus</p>
                                            </div>
                                        </a>
                                        <a href="/adminsistem/update-bidang" class="w-full menu-item">
                                            <div
                                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                                <i class="fa-solid fa-pen my-auto text-xs w-1/12"></i>
                                                <p class="text-sm">Perbarui</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <a href="{{ route('user.edit-profile', ['id' => $idUser]) }}"
                                    class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-gear my-auto w-1/12"></i>
                                        <p class="text-sm">Edit profile</p>
                                    </div>
                                </a>
                                <a class="logout-btn w-full menu-item cursor-pointer ">
                                    {{-- <div
                                    class="flex justify-left gap-6 mb-5 mt-3 bg-gradient-to-r from-blue-500 to-blue-400 px-6 py-3 rounded-lg text-white">
                                    <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                    <p class="text-sm">Log out</p>
                                </div> --}}
                                    <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                                        <div
                                            class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                            <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                            <p class="text-sm">Log out</p>
                                        </div>
                                    </a>
                            </div>
                        </div>
                    @endif
                    {{-- admin binagram --}}
                    @if (Auth::user()->role == 2)
                        <div class="flex flex-col h-full gap-3 w-full justify-between">
                            <div class="flex flex-col w-full gap-1">
                                <a href="{{ route('dashboard-ab') }}" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-house my-auto text-xs w-1/12"></i>
                                        <p class="text-sm">Dashboard</p>
                                    </div>
                                </a>
                                <a href="{{ route('view_master_data') }}" class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-house my-auto text-xs w-1/12"></i>
                                        <p class="text-sm">Home</p>
                                    </div>
                                </a>
                                <div class="flex flex-col gap-3 w-full pl-6 mt-4 dropdown-parent overflow-hidden ">
                                    <div class="flex w-full gap-[22px] cursor-pointer dropdown-button">
                                        <i class="fa-solid fa-angle-down my-auto text-xs w-1/12 dropdown-icon"></i>
                                        <p class="text-sm font-medium">Dokumen</p>
                                    </div>
                                    <div
                                        class="pl-4 flex flex-col w-full gap-1 dropdown-child relative duration-300 transition-all max-h-0 overflow-hidden">
                                        <a href="{{ route('search-data-pending-ab') }}" class="w-full menu-item">
                                            <div
                                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                                <i class="fa-solid fa-file-circle-question my-auto text-xs w-1/12"></i>
                                                <p class="text-sm">Pending</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('search-data-approved-ab') }}" class="w-full menu-item">
                                            <div
                                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                                <i class="fa-solid fa-file-circle-check my-auto text-xs w-1/12"></i>
                                                <p class="text-sm">Approved</p>
                                            </div>
                                        </a>
                                        <a href="{{ route('search-data-rejected-ab') }}" class="w-full menu-item">
                                            <div
                                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                                <i class="fa-solid fa-file-circle-xmark my-auto text-xs w-1/12"></i>
                                                <p class="text-sm">Rejected</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <a href="{{ route('user.edit-profile', ['id' => $idUser]) }}"
                                    class="w-full menu-item">
                                    <div
                                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fa-solid fa-gear my-auto w-1/12"></i>
                                        <p class="text-sm">Edit profile</p>
                                    </div>
                                </a>
                                <a class="logout-btn w-full menu-item cursor-pointer ">
                                    {{-- <div
                                    class="flex justify-left gap-6 mb-5 mt-3 bg-gradient-to-r from-blue-500 to-blue-400 px-6 py-3 rounded-lg text-white">
                                    <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                    <p class="text-sm">Log out</p>
                                </div> --}}
                                    <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                                        <div
                                            class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                            <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                                            <p class="text-sm">Log out</p>
                                        </div>
                                    </a>
                                </a>
                            </div>
                        </div>
                </div>
            </div>
    </div>
    @endif
    {{-- admin approval --}}
    @if (Auth::user()->role == 1)
        <div class="flex flex-col h-full gap-3 w-full justify-between">
            <div class="flex flex-col w-full gap-1">
                <a href="{{ route('search-data-pending-ap') }}" class="w-full menu-item">
                    <div
                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-5 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fa-solid fa-file-circle-question my-auto text-xs w-1/12"></i>
                        <p class="text-sm">Dokumen Operator</p>
                    </div>
                </a>
                <div class="flex flex-col gap-3 w-full pl-6 mt-4 dropdown-parent overflow-hidden ">
                    <div class="flex w-full gap-[22px] cursor-pointer dropdown-button">
                        <i class="fa-solid fa-angle-down my-auto text-xs w-1/12 dropdown-icon"></i>
                        <p class="text-sm font-medium">Dokumen</p>
                    </div>
                    <div
                        class="pl-4 flex flex-col w-full gap-1 dropdown-child relative duration-300 transition-all max-h-0 overflow-hidden">
                        <a href="{{ route('search-data-approved-ap') }}" class="w-full menu-item">
                            <div
                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fa-solid fa-file-circle-check my-auto text-xs w-1/12"></i>
                                <p class="text-sm">Approved</p>
                            </div>
                        </a>
                        <a href="{{ route('search-data-rejected-ap') }}" class="w-full menu-item">
                            <div
                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fa-solid fa-file-circle-xmark my-auto text-xs w-1/12"></i>
                                <p class="text-sm">Rejected</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="">
                <a href="{{ route('user.edit-profile', ['id' => $idUser]) }}"class="w-full menu-item">
                    <div
                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fa-solid fa-gear my-auto w-1/12"></i>
                        <p class="text-sm">Edit profile</p>
                    </div>
                </a>
                <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                    <div
                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                        <p class="text-sm">Log out</p>
                    </div>
                </a>
            </div>
        </div>
    @endif
    {{-- operator --}}
    @if (Auth::user()->role == 0)
        <div class="flex flex-col h-full gap-3 w-full justify-between">
            <div class="flex flex-col w-full gap-1">
                <a href="{{ route('dashboard') }}" class="w-full menu-item">
                    <div
                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fa-solid fa-briefcase my-auto text-xs w-1/12"></i>
                        <p class="text-sm">Capaian Kinerja</p>
                    </div>
                </a>
                <div class="flex flex-col gap-3 w-full pl-6 mt-4 dropdown-parent overflow-hidden ">
                    <div class="flex w-full gap-[22px] cursor-pointer dropdown-button">
                        <i class="fa-solid fa-angle-down my-auto text-xs w-1/12 dropdown-icon"></i>
                        <p class="text-sm font-medium">Dokumen</p>
                    </div>
                    <div
                        class="pl-4 flex flex-col w-full gap-1 dropdown-child relative duration-300 transition-all max-h-0 overflow-hidden">
                        <a href="{{ route('search-data-pending') }}" class="w-full menu-item">
                            <div
                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fa-solid fa-file-circle-question my-auto text-xs w-1/12"></i>
                                <p class="text-sm">Pending</p>
                            </div>
                        </a>
                        <a href="{{ route('search-data-approved') }}" class="w-full menu-item">
                            <div
                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fa-solid fa-file-circle-check my-auto text-xs w-1/12"></i>
                                <p class="text-sm">Approved</p>
                            </div>
                        </a>
                        <a href="{{ route('search-data-rejected') }}" class="w-full menu-item">
                            <div
                                class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fa-solid fa-file-circle-xmark my-auto text-xs w-1/12"></i>
                                <p class="text-sm">Rejected</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                <a href="{{ route('user.edit-profile', ['id' => $idUser]) }}"class="w-full menu-item">
                    <div
                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fa-solid fa-gear my-auto w-1/12"></i>
                        <p class="text-sm">Edit profile</p>
                    </div>
                </a>
                <a href="#" class="logout-btn" data-url="{{ route('logout') }}">
                    <div
                        class="flex justify-left gap-6 w-full rounded-lg py-3 px-6 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fa-solid fa-arrow-right-from-bracket my-auto w-1/12"></i>
                        <p class="text-sm">Log out</p>
                    </div>
                </a>
            </div>
        </div>
    @endif
    </div>
    </div>
    </aside>

    <!-- Content -->
    <main class="relative top-20 left-[260px] min-h-screen bg-gray-50" style="width: calc(100vw - 279px)">
        @yield('content')
    </main>

    {{-- <div class="fixed top-0 left-0 w-full h-full z-50 bg-[#0000006c]">
            @yield('popup')
        </div> --}}
    </div>
    <!-- Add your scripts here -->

</body>

</html>
