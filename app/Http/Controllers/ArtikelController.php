<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Artikel::all();
            return view('artikel.index', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = (object)[
                'type' => 'add',
                'title' => '',
                'thumbnail' => 'choose file',
                'content' => '',
            ];
            return view('artikel.form', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);
        try {
            $fileType = $request->file('thumbnail')->extension();
            $name = Str::random(8) . '.' . $fileType;
            $input['title'] = $request->title;
            $input['content'] = $request->content;
            $input['created_by'] = Auth::user()->id;
            $input['total_like'] = 0;
            $input['total_komen'] = 0;
            $input['thumbnail'] = Storage::putFileAs('thumbnail', $request->file('thumbnail'), $name);

            Artikel::create($input);
            return redirect('/artikel',)->with('success', 'Berhasil menambah artikel');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menambah artikel');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        // return $artikel;
        $data = (object) [
            'type' => 'edit',
            'title' => $artikel->title,
            'thumbnail' => $artikel->thumbnail,
            'content' => $artikel->content,
        ];
        return view('artikel.form', compact('data', 'artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);
        try {
            $input['title'] = $request->title;
            $input['content'] = $request->content;
            if ($request->thumbnail) {
                $fileType = $request->file('thumbnail')->extension();
                $name = Str::random(8) . '.' . $fileType;
                $input['thumbnail'] = Storage::putFileAs('thumbnail', $request->file('thumbnail'), $name);
            }

            Artikel::where('id', $artikel->id)->update($input);
            return redirect('/artikel',)->with('success', 'Berhasil mengubah artikel');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah artikel');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        try {
            Artikel::where('id', $artikel->id)->delete();
            return back()->with('success', 'Berhasil menghapus artikel');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus artikel');
        }
    }
}
