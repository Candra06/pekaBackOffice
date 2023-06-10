<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersLike extends Model
{
    use HasFactory;
    protected $table = 'users_like';
    protected $fillable = ['artikel_id', 'users_id'];
}
