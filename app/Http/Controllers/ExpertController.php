<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Expert::all();
            return view('expert.index', compact('data'));
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
                'name' => '',
                'photo' => 'choose file',
                'phone' => '',
                'description' => '',
            ];
            return view('expert.form', compact('data'));
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
            'name' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'photo' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);
        try {
            $fileType = $request->file('photo')->extension();
            $name = Str::random(8) . '.' . $fileType;
            $input['name'] = $request->name;
            $input['phone'] = $request->phone;
            $input['description'] = $request->description;
            $input['photo'] = Storage::putFileAs('profile', $request->file('photo'), $name);

            Expert::create($input);
            return redirect('/expert',)->with('success', 'Berhasil menambah expert');
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
    public function show(Expert $expert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function edit(Expert $expert)
    {
        // return $expert;
        $data = (object) [
            'type' => 'edit',
            'name' => $expert->name,
            'photo' => $expert->photo,
            'phone' => $expert->phone,
            'description' => $expert->description,
        ];
        return view('expert.form', compact('data', 'expert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expert $expert)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'photo' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);
        try {
            $input['name'] = $request->name;
            $input['phone'] = $request->phone;
            $input['description'] = $request->description;
            if ($request->photo) {
                $fileType = $request->file('photo')->extension();
                $name = Str::random(8) . '.' . $fileType;
                $input['photo'] = Storage::putFileAs('profile', $request->file('photo'), $name);
            }

            Expert::where('id', $expert->id)->update($input);
            return redirect('/expert',)->with('success', 'Berhasil mengubah expert');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah expert');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expert $expert)
    {
        try {
            Expert::where('id', $expert->id)->delete();
            return back()->with('success', 'Berhasil menghapus expert');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus expert');
        }
    }
}
