<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreeningCondition extends Model
{
    use HasFactory;
    protected $table = 'screening_decission';
    protected $fillable = ['category_id', 'condition_name', 'condition_maker'];
}
