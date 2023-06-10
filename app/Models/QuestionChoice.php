<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionChoice extends Model
{
    use HasFactory;
    protected $table = 'question_choice';
    protected $fillable = ['question_id', 'label', 'score'];
}
