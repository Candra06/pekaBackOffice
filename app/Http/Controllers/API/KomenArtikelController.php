<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ReplyKomen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomenArtikelController extends Controller
{
    function postReply(Request $request) {

        try {
            ReplyKomen::create([
                'komen_id' => $request->komen,
                'users_id' => Auth::user()->id,
                'message' => $request->message,
            ]);
            $data = (new MasterController)->detailArtikel($request->artikel_id);

            return response()->json([
                'code' => '200',
                'data' => $data->original['data'],
            ], 200);
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'code' => '401',
                'message' => "Failed create Data",
            ], 401);
        }
    }
}
