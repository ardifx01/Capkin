<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminSistemController extends Controller
{
    private function getRoleOptions()
    {
        return [
            ['value' => '4', 'label' => 'Pimpinan'],
            ['value' => '3', 'label' => 'Admin Sistem'],
            ['value' => '2', 'label' => 'Admin Binagram'],
            ['value' => '1', 'label' => 'Admin Approval'],
            ['value' => '0', 'label' => 'Operator'],
        ];
    }
    private function customValidationMessages()
    {
        return [
            "name.required" => "Nama harus diisi.",
            "name.max" => "Nama tidak boleh lebih dari 100 karakter.",
            "email.required" => "Email harus diisi.",
            "email.unique" => "Email sudah digunakan.",
            "nip.required" => "NIP harus diisi.",
            "nip.unique" => "NIP sudah digunakan.",
            "bidang_id.required" => "Bidang harus dipilih.",
            "password.required" => "Password harus diisi.",
            "password.min" => "Password harus terdiri minimal 6 karakter.",
            "password.numbers" => "Password harus mengandung angka.",
            "password.letters" => "Password harus mengandung huruf.",
            "confirm_password.required_with" => "Konfirmasi password harus diisi.",
            "confirm_password.same" => "Konfirmasi password tidak cocok dengan password.",
            "role.required" => "Role harus dipilih."
        ];
    }

    public function view_add_user()
    {
        $roleOptions = $this->getRoleOptions();

        $bidang = Bidang::all();

        return view("adminsistem.tambah-user")->with(compact(['roleOptions', 'bidang']));
    }


    public function view_update_user($id)
    {
        $user = User::findOrFail($id);
        $bidang = Bidang::all();

        $roleOptions = $this->getRoleOptions();

        $joinBidang = User::leftjoin('bidang', 'users.bidang_id', '=', 'bidang.id')
            ->select('users.*', 'bidang.nama_bidang')
            ->findOrFail($id);

        return view("adminsistem.edit-user")->with(compact('joinBidang', 'user', 'bidang', 'roleOptions'));
    }

    public function create_user(Request $request)
    {
        $user = request()->validate(
            [
                "name" => ["required", "max:100"],
                "email" => ["required", "unique:users"],
                "nip" => ["required", "unique:users"],
                "bidang_id" => ["required"],
                "password" => ["required", Password::min(6)->numbers()->letters()],
                "confirm_password" => ["required_with:password", "same:password"],
                "role" => "required"
            ],
            $this->customValidationMessages()
        );

        $user = new User();
        $user->name = ucwords(strtolower(trim($request->name)));
        $user->email = trim($request->email);
        $user->nip = trim($request->nip);
        $user->bidang_id = trim($request->bidang_id);
        $user->password = Hash::make($request->password);
        $user->role = trim($request->role);
        $user->remember_token = \Illuminate\Support\Str::uuid()->toString();
        $user->save();

        return redirect('adminsistem/tambah-user')->with([
            'success' => [
                "title" => "User Register Succesfully",
                "message" => "Akun berhasil didaftarkan"
            ]
        ]);
    }

    public function edit_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate(
            [
                "name" => ["required", "max:100"],
                "email" => ["required", "unique:users,email," . $user->id],
                "nip" => ["required", "unique:users,nip," . $user->id],
                "password" => ["nullable", Password::min(6)->numbers()->letters()],
                "confirm_password" => ["nullable", "required_with:password", "same:password"],
                "bidang_id" => ["required"],
                "role" => "required"
            ],
            $this->customValidationMessages()
        );

        $user->name = ucwords(strtolower(trim($request->name)));
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->role = trim($request->role);
        $user->bidang_id = trim($request->bidang_id);


        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        if ($request->is('adminsistem/edit-user/' . $id)) {
            return redirect('adminsistem/edit-user/' . $id)->with([
                'success' => [
                    "title" => "Update User Successfully",
                    "message" => "Akun berhasil diperbarui"
                ]
            ]);
        } elseif ($request->is('adminbinagram/edit-user/' . $id)) {
            return redirect('adminbinagram/edit-user/' . $id)->with([
                'success' => [
                    "title" => "Update User Successfully",
                    "message" => "Akun berhasil diperbarui"
                ]
            ]);
        } elseif ($request->is('adminapproval/edit-user/' . $id)) {
            return redirect('adminapproval/edit-user/' . $id)->with([
                'success' => [
                    "title" => "Update User Successfully",
                    "message" => "Akun berhasil diperbarui"
                ]
            ]);
        } elseif ($request->is('operator/edit-user/' . $id)) {
            return redirect('operator/edit-user/' . $id)->with([
                'success' => [
                    "title" => "Update User Successfully",
                    "message" => "Akun berhasil diperbarui"
                ]
            ]);
        } elseif ($request->is('pimpinan/edit-user/' . $id)) {
            return redirect('pimpinan/edit-user/' . $id)->with([
                'success' => [
                    "title" => "Update User Successfully",
                    "message" => "Akun berhasil diperbarui"
                ]
            ]);
        }
    }

    public function delete_user($id): void
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function search_users(Request $request)
    {
        $roleOptions = $this->getRoleOptions();

        session()->put('filter', $request->input('filter'));
        session()->put('sort_order', $request->input('sort_order'));

        $search = $request->input('search');
        $filter = session('filter', 'name');
        $sortOrder = session('sort_order', 'asc');

        $adminSystemCurrent = Auth::user()->id;
        $usersQuery = User::where('users.id', '!=', $adminSystemCurrent)
            ->join('bidang', 'users.bidang_id', '=', 'bidang.id')
            ->select('users.*', 'bidang.nama_bidang');

        $usersQuery->where(function ($query) use ($search, $filter) {
            $query->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('users.nip', 'like', '%' . $search . '%')
                ->orWhere('users.email', 'like', '%' . $search . '%')
                ->orWhere('bidang.nama_bidang', 'like', '%' . $search . '%')
                ->orWhere('users.role', 'like', '%' . $search . '%');
        });

        $orderByColumn = 'users.id';

        if ($filter === 'nip') {
            $orderByColumn = 'users.nip';
        } elseif ($filter === 'name') {
            $orderByColumn = 'users.name';
        } elseif ($filter === 'email') {
            $orderByColumn = 'users.email';
        } elseif ($filter === 'role') {
            $orderByColumn = DB::raw("CASE
                WHEN users.role = '4' THEN 'Pimpinan'
                WHEN users.role = '3' THEN 'Admin Sistem'
                WHEN users.role = '2' THEN 'Admin Binagram'
                WHEN users.role = '1' THEN 'Admin Approval'
                WHEN users.role = '0' THEN 'Operator'
                ELSE ''
            END");
        } elseif ($filter === 'nama_bidang') {
            $orderByColumn = 'bidang.nama_bidang';
        }

        // Apply sorting direction
        if ($sortOrder === 'asc') {
            $users = $usersQuery->orderBy($orderByColumn)->latest('users.id')->paginate(7);
        } else {
            $users = $usersQuery->orderByDesc($orderByColumn)->latest('users.id')->paginate(7);
        }

        return view('adminsistem.dashboard', ['users' => $users, 'roleOptions' => $roleOptions]);
    }
    public function edit_bidang(Request $request)
    {
        $query = $request->input('search');

        // Jika ada pencarian, filter bidang
        $bidang = Bidang::when($query, function ($q) use ($query) {
            return $q->where('nama_bidang', 'like', '%' . $query . '%');
        })->paginate(6);

        return view('adminsistem.edit-bidang', compact('bidang'));
    }

    public function destroy_bidang($id)
    {
        try {
            $bidang = Bidang::findOrFail($id);

            // Update all users with this bidang_id to null
            User::where('bidang_id', $id)->update(['bidang_id' => null]);

            $bidang->delete();

            return redirect()->route('edit-bidang')->with('success', [
                'title' => 'Successfully!',
                'message' => 'Bidang berhasil dihapus dan bidang_id pengguna terkait telah diupdate.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('edit-bidang')->withErrors('Gagal menghapus bidang: ' . $e->getMessage());
        }
    }


    public function edit()
    {
        $bidang = Bidang::all();
        return view('adminsistem.update-bidang', compact('bidang'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bidang,id',
            'nama_bidang' => 'required|string|max:255',
        ]);

        $bidang = Bidang::findOrFail($request->id);
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->save();

        return redirect()->route('bidang.edit')->with('success', [
            'title' => 'Update Successful',
            'message' => 'Bidang berhasil diperbarui'
        ]);
    }


    public function view_add_bidang()
    {
        return view("adminsistem.tambah-bidang");
    }

    // Menyimpan data bidang
    public function store_bidang(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
        ]);

        Bidang::create([
            'nama_bidang' => $request->nama_bidang,
        ]);

        return redirect()->route('tambah-bidang')->with('success', [
            'title' => 'Successfully!',
            'message' => 'Bidang berhasil ditambahkan.',
        ]);
    }
}
