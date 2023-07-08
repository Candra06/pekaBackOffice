<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Expert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $data = User::all();
        return view('users.index', compact('data'));
    }

    function loginView()
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
        $data = ([
            'users' => User::count(),
            'expert' => Expert::count(),
            'artikel' => Artikel::count(),
        ]);
        // return $data;
        return view('dashboard', compact('data'));
    }

    function create(){
        try {
            $data = (object)[
                'type' => 'add',
                'name' => '',
                'email' => '',
                'role' => '',
                'phone' => '',
            ];
            return view('users.form', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
        try {
            $input['name'] = $request->name;
            $input['phone'] = $request->phone;
            $input['email'] = $request->email;
            $input['role'] = $request->role;
            $input['password'] = $request->password;
           

            User::create($input);
            return redirect('/users',)->with('success', 'Berhasil menambah expert');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menambah expert');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return $expert;
        $data = (object) [
            'type' => 'edit',
            'name' => $user->name,
            'photo' => $user->photo,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role,
        ];
        return view('users.form', compact('data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);
        try {
            $input['name'] = $request->name;
            $input['phone'] = $request->phone;
            $input['role'] = $request->role;
            $input['email'] = $request->email;
            if ($request->password) {
                $input['password'] = $request->password;
            }

            User::where('id', $user->id)->update($input);
            return redirect('/users',)->with('success', 'Berhasil mengubah users');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('error', 'Gagal mengubah users');
        }
    }
}
