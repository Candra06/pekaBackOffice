<?php

namespace App\Http\Controllers;

use App\Models\CategoriScreening;
use App\Models\ScreeningCondition;
use App\Models\AnsweredQuestion;
use App\Models\AnsweredQuestionDetail;
use Illuminate\Http\Request;

use App\Exports\QuitionerExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoriScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = CategoriScreening::all();
            return view('categoriScreening.index', compact('data'));
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
                'category_name' => '',
                'isDecission' => '',
            ];
            return view('categoriScreening.form', compact('data'));
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
            'category_name' => 'required',
            'isDecission' => 'required',
        ]);
        // return $request;

        try {
            $input['category_name'] = $request->category_name;
            $input['isDecission'] = $request->isDecission;

            $save = CategoriScreening::create($input);
            if ($request->isDecission == 'true') {
                for ($i = 0; $i < count($request->symbol); $i++) {
                    $condition['symbol'] = $request->symbol[$i];
                    $condition['condition_score'] = $request->condition_score[$i];
                    ScreeningCondition::create([
                        'category_id' => $save->id,
                        'condition_name' => $request->kondition_name[$i],
                        'condition_maker' => json_encode($condition),
                    ]);
                }
            }
            return redirect('/category',)->with('success', 'Berhasil menambah kategori');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('error', 'Gagal menambah kategori');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriScreening  $categoriScreening
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriScreening $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriScreening  $categoriScreening
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriScreening $category)
    {
        // return $category;
        $data = (object) [
            'type' => 'edit',
            'id' => $category->id,
            'category_name' => $category->category_name,
            'isDecission' => $category->isDecission,
        ];
        $condition = ScreeningCondition::where('category_id', $category->id)->get();
        return view('categoriScreening.edit', compact('data', 'category', 'condition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriScreening  $categoriScreening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriScreening $category)
    {
        $request->validate([
            'category_name' => 'required',
            'isDecission' => 'required',
        ]);
        try {
            $input['category_name'] = $request->category_name;
            $input['isDecission'] = $request->isDecission;

            CategoriScreening::where('id', $category->id)->update($input);
            return redirect('/category',)->with('success', 'Berhasil mengubah kategori');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengubah kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriScreening  $categoriScreening
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriScreening $categoriScreening)
    {
        //
    }

    public function updateCondition(Request $request, $idCategory)
    {
        try {
            $condition['symbol'] = $request->symbol;
            $condition['condition_score'] = $request->condition_score;
            ScreeningCondition::where('id', $idCategory)->update([
                'condition_name' => $request->condition_name,
                'condition_maker' => json_encode($condition),
            ]);
            return redirect('/category/' . $request->id . '/edit')->with('success', 'Berhasil mengubah pilihan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addCondition(Request $request, $idCategory)
    {

        try {
            $condition['symbol'] = $request->symbol;
            $condition['condition_score'] = $request->condition_score;
            ScreeningCondition::create([
                'category_id' => $idCategory,
                'condition_name' => $request->condition_name,
                'condition_maker' => json_encode($condition),
            ]);
            return redirect('/category/' . $idCategory . '/edit')->with('success', 'Berhasil mengubah pilihan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteCondition($id)
    {

        try {
            ScreeningCondition::where('id', $id)->delete();
            return back()->with('success', 'Berhasil Menghapus pilihan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function export($id) {
        try {
            return Excel::download(new QuitionerExport($id), 'quitioner-export.xlsx');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}