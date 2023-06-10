<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('login');
    }

   

    public function authenticate(Request $request)
    {
        $credential =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credential)) {

            $request->session()->regenerate();
            if (Auth()->user()->role == 'Admin') {
                return redirect()->intended('/dashboard');
            } else {
                return "error";
                return redirect()->intended('/')->with('error', 'Anda bukan Admin');
            }
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
