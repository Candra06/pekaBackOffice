<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriScreening extends Model
{
    use HasFactory;
    protected $table = 'categori_screening';
    protected $fillable = ['category_name', 'isDecission'];
}
