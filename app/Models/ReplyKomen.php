<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyKomen extends Model
{
    use HasFactory;
    protected $table = 'reply_komen';
    protected $fillable = ['komen_id', 'users_id', 'message'];

    public function komen()
    {
        return $this->belongsTo(KomenArtikel::class, 'komen_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
