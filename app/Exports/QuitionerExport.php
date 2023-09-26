<?php

namespace App\Exports;

use App\Models\CategoriScreening;
use App\Models\ScreeningCondition;
use App\Models\AnsweredQuestion;
use App\Models\AnsweredQuestionDetail;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QuitionerExport implements FromView
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        $dataQuestions = CategoriScreening::join('question', 'categori_screening.id', 'question.category_id')
            ->where('categori_screening.id', $this->id)
            ->select(
                'categori_screening.id as category_id',
                'categori_screening.category_name',
                'categori_screening.isDecission',
                'question.question',
                'question.type',
                'question.id as question_id',
            )
            ->orderBy('question.id', 'ASC')
            ->get();

            $answeredQuetions = AnsweredQuestion::join('users', 'users.id', 'answered_questions.user_id')
                ->select(
                    'users.name',
                    'answered_questions.created_at',
                    'answered_questions.id'
                )
                ->where('category_id', $this->id)
                ->distinct()
                ->get();

            $detailAnswers = [];

            foreach ($answeredQuetions as $key => $value) {
                $detail = AnsweredQuestionDetail::select(\DB::raw('GROUP_CONCAT(answer) as answer'))->where('answered_id', $value->id)->groupBy('answered_id', 'question_id')->orderBy('question_id', 'ASC')
                ->get();

                $detailAnswers[$key] = $detail;
            }

        return view('categoriScreening.export', compact('dataQuestions', 'answeredQuetions', 'detailAnswers'));
    }
}