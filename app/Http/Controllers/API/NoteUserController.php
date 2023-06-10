<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NoteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteUserController extends Controller
{
    public function list()
    {
        try {
            $data = NoteUser::where('user_id', Auth()->user()->id)->get();
            return response()->json([
                'code' => '200',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '401',
                'message' => "Failed Show Data",
            ], 401);
        }
    }

    public function delete($id)
    {
        try {
            NoteUser::where('id', $id)->delete();
            return response()->json([
                'code' => '200',
                'message' => 'Berhasil menghapus catatan'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '401',
                'message' => "Failed delete Data",
            ], 401);
        }
    }

    public function add(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'note' => 'required',
        ]);
        try {
            NoteUser::create([
                'user_id' => Auth()->user()->id,
                'date' => $request->date,
                'note' => $request->note,
            ]);
            return response()->json([
                'code' => '200',
                'message' => 'Berhasil menambahkan catatan'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '401',
                'message' => 'Gagal menambahkan catatan'
            ], 401);
        }
    }
}
