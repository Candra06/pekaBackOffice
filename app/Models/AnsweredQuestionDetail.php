<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnsweredQuestionDetail extends Model
{
    use HasFactory;
    protected $table = 'answered_detail';
    protected $fillable = ['answered_id', 'question_id', 'answer', 'score'];
}
