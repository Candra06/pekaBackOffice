<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnsweredQuestion;
use App\Models\NoteUser;
use App\Models\User;
use Carbon\Carbon;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function testSend()
    {
        $send = [];
        // $send = Helper::sendNotif('eybomorhRJe0usSMF7hQjJ:APA91bEQDzKwV0BvvdtmGllZQxz-4KavvEGexJqi35CCCLnuqC7f1QHNCbKv8u8-fkoujs6ppiKFj779Y4bs3tABRvkOJ6hVzcduLElNtICZot-6_SzXPQcRRaxzsNQ4BvCcjNEPAfN9', 'Reminder', 'Ada note hari ini');
        $note = NoteUser::join('users', 'users.id', 'note_user.user_id')
            ->select('users.remember_token', 'note_user.*')
            ->get();
        // return Carbon::now();
        foreach ($note as $value) {
            $now = explode("T", Carbon::now());
            $tmp = explode(" ", $now[0]);
            // return  $tmp[0];
            if ($value['remember_token'] != '-' && $value['date'] == $tmp[0]) {
                $send = Helper::sendNotif($value['remember_token'], 'Reminder', $value['note']);
                // return $value;
            } else {
                return $value;
            }
        }

        return $send;
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'fcm_token' => 'required',
        ]);
        // return $request;
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'remember_token' => $request->fcm_token,
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
                    User::where('id', $user->id)->update(['remember_token' => $request->fcm_token]);
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

    public function getDataDashboard()
    {
        try {
            $remember =  NoteUser::whereDate('date',  date('Y-m-d'))
                ->where('user_id', Auth()->user()->id)
                ->count();
            $cekScreening = AnsweredQuestion::where('user_id', Auth()->user()->id)->count();
            $data['reminder'] = $remember;
            $data['screening'] = $cekScreening;
            return response()->json([
                'code' => '200',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'code' => '401',
                'message' => "Failed get data",
            ], 401);
        }
    }
}
