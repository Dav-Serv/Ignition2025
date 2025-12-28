<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    function logout(Request $request){
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('dashboard')->with('success', 'Anda Berhasil LogOut!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Gagal Logout' . $e->getMessage());
        }
    }
}
