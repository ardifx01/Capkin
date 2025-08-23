<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role == 4) {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('pimpinan.dashboard', $data);
        } else if (Auth::user()->role == 3) {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('adminsistem.dashboard', $data);
        } else if (Auth::user()->role == 2) {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('adminbinagram.ikusup-ab', $data);
        } else if (Auth::user()->role == 1) {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('adminapproval.dashboard', $data);
        } else if (Auth::user()->role == 0) {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('operator.dashboard', $data);
        }
    }
}
