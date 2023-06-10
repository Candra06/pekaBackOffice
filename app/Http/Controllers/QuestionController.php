<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionChoice;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Question::all();
            return view('question.index', compact('data'));
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
                'question' => '',
                'type_question' => '',
                'score' => '',

            ];
            return view('question.form', compact('data'));
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
        // return $request;
        try {
            $question = Question::create([
                'question' => $request->question,
                'type' => $request->type_question,
                'score' => $request->score,
            ]);
            if ($question) {
                if ($request->type_question == 'Choice' && count($request->answer) >= 1 && count($request->score_answer) >= 1) {
                    for ($i = 0; $i < count($request->answer); $i++) {
                        QuestionChoice::create([
                            'label' => $request->answer[$i],
                            'question_id' => $question->id,
                            'score' => $request->score_answer[$i],
                        ]);
                    }
                }
            }
            return redirect('/kuesioner',)->with('success', 'Berhasil menambah pertanyaan');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('error', 'Gagal menambah pertanyaan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
