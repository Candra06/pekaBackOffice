<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required',
        ]);
        // return $request;
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'role' => 'User',
            ]);
            return response()->json([
                'code' => '200',
                'message' => "Pendaftaran berhasil",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '400',
                'error' => 'internal server error', 'message' => $th,
            ], 403);
        }
    }

    public function getUser()
    {
        $data = Auth()->user();
        return response()->json([
            'code' => 200,
            'message' => "Data berhasil",
            'data' => $data,
        ], 200);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (password_verify($request->password, $user->password)) {
                    $tokenResult = $user->createToken('authToken')->plainTextToken;
                    return response()->json([
                        'code' => 200,
                        'access_token' => $tokenResult,
                        'data' => $user
                    ]);
                } else {
                    return response()->json([
                        'code' => 401,
                        'data' => 'Password Salah',

                    ]);
                }
            } else {
                return response()->json([
                    'code' => 401,
                    'data' => 'Username tidak terdaftar',

                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '400',
                'error' => 'internal server error', 'message' => $th,
            ], 403);
        } # code...
    }

    public function update(Request $request)
    {
        try {
            $credential = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);
            if ($request->password) {
                $credential['password'] = bcrypt($request->password);
            }
            User::where('id', Auth()->user()->id)->update($credential);
            return response()->json([
                'code' => '200',
                'data' => $credential,
                'message' => "Update Profil Berhasil",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '401',
                'message' => "Update Profil Gagal",
            ], 401);
        }
    }
}
