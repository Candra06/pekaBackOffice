<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnsweredQuestion;
use App\Models\AnsweredQuestionDetail;
use App\Models\CategoriScreening;
use App\Models\Question;
use App\Models\QuestionChoice;
use App\Models\ScreeningCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuisionareController extends Controller
{
    public function listQuestion($id)
    {
        try {
            $data = [];
            $question = Question::where('category_id', $id)->get();
            foreach ($question as $key => $value) {

                if ($value->type != 'Essai') {
                    $choice = QuestionChoice::where('question_id', $value->id)->get();
                    $value['choice'] = $choice;
                } else {
                    $value['choice'] = [];
                }
                array_push($data, $value);
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

    public function saveScreening(Request $request)
    {
        // return $request;
        try {
            $category = CategoriScreening::where('id', $request->category_id)->first();
            $totalScore = 0;
            foreach ($request->answer as $key => $value) {
                $totalScore += $value['score'];
            }
            $answer = AnsweredQuestion::create([
                'user_id' => Auth()->user()->id,
                'total_score' => $totalScore,
                'category_id' => $request->category_id,
                'result_decission' => $category->isDecission ? $request->result_decission : "-",
            ]);
            foreach ($request->answer as $key => $value) {
                AnsweredQuestionDetail::create([
                    'answered_id' => $answer->id,
                    'question_id' => $value['question_id'],
                    'answer' => $value['answer'],
                    'score' => $value['score'],
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'code' => '401',
                'message' => "Failed Show Data",
            ], 401);
        }
    }

    function listCategory()
    {
        try {
            $tmpData = CategoriScreening::all();
            $data = [];
            foreach ($tmpData as $key => $value) {
                $tmpValue = ScreeningCondition::where('category_id', $value->id)->get();
                $tmp = ([
                    'data' => $value,
                    'kondisi' => $tmpValue,
                ]);
                array_push($data, $tmp);
            }

            return response()->json([
                'code' => 200,
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
