<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Expert;
use App\Models\KomenArtikel;
use App\Models\UsersLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    public function listExpert()
    {
        try {
            $data = [];
            $dt = Expert::all();
            foreach ($dt as $key => $value) {
                $tmp = $value;
                $tmp['phone'] = 'https://wa.me/' . $value->phone;
                array_push($data, $tmp);
            }
            return response()->json([
                'code' => 200,
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '401',
                'message' => "Failed Show Data",
            ], 401);
        }
    }

    public function listArtikel(Request $reqest)
    {
        // return $reqest;
        try {
            $data = Artikel::leftJoin('users', 'users.id', 'artikel.created_by')
                ->select('artikel.*', 'users.name')
                ->orderBy('id', 'DESC')
                ->paginate(intval($reqest->perpage));
            return response()->json([
                'code' => '200',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'code' => '401',
                'message' => "Failed Show Data",
            ], 401);
        }
    }

    public function detailArtikel($id)
    {
        try {
            $tmpData = Artikel::leftJoin('users', 'users.id', 'artikel.created_by')
                ->select('artikel.*', 'users.name')
                ->where('artikel.id', $id)->first();
            $komen = KomenArtikel::join('users', 'users.id', 'komen_artikel.users_id')
                ->select('komen_artikel.*', 'users.name')
                ->where('komen_artikel.artikel_id', $tmpData->id)
                ->get();
            $cek = UsersLike::where('artikel_id', $id)
                ->where('users_id', Auth()->user()->id)
                ->first();
            $tmpData['isLike'] = $cek ? true : false;
            $data['artikel'] = $tmpData;
            $data['komen'] = $komen;
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

    public function likeArtikel($id)
    {
        try {
            $cek = UsersLike::where('artikel_id', $id)
                ->where('users_id', Auth()->user()->id)
                ->first();
            $art = [];
            $art = Artikel::leftJoin('users', 'users.id', 'artikel.created_by')
                ->select('artikel.*', 'users.name')
                ->where('artikel.id', $id)->first();
            if (!$cek) {
                $tmpLike = $art->total_like + 1;
                UsersLike::create(['artikel_id' => $id, 'users_id' => Auth()->user()->id]);
                Artikel::where('id', $id)->update(['total_like' => $tmpLike]);
                $art =  Artikel::leftJoin('users', 'users.id', 'artikel.created_by')
                    ->select('artikel.*', 'users.name')
                    ->where('artikel.id', $id)->first();
                $art['isLike'] = true;
            } else {
                $tmpLike = $art->total_like - 1;
                Artikel::where('id', $id)->update(['total_like' => $tmpLike]);
                UsersLike::where('id', $cek->id)->delete();
                $art =  Artikel::leftJoin('users', 'users.id', 'artikel.created_by')
                    ->select('artikel.*', 'users.name')
                    ->where('artikel.id', $id)->first();
                $art['isLike'] = false;
            }

            return response()->json([
                'code' => '200',
                'message' => "Sukses",
                'data' => $art,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => '401',
                'message' => "Failed Show Data",
            ], 401);
        }
    }

    public function postKomen(Request $request)
    {
        try {
            $komen['artikel_id'] = $request->artikel_id;
            $komen['komentar'] = $request->komen;
            $komen['users_id'] = Auth()->user()->id;
            $up = KomenArtikel::create($komen);
            if ($up) {
                $art = Artikel::where('id', $request->artikel_id)->first();
                $tmpKomen = $art->total_komen + 1;
                Artikel::where('id', $request->artikel_id)->update(['total_komen' => $tmpKomen]);
                $komen = KomenArtikel::join('users', 'users.id', 'komen_artikel.users_id')
                    ->select('komen_artikel.*', 'users.name')
                    ->where('komen_artikel.artikel_id', $art->id)
                    ->get();
                $cek = UsersLike::where('artikel_id', $request->artikel_id)
                    ->where('users_id', Auth()->user()->id)
                    ->first();
                $art = Artikel::where('id', $request->artikel_id)->first();
                $art['isLike'] = $cek ? true : false;
                $data['artikel'] = $art;
                $data['komen'] = $komen;
            }
            return response()->json([
                'code' => '200',
                'message' => "Sukses",
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'code' => '401',
                'message' => "Failed Show Data",
            ], 401);
        }
    }
}
