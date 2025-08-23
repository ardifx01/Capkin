<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login handler
    public function login_post(Request $request)
    {
        if (!User::where('email', $request->email)->exists()) {
            return redirect()->back()->with([
                'error' => [
                    "title" => "Account Not Found",
                    "message" => "Email tidak terdaftar"
                ]
            ]);
        }

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], true)
        ) {
            // Redirect based on user role
            switch (Auth::user()->role) {
                case "4":
                    return redirect()->intended('pimpinan/dashboard');
                case "3":
                    return redirect()->intended('adminsistem/dashboard');
                case "2":
                    return redirect()->intended('adminbinagram/ikusup-ab');
                case "1":
                    return redirect()->intended('adminapproval/dashboard');
                case "0":
                    return redirect()->intended('operator/dashboard');
                default:
                    Auth::logout();
                    return redirect()->back()->with([
                        'error' => [
                            "title" => "Unauthorized",
                            "message" => "Role tidak dikenali"
                        ]
                    ]);
            }
        }

        return redirect()->back()->with([
            'error' => [
                "title" => "Invalid Credentials",
                "message" => "Username atau password salah"
            ]
        ]);
    }

    // Logout handler
    public function logout()
    {
        Auth::logout();
        return redirect(url('/'))->with('logout_success', 'Anda berhasil logout');
    }
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    // Display edit profile page
    public function view_edit_profile($id = null)
    {
        $user = $id ? User::find($id) : Auth::user();

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('user.edit-profile', compact('user'));
    }

    // Handle update profile
    public function update_profile(Request $request, $id = null)
    {
        $user = $id ? User::find($id) : Auth::user();

        if (!$user) {
            abort(404, 'User not found');
        }

        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Redirect back with success message
        return redirect()->route('user.edit-profile', $user->id)->with('success', [
            "title" => "Profile Updated",
            "message" => "Profil Anda berhasil diperbarui"
        ]);
    }
}
