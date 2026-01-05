<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function index(){
        return view('Auth.Login');
    }

    function login(Request $request){
        $credential = Validator::make($request->all(), [
            'email'                 => 'required|email',
            'password'              => 'required|min:8',
            'g-recaptcha-response'  => 'required'
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',

            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',

            'g-recaptcha-response.required' => 'Captcha wajib diisi.'
        ]);

        if($credential->fails()) return redirect()->back()->withErrors($credential)->withInput();

        // captcha
        $secret = config('services.recaptcha.secret_key');

        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=" .
            $request->input('g-recaptcha-response')
        );

        $responseKeys = json_decode($response, true);

        if (! $responseKeys['success']) {
            return back()->withInput()->withErrors(['g-recaptcha-response' => 'Verifikasi captcha gagal. Coba lagi.']);
        }

        // AMBIL CREDENTIAL UNTUK LOGIN
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Kamu Berhasil LogIn');
        }else{
            return redirect()->route('login')->with('failed', 'Email Atau Password Salah!');
        }
    }
}
