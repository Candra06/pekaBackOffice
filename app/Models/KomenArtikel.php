<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomenArtikel extends Model
{
    use HasFactory;
    protected $table = 'komen_artikel';
    protected $fillable = ['artikel_id', 'users_id', 'komentar'];
}
