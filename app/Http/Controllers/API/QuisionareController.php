<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnsweredQuestion;
use App\Models\AnsweredQuestionDetail;
use App\Models\Question;
use App\Models\QuestionChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuisionareController extends Controller
{
    public function listQuestion()
    {
        try {
            $data = [];
            $question = Question::all();
            foreach ($question as $key => $value) {

                if ($value->type == 'Choice') {
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
        try {
            $answer = AnsweredQuestion::create([
                'user_id' => Auth()->user()->id,
                'total_score' => 0,
            ]);
            foreach ($request->answer as $key => $value) {
                AnsweredQuestionDetail::create([
                    'answered_id' => $answer->id,
                    'question_id' => $value['question_id'],
                    'answer' => $value['answer'],
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

   
}
